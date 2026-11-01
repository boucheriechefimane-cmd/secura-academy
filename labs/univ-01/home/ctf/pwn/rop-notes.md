TP - Return Oriented Programming (pwn.college)
=============================================

NX est actif : la pile n'est pas executable. On ne depose donc pas de
shellcode. On recycle des morceaux de code deja presents (les gadgets),
qui se terminent par `ret`.

Chaine construite par l'equipe
------------------------------
    chain_length   = FLAG=SECURA{chainage_de_gadgets}
    gadgets         = pop rdi ; ret
                     pop rsi ; ret
                     pop rdx ; ret
                     syscall ; ret
    ordre          = remplissage -> pop rdi (adresse de "/bin/sh")
                     -> pop rsi (0) -> pop rdx (0) -> syscall

Ce que le cours rappelle
------------------------
Le ROP ne cree pas de code : il ecrit un programme avec des codes de
retour. C'est plus technique que le debordement classique, pas impossible.
Outils : ROPgadget, pwntools.
