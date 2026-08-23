docker compose exec app composer lint
docker compose exec app composer format
docker compose exec app composer test

(docker compose exec app composer update)
docker compose exec app composer dump-autoload
- to refresh directory hierarchy for php


docker compose exec app php demo.php