Carnet - Format String Exploits (pwn.college)
=========================================

Le probleme
-----------
    printf(user_input);   // Dangereux
    printf("%s", user_input);   // Correct

Specificateurs utiles
---------------------
    %x      lit un mot en hexadecimal dans la pile
    %p      lit un pointeur
    %s      lit une chaine a l'adresse lue
    %n      ECRIT le compteur de caracteres a l'adresse lue

Fuite d'adresse
---------------
    specifier_count = FLAG=SECURA{printf_parle_trop}
    format          = %p.%p.%p.%p.%p.%p.%p.%p

En empilant des %p, le programme crache les adresses qu'il a en memoire :
de la on recalcule la base du programme et celle de la bibliotheque
(ASLR bypass).

Ecriture arbitraire
-------------------
Avec %n, on ecrit une valeur choisie a une adresse choisie : on peut
ecraser une entree de table de sauts, un pointeur de fonction ou le GOT.

Regle : le format doit toujours etre une constante.
