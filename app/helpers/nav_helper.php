<?php

class NavHelper
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

    public function helperFindUsersByRole($role)
    {
        $this->db->query('SELECT * FROM users WHERE role = :role');
        $this->db->bind(':role', $role);

        return $this->db->fetchAll();
    }

}