# setup

```
composer install
php bin/console make:migration
php bin/console doctrine:migration:migrate -n
php bin/symfony server:run
```

Pour installer les données, les fichiers SQL se trouvent dans le dossier ``database/``