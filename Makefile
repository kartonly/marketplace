### Команды для запуска приложения
first-start: build start

build: # собираем контейнеры
	docker-compose build
start: # поднимаем
	docker-compose up -d
stop: # останавливаем
	docker-compose stop

exec-nginx: # заходим в контейнер с nginx
	docker-compose exec web6-nginx bash
exec-php-fpm: # заходим в контейнер с php
	docker-compose exec web6-php-fpm bash
exec-percona: # заходим в контейнер с percona
	docker-compose exec web6-percona bash
