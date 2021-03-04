<?php
/**
 * Class Posts
 * Gère les articles du blog.
 */
class Articles extends Controller {
    /**
     * @var mixed
     */
    private $articleModel;

    /**
     * Posts constructor
     * Charge le model des articles
     */
    public function __construct() {
        $this->articleModel = $this->loadModel('Article');
        $this->categories = $this->articleModel->findAllCategories();
    }

    /**
     * Récupère tous les articles et les retourne à la vue.
     */
    public function index() {
        $articles = $this->articleModel->findAllArticles();

        // changer pour afficher les catégories
        $users = $this->articleModel->findAllUsers();
        $data = [
            'articles' => $articles,
            'users' => $users,
        ];

        $data["categories"] = $this->categories;
        $this->render('articles/index', $data);
    }

    public function categories(){
        $categories = $this->articleModel->findAllCategories();
        $data = [
            'categories' => $categories,
        ];

        $this->render('articles/categories', $data);
    }

    public function category($id){
        $category = $this->articleModel->findCategoryById($id);
        $articles = $this->articleModel->findAllArticlesByCategory($category);
        $data = [
            'category' => $category,
            'articles' => $articles
        ];
        
        
        $data["categories"] = $this->categories;
        $this->render('articles/category', $data);
    }

    public function filter($filter)
    {   
        if (is_numeric($filter)) {
            $articles = $this->articleModel->findAllArticlesByUsersId($filter);
        }else{
            $articles = $this->articleModel->findAllArticlesByFilter($filter);
        }

        $types = $this->articleModel->findAllTypes();
        $users = $this->articleModel->findAllUsers();
        $data = [
            'articles' => $articles,
            'types' => $types,
            'users' => $users,
        ];
        $data["categories"] = $this->categories;
        $this->render('articles/filter', $data);
    }

	
    public function create()
    {
        if (!isLoggedIn()) {
            header("Location: " . URL_ROOT . '/articles');
        }

        $data = [
            'article_name' => '',
            'type' => '',
            'color' => '',
            'size' => '',
            'price' => '',
            'article_nameError' => '',
            'typeError' => '',
            'colorError' => '',
            'sizeError' => '',
            'priceError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'article_name' => trim($_POST['article_name']),
                'type' => trim($_POST["type"]),
                'color' => trim($_POST['color']),
                'size' => trim($_POST['size']),
                'price' => trim($_POST['price']),
                'article_nameError' => '',
                'typeError' => '',
                'colorError' => '',
                'sizeError' => '',
                'priceError' => ''
            ];

            if(empty($data['article_name'])) {
                $data['article_nameError'] = 'The article_name of a article cannot be empty';
            }
            if(empty($data['type'])) {
                $data['typeError'] = 'The type of a article cannot be empty';
            }
            if(empty($data['color'])) {
                $data['colorError'] = 'The color of a article cannot be empty';
            }
            if(empty($data['size'])) {
                $data['sizeError'] = 'The size of a article cannot be empty';
            }
            if(empty($data['price'])) {
                $data['priceError'] = 'The price of a article cannot be empty';
            }

            if (empty($data['article_nameError']) && empty($data['colorError']) && empty($data['sizeError']) && empty($data['typeError']) && empty($data['priceError'])) {
                if ($this->articleModel->addArticle($data)) {
                    header("Location: " . URL_ROOT . '/articles');
                } else {
                    die("Quelque chose c'est mal passé ! Réessayer");
                }
            } else {
                $data["categories"] = $this->categories;
                $this->render('articles/create', $data);
            }
        }
        $data["categories"] = $this->categories;
        $this->render('articles/create', $data);
    }
    

    /** 
     * Fonction update
     */
    public function update($id) 
    {
        $article = $this->articleModel->findArticleById($id);

        if(!isLoggedIn()) {
            header("Location: " . URL_ROOT . "/articles");
        } elseif($article->user_id != $_SESSION['user_id']){
            header("Location: " . URL_ROOT . "/articles");
        }

        $data = [
            'article' => $article,
            'article_name' => '',
            'type' => '',
            'color' => '',
            'size' => '',
            'price' => '',
            'article_nameError' => '',
            'typeError' => '',
            'colorError' => '',
            'sizeError' => '',
            'priceError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id_article' => $id,
                'article' => $article,
                'user_id' => $_SESSION['user_id'],
                'article_name' => trim($_POST['article_name']),
                'type' => trim($_POST['type']),
                'color' => trim($_POST['color']),
                'size' => trim($_POST['size']),
                'price' => trim($_POST['price']),
                'article_nameError' => '',
                'typeError' => '',
                'colorError' => '',
                'sizeError' => '',
                'priceError' => ''
            ];

            if(empty($data['article_name'])) {
                $data['article_nameError'] = 'The article_name of a article cannot be empty';
            }
            if(empty($data['type'])) {
                $data['typeError'] = 'The type of a article cannot be empty';
            }
            if(empty($data['color'])) {
                $data['colorError'] = 'The color of a article cannot be empty';
            }
            if(empty($data['size'])) {
                $data['sizeError'] = 'The size of a article cannot be empty';
            }
            if(empty($data['price'])) {
                $data['priceError'] = 'The price of a article cannot be empty';
            }

            if($data['article_name'] == $this->articleModel->findArticleById($id)->article_name) {
                $data['article_nameError'] == 'At least change the article_name!';
            }
            if($data['type'] == $this->articleModel->findArticleById($id)->type) {
                $data['typeError'] == 'At least change the type!';
            }
            if($data['color'] == $this->articleModel->findArticleById($id)->color) {
                $data['colorError'] == 'At least change the Color!';
            }
            if($data['size'] == $this->articleModel->findArticleById($id)->size) {
                $data['sizeError'] == 'At least change the Size!';
            }
            if($data['price'] == $this->articleModel->findArticleById($id)->price) {
                $data['priceError'] == 'At least change the price!';
            }

            if (empty($data['article_nameError']) && empty($data['colorError']) && empty($data['sizeError']) && empty($data['priceError']) && empty($data['priceError'])) {
                if ($this->articleModel->updateArticle($data)) {
                    header("Location: " . URL_ROOT . "/articles");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $data["categories"] = $this->categories;
                $this->render('articles/update', $data);
            }
        }

        $data["categories"] = $this->categories;
        $this->render('articles/update', $data);
    }
    
    /**
     * Fonction de suppresion de article
     */
    public function delete($id) 
    {
        $article = $this->articleModel->findArticleById($id);

        if(!isLoggedIn()) {
            header("Location: " . URL_ROOT . "/articles");
        } elseif($article->user_id != $_SESSION['user_id']){
            header("Location: " . URL_ROOT . "/articles");
        }

        $data = [
            'article' => $article,
            'article_name' => '',
            'price' => '',
            'article_nameError' => '',
            'priceError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->articleModel->deleteArticle($id)) {
                header("Location: " . URL_ROOT . "/articles");
            } else {
                die('Something went wrong!');
            }
        }
    }
    
    public function show($id)
    {
        $article = $this->articleModel->findArticleById($id);
        $comments = $this->articleModel->findAllCommentsOfArticle($article->art_id);

        $data = [
            'article' => $article,
            'comments' => $comments,
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $createComment = [
                'user_id' => $_SESSION["user_id"],
                "art_id" => $data["article"]->art_id,
                "body" => trim($_POST["body"])
            ];

            if (!empty($createComment["user_id"])) {
                $this->articleModel->addComment($createComment);
                // array_push($data, $createComment);
                header("Location: " . URL_ROOT . "/articles/show/" . $id);
            }
            unset($_POST["body"]);

        }

        
        $data["categories"] = $this->categories;
        $this->render('articles/show', $data);
    }
	
}
