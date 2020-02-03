<?php

  class Core {

    //Set the properties
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
      $url = $this->getUrl();

      // Check if the Controller file exist
      if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      }
      //Require the Controller
      require_once '../app/controllers/'.$this->currentController.'.php';
      //Instantiate the method
      $this->currentController = new $this->currentController;

      // Check for the method
      if(isset($url[1])){
        if(method_exists($this->currentController, $url[1])){
          $this->currentMethod = $url[1];
          unset($url[1]);
        }
     }

     // check for params
      $this->params = $url ? array_values($url) : [];

      //call the array function
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    //get the Url
    public function getUrl(){
      //$url = $_GET['url'];
      if(isset($_GET['url'])){
        // right trim the url
          $url = rtrim($_GET['url'], '/');
          //Filter the url
          $url = filter_var($url, FILTER_SANITIZE_URL);
          // explode the url
          $url = explode('/', $url);
          return $url;
        }
      }

  }
