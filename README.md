Projet tutoré Gestion d'étudiants

INSTALATION
=====================

1. Installation des dépendances :                    <b>Composer install</b>
2. Modifier le <b>.env</b> avec vos paramètres de base de données
3. Vérifier la configuration de la base de données : <b>symfony console doctrine:schema:validate</b>
4. ÉXecuter les migrations :                         <b>symfony console doctrine:migration:execute DoctrineMigrations\Version20201127115134</b> 
5. Éxecuter les données déjà créé dans les fitures : <b>symfony console doctrine:fixtures:load</b>
6. Lancer le serveur Symfony :                       <b>symfony server:start</b>