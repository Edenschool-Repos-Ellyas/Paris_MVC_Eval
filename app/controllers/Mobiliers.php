<?php
/**
 * Class Posts
 * Gère les articles du blog.
 */
class Mobiliers extends Controller {
    /**
     * @var mixed
     */
    private $mobilierModel;

    /**
     * Posts constructor
     * Charge le model des articles
     */
    public function __construct() {
        $this->mobilierModel = $this->loadModel('Mobilier');
    }

    /**
     * Récupère tous les articles et les retourne à la vue.
     */
    public function index() {
        $mobiliers = $this->mobilierModel->findAllMobiliers();
        $types = $this->mobilierModel->findAllTypes();
        $users = $this->mobilierModel->findAllUsers();
        $data = [
            'mobiliers' => $mobiliers,
            'types' => $types,
            'users' => $users,
        ];

        $this->render('mobiliers/index', $data);
    }

    public function filter($filter)
    {   
        if (is_numeric($filter)) {
            $mobiliers = $this->mobilierModel->findAllMobiliersByUsersId($filter);
        }else{
            $mobiliers = $this->mobilierModel->findAllMobiliersByFilter($filter);
        }

        $types = $this->mobilierModel->findAllTypes();
        $users = $this->mobilierModel->findAllUsers();
        $data = [
            'mobiliers' => $mobiliers,
            'types' => $types,
            'users' => $users,
        ];
        $this->render('mobiliers/filter', $data);
    }

	
    public function create()
    {
        if (!isLoggedIn()) {
            header("Location: " . URL_ROOT . '/mobiliers');
        }

        $data = [
            'mobilier_name' => '',
            'type' => '',
            'color' => '',
            'size' => '',
            'price' => '',
            'mobilier_nameError' => '',
            'typeError' => '',
            'colorError' => '',
            'sizeError' => '',
            'priceError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'mobilier_name' => trim($_POST['mobilier_name']),
                'type' => trim($_POST["type"]),
                'color' => trim($_POST['color']),
                'size' => trim($_POST['size']),
                'price' => trim($_POST['price']),
                'mobilier_nameError' => '',
                'typeError' => '',
                'colorError' => '',
                'sizeError' => '',
                'priceError' => ''
            ];

            if(empty($data['mobilier_name'])) {
                $data['mobilier_nameError'] = 'The mobilier_name of a mobilier cannot be empty';
            }
            if(empty($data['type'])) {
                $data['typeError'] = 'The type of a mobilier cannot be empty';
            }
            if(empty($data['color'])) {
                $data['colorError'] = 'The color of a mobilier cannot be empty';
            }
            if(empty($data['size'])) {
                $data['sizeError'] = 'The size of a mobilier cannot be empty';
            }
            if(empty($data['price'])) {
                $data['priceError'] = 'The price of a mobilier cannot be empty';
            }

            if (empty($data['mobilier_nameError']) && empty($data['colorError']) && empty($data['sizeError']) && empty($data['typeError']) && empty($data['priceError'])) {
                if ($this->mobilierModel->addMobilier($data)) {
                    header("Location: " . URL_ROOT . '/mobiliers');
                } else {
                    die("Quelque chose c'est mal passé ! Réessayer");
                }
            } else {
                $this->render('mobiliers/create', $data);
            }
        }
        $this->render('mobiliers/create', $data);
    }
    

    /** 
     * Fonction update
     */
    public function update($id) 
    {
        $mobilier = $this->mobilierModel->findMobilierById($id);

        if(!isLoggedIn()) {
            header("Location: " . URL_ROOT . "/mobiliers");
        } elseif($mobilier->user_id != $_SESSION['user_id']){
            header("Location: " . URL_ROOT . "/mobiliers");
        }

        $data = [
            'mobilier' => $mobilier,
            'mobilier_name' => '',
            'type' => '',
            'color' => '',
            'size' => '',
            'price' => '',
            'mobilier_nameError' => '',
            'typeError' => '',
            'colorError' => '',
            'sizeError' => '',
            'priceError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id_mobilier' => $id,
                'mobilier' => $mobilier,
                'user_id' => $_SESSION['user_id'],
                'mobilier_name' => trim($_POST['mobilier_name']),
                'type' => trim($_POST['type']),
                'color' => trim($_POST['color']),
                'size' => trim($_POST['size']),
                'price' => trim($_POST['price']),
                'mobilier_nameError' => '',
                'typeError' => '',
                'colorError' => '',
                'sizeError' => '',
                'priceError' => ''
            ];

            if(empty($data['mobilier_name'])) {
                $data['mobilier_nameError'] = 'The mobilier_name of a mobilier cannot be empty';
            }
            if(empty($data['type'])) {
                $data['typeError'] = 'The type of a mobilier cannot be empty';
            }
            if(empty($data['color'])) {
                $data['colorError'] = 'The color of a mobilier cannot be empty';
            }
            if(empty($data['size'])) {
                $data['sizeError'] = 'The size of a mobilier cannot be empty';
            }
            if(empty($data['price'])) {
                $data['priceError'] = 'The price of a mobilier cannot be empty';
            }

            if($data['mobilier_name'] == $this->mobilierModel->findMobilierById($id)->mobilier_name) {
                $data['mobilier_nameError'] == 'At least change the mobilier_name!';
            }
            if($data['type'] == $this->mobilierModel->findMobilierById($id)->type) {
                $data['typeError'] == 'At least change the type!';
            }
            if($data['color'] == $this->mobilierModel->findMobilierById($id)->color) {
                $data['colorError'] == 'At least change the Color!';
            }
            if($data['size'] == $this->mobilierModel->findMobilierById($id)->size) {
                $data['sizeError'] == 'At least change the Size!';
            }
            if($data['price'] == $this->mobilierModel->findMobilierById($id)->price) {
                $data['priceError'] == 'At least change the price!';
            }

            if (empty($data['mobilier_nameError']) && empty($data['colorError']) && empty($data['sizeError']) && empty($data['priceError']) && empty($data['priceError'])) {
                if ($this->mobilierModel->updateMobilier($data)) {
                    header("Location: " . URL_ROOT . "/mobiliers");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->render('mobiliers/update', $data);
            }
        }

        $this->render('mobiliers/update', $data);
    }
    
    /**
     * Fonction de suppresion de mobilier
     */
    public function delete($id) 
    {
        $mobilier = $this->mobilierModel->findMobilierById($id);

        if(!isLoggedIn()) {
            header("Location: " . URL_ROOT . "/mobiliers");
        } elseif($mobilier->user_id != $_SESSION['user_id']){
            header("Location: " . URL_ROOT . "/mobiliers");
        }

        $data = [
            'mobilier' => $mobilier,
            'mobilier_name' => '',
            'price' => '',
            'mobilier_nameError' => '',
            'priceError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->mobilierModel->deleteMobilier($id)) {
                header("Location: " . URL_ROOT . "/mobiliers");
            } else {
                die('Something went wrong!');
            }
        }
    }
    
    public function show($id)
    {
        $mobilier = $this->mobilierModel->findMobilierById($id);
        $comments = $this->mobilierModel->findAllCommentsOfMobilier($mobilier->id_mobilier);

        $data = [
            'mobilier' => $mobilier,
            'comments' => $comments,
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $createComment = [
                'user_id' => $_SESSION["user_id"],
                "mobilier_id" => $data["mobilier"]->id_mobilier,
                "text_content" => trim($_POST["text_content"])
            ];

            if (!empty($createComment)) {
                $this->mobilierModel->addComment($createComment);
                // array_push($data, $createComment);
                header("Location: " . URL_ROOT . "/mobiliers/show/" . $id);
            }
            unset($_POST["text_content"]);

        }

        

        $this->render('mobiliers/show', $data);
    }
	
}
