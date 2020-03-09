# ekolo/eko-request

Librairie PHP permettant de lancer des requêtes http vers un serveur distant (par exemple vers une API)

# Installation

Pour l'installer vous devez à avoir déjà composer installé. Si ce n'est pas le cas aller sur  [Composer](https://getcomposer.org/)

```bash
$ composer require ekolo/eko-request
```

# API

```php
use Ekolo\Components\EkoRequest\APIRequest;

APIRequest::get('http://monsite:3000/users/getUsers', null, function ($results, $vars) {
    print_r($results);
});
```