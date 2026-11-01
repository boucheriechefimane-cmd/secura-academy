Notes du TP - Memory Errors: Smashing the Stack (pwn.college)
===============================================================

Programme : /home/ctf/pwn/vuln (compile sans stack protector)
Methode : ecrire un motif reconnaissable, observer le plantage, affiner.

Resultats de l'equipe
----------------------
    motif_utilise        = AAAA...AAAA
    crash_offset         = 72
    canary_value         = 0x41414141
    stack_protector      = desactive
    aslr                 = actif (adressesvariables)

Ordre de travail
----------------
1. Trouver l'offset exact (72 octets).
2. Reecrire le canari avec sa valeur d'origine.
3. Placer l'adresse visee a la place de l'adresse de retour.

Valeur de canari utilisee par le programme du TP : FLAG=SECURA{canari_connu}
