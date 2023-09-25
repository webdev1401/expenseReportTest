ExpenseReportTest
========================

Application pour gérer ses notes de frais entièrement ne mode api REST

Requirements
------------

  * PHP 8.1.0 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements][2].

Installation
------------

Vous avez 2 manières d'installer l'application

**Option 1.** Vous avez Git installé
Il vous suffit de cloner le projet

```bash
$ git clone https://github.com/webdev1401/expenseReportTest.git
```

* Modifiez, dans le fichier .env, la ligne qui correspond à la configuration de la BDD;
* vous décommentez l'une des lignes entre 26 et 29 selon votre cas
* Il faudra au préalable créer une base de donnée sur votre serveur. Pour le mot de passe de l'utilisateur de la Bdd, évitez certains caractères comme le # et ? par exemple

ensuite faire:

```bash
$ cd expenseReportTest
$ composer install
$ php bin/console doctrine:migration:migrate
```

**Option 2.** Télécharger le dossier de l'appication

* A cette url: https://prototyp.fr/apiplatformtest/expenseReportTest.zip
* décompressez le dossier à la racine de votre hébergement
* modifiez le fichier .env
