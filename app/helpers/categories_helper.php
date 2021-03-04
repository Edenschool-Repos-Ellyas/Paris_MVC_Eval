<?php

class CategoriesHelper
{
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

    public function helperFindAllCategories() 
    {
        $this->db->query('SELECT DISTINCT * FROM categories');
        return $this->db->fetchAll();
    }

}