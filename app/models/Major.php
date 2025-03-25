<?php

namespace App\Models;

class Major extends BaseModel
{
    protected $table = 'majors';

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function add($name)
    {
        $sql = "INSERT INTO $this->table (name) VALUES (?)";
        $this->setQuery($sql);
        return $this->execute([$name]);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function edit($name, $id)
    {
        $sql = "UPDATE $this->table SET name = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$name, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
}
