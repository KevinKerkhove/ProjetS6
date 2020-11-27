Projet tutoré Gestion d'étudiants

INSTALATION
=====================

1. Installation des dépendances : Composer install
2. Modifier le .env avec vos paramètres de base de données
3. Vérifier la configuration de la base de données : <b>symfony console doctrine:schema:validate</b>
4. ÉXecuter les migrations : symfony console doctrine:migration:execute DoctrineMigrations\Version20201127115134 
5. Éxecuter les données déjà créé dans les fitures : symfony console doctrine:fixtures:load
6. Lancer le serveur Symfony : symfony server:start