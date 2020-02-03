<?php

 class Pages extends Controller {

    public function __construct(){

    }

    public function index(){
      if(isLoggedIn()){
        redirect('posts/index');
      }
      $data = [
        'title' => 'Welcome to Share Posts',
        'description' => 'A platform for all persons interested in writing and Learning new things'
      ];

      $this->view('pages/index', $data);
    }

    public function about(){

      $data = [
        'title' => 'About Page',
        'about' => '1.0.00',
        'created' => 'Chinedu Enebeli'

      ];

      $this->view('pages/about', $data);

    }

 }
