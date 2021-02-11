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
        $this->db->query('SELECT * FROM tbl_users WHERE email = :email');
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
        $this->db->query('INSERT INTO tbl_users (username, email, password) VALUES (:username, :email, :password)');
        $this->db->bind(':username', $data['username']);
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
        $this->db->query('SELECT * FROM tbl_users WHERE email = :email');
        $this->db->bind(':email', $email);

        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function findUserById($id)
    {
        $this->db->query("SELECT * FROM tbl_users WHERE user_id = :user_id");
        $this->db->bind(":user_id", $id);

        return $this->db->fetch();
    }

    public function updateUser($data)
    {
        $this->db->query('UPDATE tbl_users SET 
        username = :username, 
        firstname = :firstname, 
        lastname = :lastname, 
        address = :address, 
        zip_code = :zip_code 
        WHERE user_id = :user_id');

        $this->db->bind(':user_id', $data['user']->user_id);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':zip_code', $data['zip_code']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}