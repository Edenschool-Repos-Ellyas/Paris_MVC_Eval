<?php

/**
 * Class Article
 * Gère la logique métier pour les articles
 */
class Article {
    /**
     * @var Database $db
     */
    private $db;

    /**
     * Post constructor.
     */
    public function __construct() 
    {
        $this->db = new Database();
    }

    /**
     * @return mixed
     * Récupère tous les articles en bdd
     */
    public function findAllArticles() 
    {
        $this->db->query('SELECT * FROM articles');
        return $this->db->fetchAll();
    }

    /**
     * recupé en ajax les articles qui contiennent une certainer chaine de charactères
     */
    public function findAllArticlesWithHint($q) 
    {
        $this->db->query('SELECT * FROM articles WHERE title LIKE :q');
        $this->db->bind(":q", "%". $q ."%");
        return $this->db->fetchAll();
    }

    /**
     * @return mixed
     * Récupère toutes les categories en bdd
     */
    public function findAllCategories() 
    {
        $this->db->query('SELECT DISTINCT * FROM categories');
        return $this->db->fetchAll();
    }
    

    public function findAllUsers() 
    {
        $this->db->query('SELECT firstname FROM users');

        "SELECT id, prenom, nom, utilisateur_id
        FROM utilisateur
        LEFT JOIN commande ON utilisateur.id = commande.utilisateur_id
        WHERE utilisateur_id IS NULL";

        return $this->db->fetchAll();
    }

    public function findAllArticlesByCategory($cat_id) 
    {
        $this->db->query('SELECT * FROM articles WHERE cat_id = :cat_id');
        $this->db->bind(':cat_id', $cat_id);
        return $this->db->fetchAll();
    }

    public function findAllArticlesByUsersId($user_id) 
    {
        $this->db->query('SELECT * FROM articles WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->fetchAll();
    }

    public function findAllArticlesAndTheirAuthor()
    {
        $this->db->query('SELECT * FROM articles INNER JOIN users ON articles.user_id = users.user_id');

        return $this->db->fetchAll();
    }

    public function findAllArticlesAndTheirAuthorByCategory($cat_id)
    {
        $this->db->query('SELECT * FROM articles INNER JOIN users ON articles.user_id = users.user_id WHERE cat_id = :cat_id');
        $this->db->bind(':cat_id', $cat_id);
        return $this->db->fetchAll();
    }

    public function findArticleById($id)
    {
        $this->db->query('SELECT * FROM articles WHERE art_id = :art_id');
        $this->db->bind(':art_id', $id);
        return $this->db->fetch();
    }

    public function findCategoryById($id)
    {
        $this->db->query('SELECT * FROM categories WHERE cat_id = :cat_id');
        $this->db->bind(':cat_id', $id);
        return $this->db->fetch();
    }

    public function findArticleAuthor($id)
    {
        $this->db->query('SELECT * FROM users WHERE user_id = :user_id');
        $this->db->bind(':user_id', $id);
        return $this->db->fetch();
    }

    public function addArticle($data)
    {
        $this->db->query('INSERT INTO articles (user_id, cat_id, title, slug, image, description, body) VALUES (:user_id, :cat_id, :title, :slug, :image, :description, :body)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':cat_id', $data['cat_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':body', $data['body']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateArticle($data)
    {
        $this->db->query('UPDATE articles SET cat_id = :cat_id, title = :title, slug = :slug, image = :image, description = :description, body = :body WHERE art_id = :art_id');
        $this->db->bind(':cat_id', $data['cat_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':art_id', $data['art_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteArticle($id) 
    {
        $this->db->query('DELETE FROM articles WHERE art_id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findAllCommentsOfArticle($id) 
    {
        $this->db->query('SELECT * FROM comments JOIN users ON comments.user_id = users.user_id WHERE art_id = :id ORDER BY comments.created_at DESC');
        $this->db->bind(":id", $id);
        return $this->db->fetchAll();
    }

    public function addComment($data)
    {
        $this->db->query('INSERT INTO comments (user_id, art_id, text) VALUES (:user_id, :art_id, :text)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':art_id', $data['art_id']);
        $this->db->bind(':text', $data['text']);

        if ($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }

}
