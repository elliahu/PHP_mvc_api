<?php
  abstract class Controller{

    //abstraktní třída kontroler
    protected $view = ""; /// poku předává view
    protected $data = array();

    // Využívá REST api

    //abstraktní metoda GET
    abstract function get($params);

    //abstraktní metoda POST
    abstract function post($params);

    //abstraktní metoda PUT
    abstract function put($params);

    //abstraktní metoda DELTE
    abstract function delete($params);


    /// vyrenderuje JSON
    protected function Json($object){
      echo json_encode($object);
    }

    /// https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
    
    protected function Ok($object){
      http_response_code(200);
      $this->Json($object);
    }

    protected function BadRequest($object){
      http_response_code(400);
      $this->Json($object);
    }

    protected function Error($object){
      http_response_code(500);
      $this->Json($object);
    }

    /** metoda pro vypsání pohledu
     * @deprecated 
     */
    public function renderView(){
      extract($this->data);
      if($this->view)
        require_once("view/{$this->view}.phtml");
    }

    //metoda pro přesměrování
    public function redirect($target){
      header("Location: /$target");
      exit();
    }

    // metoda pro testovaní session
    // pokud bude třeba login 
    public function sessionCheck(){
      if(isset($_SESSION["login"]) && $_SESSION["login"] == true){
        return true;
      }
      else{
        return false;
      }
    }
  }
 ?>
