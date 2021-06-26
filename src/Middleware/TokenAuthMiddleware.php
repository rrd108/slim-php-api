<?php
namespace Rrd108\SlimPhpApi\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Rrd108\SlimPhpApi\DB;

class TokenAuthMiddleware {

  private $basePath;

  public function __construct($basePath) {
    $this->basePath = $basePath;
  }

  public function __invoke(Request $request, RequestHandler $handler): Response {

    if ($request->getMethod() == 'OPTIONS') {
      return $handler->handle($request);
    }

    require __DIR__ . '/../../config/auth.php';
    if (in_array(
        str_replace($this->basePath, '', $request->getUri()->getPath()),
        $noAuthResources[$request->getMethod()])) {
      return $handler->handle($request);
    }

    // token ellenőrzés
    $token = $request->getHeaderLine('Token');
    if ($token) {
      $db = new DB();
      $pdo = $db->connect();
      $stmt = $pdo->prepare('SELECT id FROM users WHERE token = ?');
      $stmt->execute([$token]);
      if ($stmt->fetch()) {
        return $handler->handle($request);
      }
    }

    $data = ['error' => 'Authentication error'];
    $response = new Response();
    $response->getBody()->write(json_encode($data));
    return $response
      ->withHeader('content-type', 'application/json')
      ->withStatus(401);
  }
}