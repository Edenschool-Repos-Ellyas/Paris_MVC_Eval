<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    class Users extends Controller
    {
        private $userModel;

        public function __construct()
        {
            $this->userModel = $this->loadModel('User');
        }

        // SET / GET

        public function getAdress()
        {
            # code...
        }

        public function login()
        {
            $data = [
                'title' => 'Login page',
                'firstname' => '',
                'laststname' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];

            // Vérifie si méthode POST est utilisé
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'emailError' => '',
                    'passwordError' => ''
                ];

                if(empty($data['email'])){
                    $data['emailError'] = 'Veuillez entrer un email';
                }

                if(empty($data['password'])){
                    $data['passwordError'] = 'Veuillez entrer un password';
                }

                if(empty($data['emailError']) && empty($data['passwordError'])){
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                    if($loggedInUser){
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['passwordError'] = 'email ou password incorrect. Ressayez !!!';
                        $this->render('/users/login', $data);
                    }
                }
            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'emailError' => '',
                    'passwordError' => ''
                ];
            }
            $this->render('users/login', $data);
        }

        public function register()
        {
            $data = [
                'firstname' => '',
                'lastname' => '',
                'email' => '',
                'password' => '',
                'firstnameError' => '',
                'lastnameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPassword' => '',
                'confirmPasswordError' => ''
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'firstname' => trim($_POST['firstname']),
                    'lastname' => trim($_POST['lastname']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirmPassword' => trim($_POST['confirmPassword']),
                    'firstnameError' => '',
                    'lastnameError' => '',
                    'emailError' => '',
                    'passwordError' => '',
                    'confirmPasswordError' => ''
                ];

                // Validation username & email
                $nameValidation = "/^[a-zA-Z0-9]*$/";
                $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

                if(empty($data['email'])){
                    $data['emailError'] = 'Veuillez entrer un email';
                } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['emailError'] = 'Veuillez entrer un email au bon format !!';
                } else {
                    if($this->userModel->findUserbyEmail($data['email'])){
                        $data['emailError'] = 'Email déjà utilisé !!';
                    }
                }

                if(empty($data['password'])){
                    $data['passwordError'] = 'Veuillez entrer un password';
                } elseif(strlen($data['password']) < 6) {
                    $data['passwordError'] = 'Le mot de passe doit contenir au moins 8 caractères';
                } elseif(preg_match($passwordValidation, $data['password'])){
                    $data['passwordError'] = 'Le mot de passes doit contenir au moins 1 chiffre';
                }

                if(empty($data['confirmPassword'])){
                    $data['confirmPasswordError'] = 'Veuillez entrer la confirmation de mot de passe';
                } else {
                    if($data['password'] != $data['confirmPassword']){
                        $data['confirmPasswordError'] = 'Les mot de passe ne correspondent pas !';
                    }
                }

                if(empty($data['firstnameError']) && empty($data['lastnameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])){
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    if($this->userModel->register($data)){
                        header("Location: ".URL_ROOT."/users/login");
                    } else {
                        die('Une erreur est survenue !!');
                    }
                }
            }
            $this->render('/users/register', $data);
        }

        public function createUserSession($loggedInUser)
        {
            $_SESSION['user_id'] = $loggedInUser->user_id;
            $_SESSION['firstname'] = $loggedInUser->firstname;
            $_SESSION['lastname'] = $loggedInUser->lastname;
            $_SESSION['email'] = $loggedInUser->email;
            $_SESSION['role'] = $loggedInUser->role;
            header('Location: '.URL_ROOT.'/index');
        }

        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['firstname']);
            unset($_SESSION['lastname']);
            unset($_SESSION['email']);
            unset($_SESSION['role']);
            header('Location: '.URL_ROOT.'/users/login');
        }

        public function profile($id)
        {
            if (!empty($id)) {
                // si l'id n'est pas vide
                $user = $this->userModel->findUserById($id);
            }else{
                if(!isLoggedIn()) {
                    header("Location: " . URL_ROOT . "/users/login");
                }
                $id = $_SESSION["user_id"];
            }
            $user = $this->userModel->findUserById($id);
            $articles = $this->userModel->findUserArticles($id);

            $data = [
                'user' => $user,
                'articles' => $articles,
                'journal_name' => '',
                'picture' => '',
                'bio' => '',
                'hobbies' => '',
                'journal_nameError' => '',
                
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                
                $data = [
                    'user' => $user,
                    'journal_name' => trim($_POST["journal_name"]),
                    'picture' => trim($_POST["picture"]),
                    'bio' => trim($_POST["bio"]),
                    'hobbies' => trim($_POST["hobbies"]),
                    'journal_nameError' => '',

                ];
                
                
                if(empty($data['journal_name'])) {
                    $data['journal_nameError'] = 'The journal name cannot be empty';
                }

                if (empty($data['journal_nameError'])) {
                    if ($this->userModel->updateUser($data)) {
                        header("Location: " . URL_ROOT . "/users/profile/" . $_SESSION["user_id"]);
                    } else {
                        die("Something went wrong, please try again!");
                    }
                } else {
                    $this->render('users/profile', $data);
                }
            }

            $this->render('users/profile', $data);
        }

    }