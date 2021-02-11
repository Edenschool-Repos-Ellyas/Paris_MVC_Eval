<?php

/**
 * Class Mobilier
 * Gère la logique métier pour les articles
 */
class Mobilier {
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
    public function findAllMobiliers() 
    {
        $this->db->query('SELECT * FROM tbl_mobiliers');
        return $this->db->fetchAll();
    }

    public function findAllTypes() 
    {
        $this->db->query('SELECT DISTINCT type FROM tbl_mobiliers');
        return $this->db->fetchAll();
    }

    public function findAllUsers() 
    {
        $this->db->query('SELECT user_id, username FROM tbl_users');

        "SELECT id, prenom, nom, utilisateur_id
        FROM utilisateur
        LEFT JOIN commande ON utilisateur.id = commande.utilisateur_id
        WHERE utilisateur_id IS NULL";

        return $this->db->fetchAll();
    }

    public function findAllMobiliersByFilter($filter) 
    {
        $this->db->query('SELECT * FROM tbl_mobiliers WHERE type = :filter');
        $this->db->bind(':filter', $filter);
        return $this->db->fetchAll();
    }

    public function findAllMobiliersByUsersId($user_id) 
    {
        $this->db->query('SELECT * FROM tbl_mobiliers WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->fetchAll();
    }

    public function addMobilier($data)
    {
        $this->db->query('INSERT INTO tbl_mobiliers (user_id, mobilier_name, type, color, size, price) VALUES (:user_id, :mobilier_name, :type, :color, :size, :price)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':mobilier_name', $data['mobilier_name']);
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

    public function findMobilierById($id)
    {
        $this->db->query('SELECT * FROM tbl_mobiliers WHERE id_mobilier = :id_mobilier');
        $this->db->bind(':id_mobilier', $id);
        return $this->db->fetch();
    }

    public function updateMobilier($data)
    {
        $this->db->query('UPDATE tbl_mobiliers SET mobilier_name = :mobilier_name, type = :type, color = :color, size = :size, price = :price WHERE id_mobilier = :id_mobilier');
        $this->db->bind(':mobilier_name', $data['mobilier_name']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':size', $data['size']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':id_mobilier', $data['id_mobilier']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteMobilier($id) 
    {
        $this->db->query('DELETE FROM tbl_mobiliers WHERE id_mobilier = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findAllCommentsOfMobilier($id) 
    {
        $this->db->query('SELECT * FROM tbl_comments JOIN tbl_users ON tbl_comments.id_user = tbl_users.user_id WHERE mobilier_id = :id ORDER BY comment_created_at DESC');
        $this->db->bind(":id", $id);
        return $this->db->fetchAll();
    }

    public function addComment($data)
    {
        $this->db->query('INSERT INTO tbl_comments (id_user, mobilier_id, text_content) VALUES (:id_user, :mobilier_id, :text_content)');
        $this->db->bind(':id_user', $data['user_id']);
        $this->db->bind(':mobilier_id', $data['mobilier_id']);
        $this->db->bind(':text_content', $data['text_content']);

        if ($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }

}
