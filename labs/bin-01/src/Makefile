# Compilation volontairement non protégée : c'est le cœur du laboratoire.
CFLAGS = -fno-stack-protector -z execstack -no-pie -fno-pie -g

all: vulnerable

vulnerable: vulnerable.c
	$(CC) $(CFLAGS) -o vulnerable vulnerable.c

clean:
	rm -f vulnerable

.PHONY: all clean
