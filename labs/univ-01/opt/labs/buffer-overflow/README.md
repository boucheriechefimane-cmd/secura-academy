TP 3 - Buffer Overflow Exploits and Defenses (cours 6.858)
====================================================

Programme fourni : /opt/labs/buffer-overflow/vuln.c
Compilation :       gcc -fno-stack-protector -no-pie vuln.c -o vuln

Analyse du binaire (realisee par l'equipe)
--------------------------------------------
- Le programme lit une saisie avec gets() dans un buffer local.
- La compilation sans protection de pile est volontaire : on veut observer
  le mecanisme avant de le contrer.
- La valeur de retour de gets() n'est pas verifiee.

Resultats du premier essai
---------------------------
    buffer_size   = 64
    offset        = 72
    canary_value  = 0x41414141

Le programme se termine avec « *** stack smashing detected *** » quand la
saisie depasse le canari. Il faut donc reconstruire le canari avant
d'atteindre l'adresse de retour.

Offset calcule par l'equipe : FLAG=SECURA{offset_du_tp}

Rappel : le canari ne protege que si l'on ne le touche pas. Avec la valeur
ci-dessus, on peut le reecrire tel quel.
