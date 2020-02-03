<?php

  class Controller {
    // Loads the Model

    public function model($model) {
      //require the model
      require_once '../app/models/' .$model. '.php';
      //Instantiate the model
      return new $model();
    }

    //Loads the View
    public function view($view, $data = []){
      // check if file exists in the views folder
      if(file_exists('../app/views/' .$view. '.php')){
        require_once '../app/views/' .$view. '.php';
      } else {
        die('View does not Exist');
      }
    }

  }
