<?php


namespace src\Classes\Model;


class User {
    private $name;
    private $email;
    private $password;
    private $isAdmin = false;

    public function __construct($name, $email, $password, $isAdmin = false) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function isAdmin() {
        return $this->isAdmin;
    }
}