<?php

/**
 * Class Ajax
 * Gère la logique métier pour les requttes ajax
 */
class Ajax {
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
     * recupé en ajax les articles qui contiennent une certainer chaine de charactères
     */
    public function findAllArticlesWithHint($hint) 
    {
        $this->db->query('SELECT * FROM articles WHERE title LIKE :hint');
        $this->db->bind(":hint", "%". $hint ."%");
        return $this->db->fetchAll();
    }

    
}
