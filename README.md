LetShout Test. Fernando Merino López
===============
#Enunciado
We need a small REST API called letShout, with just one endpoint, that make a Twitter account seem to shout. Given a Twitter username and a number N, returns a JSON response with user’s last N tweets in uppercase and a final exclamation mark.
For example, a tweet like “Hello this is my first Tweet” would be converted to “HELLO THIS IS MY FIRST TWEET!”.
 
- Feel free to use any frameworks or libraries you may need, even to communicate with Twitter. 
- If you want to use a framework, take into account that we use Symfony for PHP projects and Akka for Scala/Java projects.
- Your application should not save anything to MySQL or to any other relational DB.
 
Bonus:
- Improve your application’s speed by using a cache, avoiding repeated calls to Twitter’s API.
 
We like clean code:
- Code tested with unit-testing and integration testing.
- Usage of architectures and paradigms like Hexagonal Architecture and DDD.
- Usage of design patterns.
- Show off!

## Requisitos iniciales

    PHP 7.1
    Apache 2.4
    Credenciales para utilizar el API de Tweeter (incluidos los mios en services.yaml)
    Extensiones PHP: 
    Composer

## Instrucciones

1. Instalar los vendors con composer
2. Probar test

    ```php bin/console doctrine:database:drop```

    ```php bin/console doctrine:database:create```
3. Comprobar su funcionamiento por url o con POSTMAN: 

    ```http://localhost/proyectos/letshout/public/index.php/api/tweet-shout/{public_nickname}/{number}```



## Consideraciones

1. Para la prueba se ha utilizado Symfony 4
2. Se han reutilizado las llamadas curl de una librería pública en github: http://github.com/j7mbo/twitter-api-php
3. La clase TwiterParser si es propia
4. Los test unitarios se pueden probar
