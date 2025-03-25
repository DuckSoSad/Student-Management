<?php

namespace App\Models;

class Course extends BaseModel
{
    protected $table = 'courses';

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function add($name, $start_date, $end_date)
    {
        $sql = "INSERT INTO $this->table (name, start_date, end_date) VALUES (?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$name, $start_date, $end_date]);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function edit($name, $start_date, $end_date, $id)
    {
        $sql = "UPDATE $this->table SET name = ?, start_date = ?, end_date = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$name, $start_date, $end_date, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
}
