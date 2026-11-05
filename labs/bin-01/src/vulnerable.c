/*
 * Programme volontairement vulnérable (laboratoire pédagogique).
 *
 * Scénario « le binaire qui obéit trop » : le programme fait ce qu'on lui
 * dit de faire, et on lui dit de montrer un secret.
 *
 * --- Ce que change la version du 5 novembre 2026 (soir) ---
 *
 * La version précédente reposait sur le bit setuid : « le binaire est
 * setuid root, donc un débordement donne un shell root ». Deux problèmes :
 *
 *   1. la plateforme lance les machines avec des restrictions qui
 *      annulent l'effet du setuid — le scénario devenait impossible là où
 *      il tournait réellement (constaté en mesurant, pas en supposant) ;
 *   2. un shell root est un butin démesuré pour apprendre ce qu'est un
 *      débordement de pile.
 *
 * La version actuelle ne demande AUCUN privilège. Le drapeau n'est pas
 * protégé par des droits : il est chiffré dans le binaire et le programme
 * ne l'affiche jamais par le cours normal.
 *
 *   - « lire_drapeau » déchiffre le drapeau et l'affiche ;
 *   - « handle_input » lit 1024 octets dans un tampon de 64, sans aucune
 *     vérification : l'adresse de retour peut être écrasée ;
 *   - le binaire est compilé sans PIE : l'adresse de « lire_drapeau » est
 *     fixe, lisible avec « nm », et l'ASLR ne la déplace pas.
 *
 * Autrement dit : pour voir le drapeau, il faut détourner le programme.
 * Aucun fichier n'est lisible « par accident », aucun privilège n'est
 * nécessaire, et le scénario fonctionne dans n'importe quel conteneur.
 *
 * Aucune protection n'est activée à la compilation (voir Makefile) :
 *   - pas de canari de pile   (-fno-stack-protector)
 *   - binaire non PIE         (-no-pie : les adresses sont fixes)
 *   - pile exécutable         (-z execstack)
 *
 * Pédagogiquement, c'est aussi plus honnête : la leçon devient « le
 * contrôle du compteur de programme », et non « le setuid, c'est
 * dangereux ».
 */
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <unistd.h>

/*
 * Le drapeau, stocké chiffré. Deux blocs dont le OU exclusif redonne le
 * texte : aucun des deux ne contient le drapeau, et « strings » ne trouve
 * rien. Ce n'est PAS de la cryptographie : c'est une façon de dire
 * clairement « le drapeau n'est pas dans les données visibles ».
 */
static const unsigned char bloc_a[] = {
	0x21, 0xcd, 0xaf, 0xca, 0x27, 0xfe, 0xd8, 0x9b, 0x1a, 0x6a, 0x9e, 0xa3,
	0x2c, 0x6d, 0xdf, 0x4d, 0x2c, 0xf2, 0xaa, 0xc0, 0xc0, 0xc3, 0x75, 0x9b,
	0xcb, 0x51, 0x30, 0x2c, 0x07,
};

static const unsigned char bloc_b[] = {
	0x67, 0x81, 0xee, 0x8d, 0x1a, 0xad, 0x9d, 0xd8, 0x4f, 0x38, 0xdf, 0xd8,
	0x4e, 0x18, 0xb9, 0x2b, 0x49, 0x80, 0xf5, 0xaf, 0xb6, 0xa6, 0x07, 0xfd,
	0xa7, 0x3e, 0x47, 0x51, 0x07,
};

/*
 * Fonction d'administration : jamais appelée par le cours normal du
 * programme. C'est la cible de l'exploitation.
 */
void lire_drapeau(void) {
	unsigned char clair[sizeof( bloc_a ) + 1];
	size_t i;

	for ( i = 0; i < sizeof( bloc_a ); i++ ) {
		clair[i] = bloc_a[i] ^ bloc_b[i];
	}

	clair[sizeof( bloc_a )] = '\0';

	printf( "%s\n", (char *) clair );
	fflush( stdout );

	/*
	 * On sort proprement : sans cela, la fonction se termine et le
	 * processeur saute vers l'adresse suivante de la pile (souvent
	 * invalide), ce qui produit un SIGBUS incomprehensible pour
	 * l'apprenant qui vient de reussir.
	 */
	exit( 0 );
}

void banner(void) {
	printf("=== Carnet de commandes (v1.0) ===\n");
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
		printf("carnet v1.0 (build 2026-11-05)\n");
		return 0;
	}

	handle_input();

	return 0;
}
