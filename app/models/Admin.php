<?php

namespace App\Models;

class Admin extends BaseModel
{
    protected $table = 'admins';

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = ?";
        $this->setQuery($sql);
        $result = $this->loadRow([$email]);

        return $result ? (array) $result : null;
    }

    public function register($username, $email, $password)
    {
        $sql = "INSERT INTO $this->table (username, email, password) VALUES (?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$username, $email, $password]);
    }
}