Github:
https://github.com/HerrBily/diabloforum

Live server:
http://diablocom.herokuapp.com/

Wenn die Kategorien nicht funktionieren, dann muss man folgende Schritte machen.

1. im terminal php artisan tinker
2. factory('App\Category, 3)->create();
3. In der eigenen Datenbank die drei Kategorien in der categories table umändern in - Hilfe , Guide und Mitspielersuche
