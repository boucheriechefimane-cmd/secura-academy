#!/usr/bin/env python3
"""Vérifie les archives reconstruites, sans Docker ni WordPress réels."""

import glob
import shlex
import subprocess
import sys
import tempfile
import unittest
import zipfile
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
ARCHIVES = {
    "secura-academy-plugin.zip": [
        "secura-academy/LICENSE",
        "secura-academy/THIRD-PARTY-LICENSES.md",
        "secura-academy/includes/EXPERIMENTAL-ZIP.md",
    ],
    "secura-academy-wordpress.zip": [
        "plugins/secura-academy/LICENSE",
        "plugins/secura-academy/THIRD-PARTY-LICENSES.md",
        "themes/secura-learning/LICENSE",
    ],
    "secura-learning-theme.zip": ["secura-learning/LICENSE"],
    "secura-academy-labs.zip": [
        "LICENSE", "LICENSES.md", "docs/SOURCES-CONTENU.md",
        "bin-01/flag/flag.txt", "dojo-01/Dockerfile",
    ],
    "secura-academy-recette.zip": [
        "LICENSE", "LICENSES.md", "tests/import-test.py",
        "tools/rooms-connues.json", "tools/controler-lot.py",
        "scripts/audit/README-SONDES-ZIP.md",
        "docs/RECETTE-2026-11-05-WORDPRESS-REEL.md",
    ],
}


class TestArchives(unittest.TestCase):
    @classmethod
    def setUpClass(cls):
        cls.temp = tempfile.TemporaryDirectory(prefix="secura-archives-")
        cls.path = Path(cls.temp.name)
        subprocess.run(
            ["bash", str(ROOT / "scripts/build-archives.sh"), str(cls.path)],
            cwd=ROOT, check=True, capture_output=True, text=True,
        )

    @classmethod
    def tearDownClass(cls):
        cls.temp.cleanup()

    def test_integrite_et_licences(self):
        for filename, required in ARCHIVES.items():
            with self.subTest(archive=filename), zipfile.ZipFile(self.path / filename) as archive:
                self.assertIsNone(archive.testzip())
                self.assertTrue(set(required) <= set(archive.namelist()))

    def test_recette_contient_le_contenu_livre(self):
        with zipfile.ZipFile(self.path / "secura-academy-plugin.zip") as plugin, \
             zipfile.ZipFile(self.path / "secura-academy-recette.zip") as recette:
            prefix = "secura-academy/includes/content-import-"
            generated = [name for name in plugin.namelist() if name.startswith(prefix) and name.endswith(".php")]
            self.assertTrue(generated)
            for name in generated:
                in_recipe = "wp-content/plugins/" + name
                with self.subTest(fichier=name):
                    self.assertEqual(plugin.read(name), recette.read(in_recipe))

            # Les rapports d'audit voyagent avec la recette : un auditeur
            # livre sans son resultat ne dit rien.
            rapports = [n for n in recette.namelist() if n.startswith("docs/audits/")]
            self.assertGreaterEqual(len(rapports), 54)
            self.assertTrue(any(n.endswith(".json") for n in rapports))
            self.assertTrue(any(n.endswith(".html") for n in rapports))

    def test_recette_chaine_import_autonome(self):
        destination = self.path / "recette"
        with zipfile.ZipFile(self.path / "secura-academy-recette.zip") as archive:
            archive.extractall(destination)
        result = subprocess.run(
            [sys.executable, "tests/import-test.py"], cwd=destination,
            capture_output=True, text=True,
        )
        self.assertEqual(0, result.returncode, result.stdout[-2000:] + result.stderr[-2000:])
        self.assertIn("les fichiers PHP livres correspondent aux lots valides", result.stdout)

    def test_sources_copy_des_dockerfiles(self):
        destination = self.path / "labs"
        with zipfile.ZipFile(self.path / "secura-academy-labs.zip") as archive:
            archive.extractall(destination)
        dockerfiles = list(destination.rglob("Dockerfile"))
        self.assertGreaterEqual(len(dockerfiles), 7)
        for dockerfile in dockerfiles:
            for line in dockerfile.read_text(encoding="utf-8").splitlines():
                if not line.upper().startswith("COPY "):
                    continue
                parts = shlex.split(line)
                if len(parts) < 3 or parts[1].startswith("--"):
                    self.fail("Instruction COPY non prise en charge : %s : %s" % (dockerfile, line))
                for source in parts[1:-1]:
                    with self.subTest(dockerfile=dockerfile.relative_to(destination), source=source):
                        self.assertTrue(glob.glob(str(dockerfile.parent / source)), "Source COPY absente")


if __name__ == "__main__":
    unittest.main(verbosity=2)
