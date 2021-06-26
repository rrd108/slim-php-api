<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Rrd108\SlimPhpApi\DB;
use Rrd108\SlimPhpApi\Middleware\TokenAuthMiddleware;
use Tuupola\Middleware\CorsMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/~rrd/slim-php-api');

$app->addBodyParsingMiddleware();
$app->add(new Tuupola\Middleware\CorsMiddleware([
    'origin' => ['*'],
    'methods' => ['GET', 'POST'],
    'headers.allow' => ['*'],
]));
$app->add(new TokenAuthMiddleware('/~rrd/slim-php-api'));

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write('Gauranga');
    return $response;
});

$app->get('/users', function (Request $request, Response $response, array $args) {
  // lekérjük az összes usert az adatbázisból
  $db = new DB();
  $pdo = $db->connect();
  $stmt = $pdo->prepare('SELECT * FROM users');
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $response->getBody()->write(json_encode($data));
  return $response
    ->withHeader('content-type', 'application/json')
    ->withStatus(200);
});

$app->post('/users/login', function (Request $request, Response $response, array $args) {
  $data = $request->getParsedBody();
  $db = new DB();
  $pdo = $db->connect();
  $stmt = $pdo->prepare('SELECT id, token FROM users WHERE email = ? AND password = ?');
  $stmt->execute([$data['email'], md5($data['password'])]);
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  $response->getBody()->write(json_encode($data));
  return $response
    ->withHeader('content-type', 'application/json')
    ->withStatus(200);
});

$app->get('/products', function (Request $request, Response $response, array $args) {
  $db = new DB();
  $pdo = $db->connect();
  $stmt = $pdo->prepare('SELECT * FROM products');
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $response->getBody()->write(json_encode($data));
  return $response
    ->withHeader('content-type', 'application/json')
    ->withStatus(200);
});

$app->post('/products', function (Request $request, Response $response, array $args) {
  $data = $request->getParsedBody();
  $db = new DB();
  $pdo = $db->connect();
  $stmt = $pdo->prepare('INSERT INTO products (category, name, description, picture, price, stock) VALUES (?, ?, ?, ?, ?, ?)');
  $stmt->execute([$data['category'], $data['name'], $data['description'], $data['picture'], $data['price'], $data['stock']]);
  $data['id'] = $pdo->lastInsertId();
  $response->getBody()->write(json_encode($data));
  return $response
    ->withHeader('content-type', 'application/json')
    ->withStatus(200);
});

$app->run();