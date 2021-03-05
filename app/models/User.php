<?php


class User
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->fetch();
        $hashedPassword = $row->password;

        if(password_verify($password, $hashedPassword)){
            return $row;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)');
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function findUsersByRole($role)
    {
        $this->db->query('SELECT * FROM users WHERE role = :role');
        $this->db->bind(':role', $role);

        return $this->db->fetchAll();
    }

    public function findUserById($id)
    {
        $this->db->query("SELECT * FROM users WHERE user_id = :user_id");
        $this->db->bind(":user_id", $id);

        return $this->db->fetch();
    }

    public function findUserArticles($id)
    {
        $this->db->query("SELECT * FROM articles WHERE user_id = :user_id");
        $this->db->bind(":user_id", $id);

        return $this->db->fetchAll();
    }

    public function updateUser($data)
    {
        $this->db->query('UPDATE users SET 
        journal_name = :journal_name, 
        picture = :picture, 
        bio = :bio,
        hobbies = :hobbies
        WHERE user_id = :user_id');

        $this->db->bind(':user_id', $data['user']->user_id);
        $this->db->bind(':journal_name', $data['journal_name']);
        $this->db->bind(':picture', $data['picture']);
        $this->db->bind(':bio', $data['bio']);
        $this->db->bind(':hobbies', $data['hobbies']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}