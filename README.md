# API COLORS
He creado una API de colores, con la lógica del "negocio" fuera de la aplicación. He creado diferentes casos de uso mediante CQRS.  
Se ha utilizado docker para levantar los entornos de trabajo. Y se está trabajando en el desarrollo de test mediante PhpUnit.

## 🖇️ API COLORS END-POINTS
- http://localhost:33000/doc/api (📚 API DOC)
- [POST] -> http://localhost:33000/api/color/create (CREATE COLOR)
- [DELETE] -> http://localhost:33000/api/color/delete/{colorId} (DELETE COLOR)
- [GET] -> http://localhost:33000/api/color/show/{colorId} (SHOW COLOR)
- [POST] -> http://localhost:33000/api/color/compare (COMPARE COLOR)

## 📚 Made with
- PHP 8.1
- DDD
- Swagger API DOC (NelmioApiDocBundle)
- Hexagonal Architecture (Ports and Adapters)
- CQRS
- Docker
- Testing with PHPUnit (en proceso)

## 🚀 Main Instructions
- Launch docker containers: `docker-compose up -d`
- On the first run, install dependencies: `docker-compose exec php-fpm bash` and then `composer install`
