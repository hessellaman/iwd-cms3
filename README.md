# iwd-cms3
Blog with a CMS for the Introduction to Web Development course.

- Ik kreeg af en toe een Table.pages error bij het uitvoeren van composer install en php artisan migrate, maar de database werkt uiteindelijk wel gewoon.

- Voor inloggen/registratie heb ik gebruik gemaakt van php artisan make:auth volgens het filmpje “Rapid authentication and Configuration”. Ik heb dus niet de standaard manier gebruikt die hij in latere videos uitlegt. Ik heb ook een aantal packages gebruikt, die kom je vanzelf wel tegen in de code.

- Bij mij werden er in eerste instantie geen blog posts getoond wanneer ze werden aangemaakt met timestamp NOW, omdat ik een functie gebruik die ze niet laat zien wanneer de publish date in de toekomst ligt. Kennelijk is mijn phpmyadmin standaard op UTC ingesteld en niet GMT+2 waardoor ze dus niet getoond werden. Mocht dit weer gebeuren bij het maken van een nieuwe post, dan moet de publish tijd minstens 2 uur vroeger worden.

- Het beheren van het menu is geïntegreerd met het maken, bewerken en verwijderen van pagina’s, waarbij de pagina’s de items in de menubalk (navbar) vertegenwoordigen. Items kunnen worden toegevoegd en verwijderd, en de volgorde en hiërarchie (dropdowns) kan ook veranderd worden na het aanmaken ervan door ze te wijzigen (dit laatste werkt helaas nog niet tijdens het creëren van pages). Bij het wijzigen moet de volgorde ook worden aangegeven anders gaat het mis met routing.

- Een gebruiker kan zich registreren maar niet als admin. De gebruikersrollen kunnen in de backend (/admin) worden aangepast door een geautoriseerde gebruiker en gebruikers kunnen ook worden verwijderd. Het laatste zorgt momenteel echter voor problemen bij het tonen van berichten van gebruikers die dan niet meer bestaan. Dus deze feature kan voorlopig dus beter niet worden gebruikt, moet nog worden gefixt.

- Admin account:
	email: admin@admin.com
	password: password
