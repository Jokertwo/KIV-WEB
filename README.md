#KIV-WEB
<h1>Semestrální práce z Webových aplikací</h1>

<h3>1 Technologie</h3>

Povinně HTML5, CSS, PHP, MySQL (nebo jiná databáze) + volitelně šablony, JavaScript, AJAX apod.

<h3>2 Zadání samostatné práce</h3>
<ul>
<li>Vaším úkolem bude vytvořit webové stránky konference.  Téma konference si můžete zvolit libovolné.</li>
<li>Uživateli systému budou autoři příspěvků (vkládají abstrakty a PDF dokumenty), recenzenti příspěvků 
(hodnotí příspěvky) a administrátoři (spravují uživatele, přiřazují příspěvky recenzentům a rozhodují
o publikování příspěvků). Každý uživatel se bude do systému přihlašovat prostřednictvím uživatelského
jména a hesla. Nepřihlášený uživatel vidí pouze publikované příspěvky.</li>
<li>Nový uživatel se bude moci zaregistrovat, čímž získá status autora.</li>
<li>Přihlášený autor vidí svoje příspěvky a stav, ve kterém se nacházejí (v recenzním řízení / přijat +hodnocení / odmítnut +hodnocení). 
Příspěvky může přidávat, editovat a volitelně i mazat.</li>
<li>Přihlášený recenzent vidí příspěvky, které mu byly přiděleny k recenzi, a může je hodnotit (alespoň 3 kritéria). 
Pokud příspěvek nebyl dosud schválen, tak své hodnocení může změnit.</li>
<li>Administrátor spravuje uživatele (určuje jejich role a může uživatele zablokovat či smazat),
přiřazuje neschválené příspěvky recenzentům k ohodnocení (každý příspěvek bude recenzován minimálně třemi recenzenty)
a na základě recenzí rozhoduje o přijetí nebo odmítnutí příspěvku. Přijaté příspěvky jsou automaticky publikovány
ve veřejné části webu.</li>
<li>Databáze musí obsahovat alespoň 3 tabulky dostatečně naplněné daty 
pro předvedení funkčnosti aplikace.</li>
</ul>

<h3>3 Nutné požadavky na všechny samostatné práce</h3>
<ul>
    <li>Práce musí být osobně předvedena cvičícímu a po schválení odevzdána na CourseWare či Portál.</li>
   <li> K práci musí být dodána dokumentace (viz dále) a skripty pro instalaci databáze (např. získané exportem databáze).</li>
    <li>Web musí dodržovat MVC architekturu.</li>
    <li>Pro práci s databází musí být využito PDO nebo jeho ekvivalent a používány předpřipravené dotazy (prepared statements).</li>
   <li> Web musí obsahovat responzivní design.</li>
   <li> Web musí obsahovat ošetření proti základním typům útoku (XSS, SQL injection).</li>
   <li> Web musí fungovat i s "ošklivými" URL adresami.</li>
</ul>
<h3>3.1 Dokumentace</h3>

K práci vytvořte dokumentaci, která bude obsahovat:
<ul>
    <li>Vaše jméno,  URL vytvořených stránek (pokud jsou na serveru students.kiv.zcu.cz), Váš email, datum vytvoření, název práce.</li>
   <li> popis použitých technologií - uveďte hlavně, v které části jste kterou technologii použili.</li>
   <li> popis adresářové struktury aplikace - co je v kterých adresářích a souborech.</li>
   <li> popis architektury aplikace - co mají na starosti které třídy (popř. lze využít i UML diagramy).</li>
   <li> u alternativního zadání uveďte celé, cvičícím schválené zadání práce.</li>
</ul>
