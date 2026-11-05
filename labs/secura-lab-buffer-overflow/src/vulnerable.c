/*
 * Programme volontairement vulnérable (laboratoire pédagogique).
 *
 * Le débordement de tampon permet d'écrire au-delà du tampon local et de
 * détourner l'exécution. Aucune protection n'est activée à la compilation :
 * voir Makefile.
 */
#include <stdio.h>
#include <string.h>
#include <unistd.h>

void banner() {
	printf("=== Carnet de commandes (v0.9) ===\n");
	printf("Format : <numero de lot> <reference>\n");
}

void handle_input() {
	char buffer[64];

	printf("> ");
	fflush(stdout);

	/* VULNÉRABILITÉ VOLONTAIRE : pas de contrôle de longueur. */
	gets(buffer);

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
