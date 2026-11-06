Carnet de memoire - refresher assembleur (pwn.college)
=====================================================

Les trois choses qui bougent en permanence
-----------------------------------------
1. Les donnees
2. Les adresses
3. Le compteur de programme

Registres utiles (x86-64)
--------------------------
    rax, rbx, rcx, rdx   : usage general
    rdi, rsi, rdx         : arguments (convention System V)
    rsp                  : pointeur de pile
    rbp                  : pointeur de base

La pile
-------
Vers le bas (adresses decroissantes). A chaque appel de fonction :

    [adresse de retour]      <- la cible du debordement
    [canari]
    [variables locales]
    [buffer]
    [rsp]

Exercice du carnet
------------------
    buffer_size   = 32
    canary_size   = 8
    offset_to_return_address = 40
    notes         = a determiner par l'eleve (canary_size / 8)

Pour verifier : 32 octets de buffer + 8 octets de canari = 40 octets
avant l'adresse de retour.
