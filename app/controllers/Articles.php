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
    
    public function gallery()
    {
        $articles = $this->articleModel->findAllArticles();
        $data = [
            "articles" => $articles
        ];
        $this->render('articles/gallery', $data);
    }

    public function filter($filter)
    {   
        if (is_numeric($filter)) {
            $articles = $this->articleModel->findAllArticlesByUsersId($filter);
        }else{
            $articles = $this->articleModel->findAllArticlesByFilter($filter);
        }

        $slugs = $this->articleModel->findAllTypes();
        $users = $this->articleModel->findAllUsers();
        $data = [
            'articles' => $articles,
            'slugs' => $slugs,
            'users' => $users,
        ];
        $data["categories"] = $this->categories;
        $this->render('articles/filter', $data);
    }

	
    public function create()
    {
        if (!isLoggedIn() || isUser() || isAnonymous()) {
            header("Location: " . URL_ROOT . '/articles');
        }

        $data = [
            'cat_id' => '',
            'title' => '',
            'slug' => '',
            'image' => '',
            'description' => '',
            'body' => '',
            'cat_idError' => '',
            'titleError' => '',
            'slugError' => '',
            'imageError' => '',
            'descriptionError' => '',
            'bodyError' => '',
            
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'cat_id' => trim($_POST["cat_id"]),
                'title' => trim($_POST["title"]),
                'slug' => trim($_POST["slug"]),
                'image' => trim($_POST["image"]),
                'description' => trim($_POST["description"]),
                'body' => trim($_POST["body"]),
                'cat_idError' => '',
                'titleError' => '',
                'slugError' => '',
                'imageError' => '',
                'descriptionError' => '',
                'bodyError' => '',
            ];

            if(empty($data['cat_id'])) {
                $data['titleError'] = 'The title of a article cannot be empty';
            }
            if(empty($data['title'])) {
                $data['titleError'] = 'The title of a article cannot be empty';
            }
            if(empty($data['slug'])) {
                $data['slugError'] = 'The slug of a article cannot be empty';
            }
            if(empty($data['image'])) {
                $data['imageError'] = 'The image of a article cannot be empty';
            }
            if(empty($data['description'])) {
                $data['descriptionError'] = 'The description of a article cannot be empty';
            }
            if(empty($data['body'])) {
                $data['bodyError'] = 'The body of a article cannot be empty';
            }

            if (empty($data['cat_idError']) && empty($data['titleError']) && empty($data['imageError']) && empty($data['descriptionError']) && empty($data['slugError']) && empty($data['bodyError'])) {
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
            'title' => '',
            'slug' => '',
            'image' => '',
            'description' => '',
            'body' => '',
            'titleError' => '',
            'slugError' => '',
            'imageError' => '',
            'descriptionError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id_article' => $id,
                'article' => $article,
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'slug' => trim($_POST['slug']),
                'image' => trim($_POST['image']),
                'description' => trim($_POST['description']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'slugError' => '',
                'imageError' => '',
                'descriptionError' => '',
                'bodyError' => ''
            ];

            if(empty($data['title'])) {
                $data['titleError'] = 'The title of a article cannot be empty';
            }
            if(empty($data['slug'])) {
                $data['slugError'] = 'The slug of a article cannot be empty';
            }
            if(empty($data['image'])) {
                $data['imageError'] = 'The image of a article cannot be empty';
            }
            if(empty($data['description'])) {
                $data['descriptionError'] = 'The description of a article cannot be empty';
            }
            if(empty($data['body'])) {
                $data['bodyError'] = 'The body of a article cannot be empty';
            }

            if($data['title'] == $this->articleModel->findArticleById($id)->title) {
                $data['titleError'] == 'At least change the title!';
            }
            if($data['slug'] == $this->articleModel->findArticleById($id)->slug) {
                $data['slugError'] == 'At least change the slug!';
            }
            if($data['image'] == $this->articleModel->findArticleById($id)->image) {
                $data['imageError'] == 'At least change the Color!';
            }
            if($data['description'] == $this->articleModel->findArticleById($id)->description) {
                $data['descriptionError'] == 'At least change the Size!';
            }
            if($data['body'] == $this->articleModel->findArticleById($id)->body) {
                $data['bodyError'] == 'At least change the body!';
            }

            if (empty($data['titleError']) && empty($data['imageError']) && empty($data['descriptionError']) && empty($data['bodyError']) && empty($data['bodyError'])) {
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
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
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
                "text" => trim($_POST["text"])
            ];

            if (!empty($createComment["user_id"]) && !empty($createComment["text"])) {
                $this->articleModel->addComment($createComment);
                // array_push($data, $createComment);
                header("Location: " . URL_ROOT . "/articles/show/" . $id);
            }
            unset($_POST["text"]);

        }

        
        $data["categories"] = $this->categories;
        $this->render('articles/show', $data);
    }
	
}
