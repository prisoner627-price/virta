up:
	docker-compose up -d

build:
	docker-compose up -d --build

destroy:
	docker-compose down

install:
	docker-compose exec app composer install

shell:
	docker-compose exec app bash
