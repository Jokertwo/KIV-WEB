Semestrální práce z KIV/WEB.

Struktura: Databaze: Složka obsahuje sp.xml s databazí naplnenou daty pro predvedení
		     funkčnosti databáze.
	   
	   PDF: soubor obsahuje testovací pfd pro předvedení funkčnosti nahrávání souborů.

	   SP_A15B0055K : obsahuje PHP skripty samotné webové databáze

	   SP_A15B0055K/view/konstanty.inc.php : soubor kde lze nastavit připojení k databázi (SeverName, UserName, Password...).

	   Dokumentace : obsahuje dokumentaci k webové aplikaci.


Postup instalace :1. importovat sp.xml do databáze
		  2. nastavit správné připojení k databázi v SP_A15B0055K/view/konstanty.inc.php
		  3. spustit SP_A15B0055K/index.php