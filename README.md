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

## APIRequest::get(string $url, array $vars = null, $callback = null)

Permet de lancer une requête `http` de type `GET` vers l'url passé en paramètre

* `$url` : L'url où lancer la requête
* `$vars`: Ce sont des variables qu'on veut passer à la fonction callback
* `$callback($results, $vars)`: C'est la fonction à appeler elle contient :
    * `$results` : C'est le résultat (response) reçu auprès de l'url où on a lancé la requête
    * `$vars` : Ce sont les variables qu'on a passées à la callback 
    
[Note] Si vous n'avez pas spécifié la fonction `$callbakc`, cela va retourner les `$results`

```php
use Ekolo\Components\EkoRequest\APIRequest;

$vars = [
    'response' => new Response // Juste une classe d'exemple
];

APIRequest::get('http://monsite:3000/users/getUserById/3', $vars, function ($results, $vars) {
    extract($vars);
    
    print_r($results);
    
    $response->send($results);
});
```
    
## APIRequest::post(string $url, array $data, array $vars = null, $callback = null)

Permet de lancer une requête `http` de type `POST` vers l'url passé en paramètre

* `$url` : L'url où lancer la requête
* `$data`: Ce sont les données à envoyer (poster)
* `$vars`: Ce sont des variables qu'on veut passer à la fonction callback
* `$callback($results, $vars)`: C'est la fonction à appeler elle contient :
    * `$results` : C'est le résultat (response) reçu auprès de l'url où on a lancé la requête
    * `$vars` : Ce sont les variables qu'on a passées à la callback 
    
[Note] Si vous n'avez pas spécifié la fonction `$callbakc`, cela va retourner les `$results`

```php
use Ekolo\Components\EkoRequest\APIRequest;

$user = [
    'nom' => 'Mbuyu',
    'prenom' => 'Josué',
    'email' => 'josue@js.com'
];

$vars = [
    'response' => new Response // Juste une classe d'exemple
];

APIRequest::post('http://monsite:3000/users/create', $user, $vars, function ($results, $vars) {
    extract($vars);
    
    print_r($results);
    
    $response->send($results);
});
```

## APIRequest::put(string $url, array $data, array $vars = null, $callback = null)

Permet de lancer une requête `http` de type `PUT` vers l'url passé en paramètre

* `$url` : L'url où lancer la requête
* `$data`: Ce sont les données à envoyer (poster)
* `$vars`: Ce sont des variables qu'on veut passer à la fonction callback
* `$callback($results, $vars)`: C'est la fonction à appeler elle contient :
    * `$results` : C'est le résultat (response) reçu auprès de l'url où on a lancé la requête
    * `$vars` : Ce sont les variables qu'on a passées à la callback 
    
[Note] Si vous n'avez pas spécifié la fonction `$callbakc`, cela va retourner les `$results`


```php
use Ekolo\Components\EkoRequest\APIRequest;

$user = [
    'nom' => 'Mbuyu',
    'prenom' => 'Josué',
    'email' => 'josue@mbuyu.com'
];

$vars = [
    'response' => new Response // Juste une classe d'exemple
];

APIRequest::put('http://monsite:3000/users/update/3', $user, $vars, function ($results, $vars) {
    extract($vars);
    
    print_r($results);
    
    $response->send($results);
});
```

## APIRequest::delete(string $url, array $data, array $vars = null, $callback = null)

Permet de lancer une requête `http` de type `DELETE` vers l'url passé en paramètre

* `$url` : L'url où lancer la requête
* `$data`: Ce sont les données à envoyer (poster)
* `$vars`: Ce sont des variables qu'on veut passer à la fonction callback
* `$callback($results, $vars)`: C'est la fonction à appeler elle contient :
    * `$results` : C'est le résultat (response) reçu auprès de l'url où on a lancé la requête
    * `$vars` : Ce sont les variables qu'on a passées à la callback 
    
[Note] Si vous n'avez pas spécifié la fonction `$callbakc`, cela va retourner les `$results`


```php
use Ekolo\Components\EkoRequest\APIRequest;

$vars = [
    'response' => new Response // Juste une classe d'exemple
];

APIRequest::delete('http://monsite:3000/users/delete/3', [], $vars, function ($results, $vars) {
    extract($vars);
    
    print_r($results);
    
    $response->send($results);
});
```
