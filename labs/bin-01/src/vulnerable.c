/*
 * Programme volontairement vulnérable (laboratoire pédagogique).
 *
 * Scénario « le binaire qui obéit trop ».
 *
 * Ce carnet de commandes lit l'entrée de l'utilisateur dans un tampon de
 * 64 octets, sans aucune vérification de longueur. Une entrée plus longue
 * écrase la pile, dont l'adresse de retour : on peut donc détourner
 * l'exécution du programme.
 *
 * Le programme contient une fonction d'administration, « carnet_root »,
 * qui n'est JAMAIS appelée par le code normal : elle ouvre un shell avec
 * les droits du propriétaire du binaire (root, car il est installé
 * setuid root dans l'image). C'est la cible de l'exploitation.
 *
 * Aucune protection n'est activée à la compilation (voir Makefile) :
 *   - pas de canari de pile   (-fno-stack-protector)
 *   - pas de PIE              (-no-pie : les adresses du binaire sont fixes)
 *   - pile exécutable         (-z execstack)
 *
 * L'ASLR du noyau n'est PAS désactivée par -no-pie : elle randomise la
 * pile et les bibliothèques, mais pas les adresses du binaire lui-même.
 * C'est justement ce qui rend l'exercice faisable sans connaître d'adresse
 * de pile : l'adresse de « carnet_root » est constante.
 *
 * Le code de « carnet_root » remet les identités à zéro (setuid(0)) avant
 * d'ouvrir le shell. Sans cela, un binaire setuid root qui appelle
 * system("/bin/sh") n'obtiendrait qu'un shell utilisateur : le shell
 * abandonne les privilèges quand l'identité réelle et l'identité effective
 * diffèrent. C'est un détail classique, et pédagogiquement important.
 */
#include <stdio.h>
#include <string.h>
#include <unistd.h>

/*
 * Fonction d'administration : jamais appelée par le cours normal du
 * programme. C'est la cible de l'exploitation par débordement.
 */
void carnet_root(void) {
	setuid(0);
	seteuid(0);
	execl("/bin/sh", "sh", (char *) NULL);
}

void banner(void) {
	printf("=== Carnet de commandes (v0.9) ===\n");
	printf("Format : <numero de lot> <reference>\n");
}

void handle_input(void) {
	char buffer[64];

	printf("> ");
	fflush(stdout);

	/*
	 * VULNÉRABILITÉ VOLONTAIRE : on lit jusqu'à 1024 octets dans un
	 * tampon de 64, sans vérifier la longueur.
	 */
	ssize_t lus = read(STDIN_FILENO, buffer, 1024);

	if (lus < 0) {
		return;
	}

	buffer[lus > 0 ? lus - 1 : 0] = '\0';

	printf("Lot enregistre : %s\n", buffer);
}

int main(int argc, char **argv) {
	banner();

	if (argc > 1 && strcmp(argv[1], "--version") == 0) {
		printf("carnet v0.9 (build 2024-11-04)\n");
		return 0;
	}

	handle_input();

	return 0;
}
