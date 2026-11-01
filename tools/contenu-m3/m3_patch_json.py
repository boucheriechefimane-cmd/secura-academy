# -*- coding: utf-8 -*-
"""Mise a jour du contenu M3 (JSON source) : pivot real, binaire setuid."""
import json
import pathlib

P = pathlib.Path('/tmp/m3.json')
rooms = json.loads(P.read_text(encoding='utf-8'))

# ---------------------------------------------------------------- scenario 7
r7 = rooms[6]
r7['lab']['flag_service'] = 'web'

# ---------------------------------------------------------------- scenario 8
r8 = rooms[7]
r8['lab']['flag_service'] = 'internal'

lesson8 = r8['tasks'][0]
lesson8['content'] = lesson8['content'].replace(
    '<p>Un <strong>pivot</strong>, c\'est utiliser une machine compromise',
    '<p>Un <strong>pivot</strong>, c\'est utiliser une machine compromise',
)
lesson8['content'] += (
    '<p><strong>Dans ce lab :</strong> le nœud « web » n\'est pas une fin. '
    'C\'est un tremplin. Il héberge un outil de supervision (« superviseur-interne ») '
    'qui va chercher une page sur <em>un autre poste</em> et la renvoie. '
    'Ce n\'est pas une faille qu\'on exploite : c\'est une fonction métier, '
    'utilisée sans restriction — c\'est souvent comme ça que les pivots '
    'arrivent dans la vraie vie.</p>'
    '<p>Le nœud « internal » n\'est sur aucun réseau que ta machine voit : '
    'seul « web » y a accès. Deux волны ne se croisent jamais.</p>'
)
# la phrase ci-dessus contient des caracteres etrangers : on la remplace proprement
lesson8['content'] = lesson8['content'].replace(
    '<p>Deux волны ne se croisent jamais.</p>',
    '<p>Deux réseaux qui ne se croisent jamais.</p>',
)

mission8 = r8['tasks'][2]['questions'][0]
mission8['hint'] = (
    'Trois indices : (1) le noeud « web » liste ses pages dans robots.txt ; '
    '(2) sa configuration est dans /srv/app/app.conf ; '
    '(3) le noeud « internal » n\'ecoute que depuis le reseau interne, '
    'mais le noeud « web » sait l\'atteindre.'
)
mission8['explanation'] = (
    'Le pivot n\'est pas une exploitation : c\'est l\'usage d\'un acces legitime '
    '(l\'outil de supervision et le compte de service reutilise). '
    'Parade : filtrer les destinations du proxy, ne jamais reutiliser un secret, '
    'et segmenter reellement les reseaux.'
)

r8['terminal']['steps'] = [
    {
        'match': ['curl -s http://web:8080/robots.txt', '/curl .*robots/'],
        'output': 'User-agent: *\nDisallow: /admin.php\nDisallow: /diag.php\nDisallow: /proxy.php\nDisallow: /backup/\n',
        'hint': 'Le fichier robots.txt liste les pages que l\'application ne veut pas voir indexees.',
    },
    {
        'match': ['curl -s http://web:8080/diag.php', '/curl .*diag/'],
        'output': '=== Diagnostic Intranet ===\napp_name : Intranet\nversion  : 2.4.1\n--- /srv/app/app.conf ---\n# Configuration interne — ne pas diffuser.\napp_user = admin\ndb_password = Intranet2019!\nproxy_tool = /proxy.php\n--- fin ---\n',
        'hint': 'La page de diagnostic affiche la configuration de l\'application.',
    },
    {
        'match': ['curl -s -d username=admin -d password=Intranet2019! "http://web:8080/proxy.php?url=http://internal:8080/"',
                  '/proxy\\.php.*internal/'],
        'output': 'Archivage interne\nRéservé aux dossiers patients archivés.\nAccès Granted.\nDossier archivé : FLAG=SECURA{pivot_accompli}\n',
        'hint': 'L\'outil de supervision du noeud « web » va chercher la page sur un autre poste : c\'est le pivot.',
    },
]

# ---------------------------------------------------------------- scenario 9
r9 = rooms[8]
r9['lab']['target'] = 'binaire vulnerable : /home/ctf/vulnerable'

lesson9 = r9['tasks'][0]
lesson9['content'] += (
    '<p><strong>Un détail qui change tout :</strong> sur cette machine, le carnet '
    'de commandes est installé en <strong>setuid root</strong>. Le bit setuid veut '
    'dire : « même si je suis lancé par un simple utilisateur, le noyau me donne '
    'les droits de son propriétaire ». Un débordement de tampon dans un programme '
    'setuid root ne donne pas un shell d\'utilisateur : il donne un shell '
    '<strong>root</strong>. C\'est pourquoi on ne laisse jamais de programme '
    'setuid dans les mains d\'un utilisateur non fiable.</p>'
)

mission9 = r9['tasks'][2]['questions'][0]
mission9['flag_path'] = '/root/flag.txt'
mission9['hint'] = (
    'Le carnet de commandes (/home/ctf/vulnerable) lit ta saisie sans vérifier '
    'sa longueur, et il est installé en setuid root : ton shell sera root.'
)
mission9['explanation'] = (
    'Le dépassement de tampon a detourne l\'execution vers un shell root, '
    'parce que le binaire est setuid. Parade : verifier les longueurs, '
    'compiler avec les defenses (canary, NX, PIE, RELRO), et surtout ne pas '
    'donner le setuid a un programme fragile.'
)

r9['terminal']['steps'] = [
    {
        'match': ['file /home/ctf/vulnerable', '/file .*vulnerable/'],
        'output': '/home/ctf/vulnerable: ELF 64-bit LSB executable, x86-64, version 1 (SYSV), dynamically linked, not stripped\n',
        'hint': 'Le carnet de commandes est dans /home/ctf/.',
    },
    {
        'match': ['ls -l /home/ctf/vulnerable', '/ls -l .*vulnerable/'],
        'output': '-rwsr-xr-x 1 root root 8104 Jan  9 09:12 /home/ctf/vulnerable\n',
        'hint': 'Le bit « s » dans -rws signale un programme setuid.',
    },
    {
        'match': ['cat /root/flag.txt', '/cat .*flag\\.txt/'],
        'output': 'FLAG=SECURA{buffer_overflow}\n',
        'hint': 'Une fois le shell root obtenu, le drapeau est dans /root/.',
    },
]

P.write_text(json.dumps(rooms, ensure_ascii=False, indent=1), encoding='utf-8')
print('JSON mis a jour')
