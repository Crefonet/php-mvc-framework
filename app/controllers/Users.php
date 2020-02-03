<?php

  class Users extends Controller {

    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function register(){
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
          //PROCESS THE FORM

          //Sanitize the POST
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
          ];

          //Validate the date_create_from_format
          if (empty($data['name'])){
              $data['name_err'] = 'Name field Cannot be Empty';
          }

          if(empty($data['email'])){
              $data['email_err'] = 'Email field Cannot be Empty';
          }else {
            //Check if email has been taken
            if($this->userModel->findUserByEmail($data['email'])){
              $data['email_err'] = 'Email already exist. Choose another one';
            }
          }

          if(empty($data['password'])){
              $data['password_err'] = 'Password field Cannot be Empty';
          }elseif (strlen($data['password']) < 6) {
              $data['password_err'] = 'Password must at least be of 6 characters';
          }

          if(empty($data['confirm_password'])){
              $data['confirm_password_err'] = 'Confirm Password ';
          } else {
            if($data['password'] != $data['confirm_password'] ){
              $data['confirm_password_err'] = 'password does not match';
            }
          }

          // Check if there is no errors
          if( empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) ){

              //Hash the password
              $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if($this->userModel->register($data)){
                  flash('register_success', 'You are registerered Successffully');
                  redirect('users/login');
                }

            die('Success fuly made');
          } else {
            //Load with erros
              $this->view('users/register', $data);
          }

      } else {
        // call the register form
        $data =  [
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm-password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        $this->view('users/register', $data);
      }
    }

    public function login() {

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          //die('Submitted');
          //PROCESS THE FORM
          //sanitize the inputs
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => ''
          ];
          // Validate the emails and password
          if(empty($data['email'])){
            $data['email_err'] = 'Please enter your email';
          }

          if(empty($data['password'])){
            $data['password_err'] = 'Please enter your Password';
          }

          //check if the email Exist
          if($this->userModel->findUserByEmail($data['email'])){
            //User Found
          }else{
            $data['email_err'] = 'No User found!!';
          }

          if(empty($data['email_err']) && empty($data['password_err'])){
            //log user in
            //crete a session for the logged in user
            $userLoggedIn = $this->userModel->login($data['email'], $data['password']);
            if ($userLoggedIn) {
              // create a new user session
              $this->createUserSession($userLoggedIn);
            }else{
              $data['password_err'] = 'Password Incorrect';
              $this->view('users/login', $data);
            }
          } else {
            //Load views withn errors
            $this->view('users/login', $data);
          }

      } else {
        // call the register form
        $data =  [
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => ''
        ];

        $this->view('users/login', $data);
    }
  }

  public function createUserSession($user){
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->name;
    redirect('posts');
  }

  public function logout(){
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    session_destroy();
    redirect('pages/index');
  }

}
