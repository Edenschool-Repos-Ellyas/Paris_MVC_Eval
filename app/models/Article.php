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

    public function findAllArticlesByFilter($filter) 
    {
        $this->db->query('SELECT * FROM tbl_articles WHERE type = :filter');
        $this->db->bind(':filter', $filter);
        return $this->db->fetchAll();
    }

    public function findAllArticlesByUsersId($user_id) 
    {
        $this->db->query('SELECT * FROM tbl_articles WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->fetchAll();
    }

    public function addArticle($data)
    {
        $this->db->query('INSERT INTO tbl_articles (user_id, article_name, type, color, size, price) VALUES (:user_id, :article_name, :type, :color, :size, :price)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':article_name', $data['article_name']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':size', $data['size']);
        $this->db->bind(':price', $data['price']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findArticleById($id)
    {
        $this->db->query('SELECT * FROM articles WHERE art_id = :art_id');
        $this->db->bind(':art_id', $id);
        return $this->db->fetch();
    }

    public function updateArticle($data)
    {
        $this->db->query('UPDATE tbl_articles SET article_name = :article_name, type = :type, color = :color, size = :size, price = :price WHERE id_article = :id_article');
        $this->db->bind(':article_name', $data['article_name']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':size', $data['size']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':id_article', $data['id_article']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteArticle($id) 
    {
        $this->db->query('DELETE FROM tbl_articles WHERE id_article = :id');
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
        $this->db->query('INSERT INTO tbl_comments (id_user, article_id, text_content) VALUES (:id_user, :article_id, :text_content)');
        $this->db->bind(':id_user', $data['user_id']);
        $this->db->bind(':article_id', $data['article_id']);
        $this->db->bind(':text_content', $data['text_content']);

        if ($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }

}
