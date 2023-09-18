ExepnseReportTest
========================

Application pour gérer ses notes de frais entièrement ne mode api REST

Requirements
------------

  * PHP 8.1.0 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements][2].

Installation
------------

Vous avez 2 amnières d'installer l'application

**Option 1.** Vous avez Git installé
Il vous suffi de cloner le projet

```bash
$ git clone git@github.com:webdev1401/expenseReportTest.git
$ composer install
$ cd expenseReportTest
$ mv .env .env.local
```
Modifiez, dans le fichier .env.local, la ligne qui correspond à la configuration de la BDD; vous décommentez l'une des lignes entre 26 et 29 selon votre cas
Il faudra au préalable créer une base de donnée sur votre serveur
ensuite faire:

```bash
$ php bin/console doctrine:migration:migrate
```

**Option 2.** Télécharger le dossier de l'appication
Un lien sera fournis avec le dossier de l'application complète
