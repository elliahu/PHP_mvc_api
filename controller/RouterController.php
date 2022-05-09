<?php
class RouterController extends Controller{
  /// RouterController je speciální případ controlleru, který má na starosti 
  /// vytváření instancí ostatních controllerů, podle předané url adresy
  /// --->  /Animal/1/abc
  /// řízení bude předáno controlleru AnimalController a proměnná $param
  /// ude mít hondotu ["1","abc"]

  protected $controller;
  /// aplikace bude vracet JSON, ne HTML
  protected $contentType = "application/json"; /// Content-type header

  public function get($params){
    /// nastavení content type header
    header('Content-type: ' . $this->contentType);

	  /// prázdná url /
    $pathParts = $this->parseURL($params[0]);
    if(empty($pathParts[0])){
      $this->Json(new stdClass()); // vrátí empty obj
      exit;
    }

    $controllerName = $this->camelCase(array_shift($pathParts));
    $controllerClass = $controllerName . "Controller";

    // kontrola, zda existuje controller
    if(file_exists("controller/$controllerClass.php"))
      $this->controller = new $controllerClass();
    else /// neexistujici controller
    {
			http_response_code(404);
			$this->Json(new stdClass());
			exit;
	  }

    // předání řízení nalezenému controlleru
    // zjištění typu requestu [GET, POST, PUT, DELETE]
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $this->controller->get($pathParts);
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->controller->post($pathParts);
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
      $this->controller->put($pathParts);
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
      $this->controller->delete($pathParts);
    }
    else{
      http_response_code(405); // method not allowed
			$this->Json(new stdClass());
			exit;
    }
  }

  public function post($params){}
  public function put($params){}
  public function delete($params){}

  //name-of-controler -> NameOfController
  private function camelCase($text) {
      $text = str_replace("-", " ", $text);
      $text = ucwords($text);
      $text = str_replace(" ", "", $text);
      return $text;
  }

  //Metoda pro parsování URL
  private function parseURL($url) {
      $parsedURL = parse_url($url);
      $path = $parsedURL["path"];
      $path = ltrim($path,"/");
      $path = trim($path);
      $cutPath = explode("/", $path);
      return $cutPath;
  }

}
 ?>
