<?php

namespace App\Models;

class Student extends BaseModel
{
    protected $table = 'students';

    public function getAll()
    {
        $sql = "SELECT students.*, courses.name AS course_name, majors.name AS major_name 
                FROM $this->table
                LEFT JOIN courses ON students.course_id = courses.id
                LEFT JOIN majors ON students.major_id = majors.id";

        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function add($avatar, $name, $email, $phone, $dob, $gender, $address, $major_id, $course_id)
    {
        $sql = "INSERT INTO $this->table (avatar, name, email, phone, dob, gender, address, major_id, course_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$avatar, $name, $email, $phone, $dob, $gender, $address, $major_id, $course_id]);
    }

    public function find($id)
    {
        $sql = "SELECT students.*, courses.name AS course_name, majors.name AS major_name 
        FROM $this->table 
        LEFT JOIN courses ON students.course_id = courses.id
        LEFT JOIN majors ON students.major_id = majors.id
        WHERE students.id = ?";

        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function edit($avatar, $name, $email, $phone, $dob, $gender, $address, $major_id, $course_id, $id)
    {
        if ($avatar) {
            $sql = "UPDATE $this->table SET avatar = ?, name = ?, email = ?, phone = ?, dob = ?, gender = ?, address = ?, major_id = ?, course_id = ? WHERE id = ?";
            $this->setQuery($sql);
            return $this->execute([$avatar, $name, $email, $phone, $dob, $gender, $address, $major_id, $course_id, $id]);
        } else {
            $sql = "UPDATE $this->table SET name = ?, email = ?, phone = ?, dob = ?, gender = ?, address = ?, major_id = ?, course_id = ? WHERE id = ?";
            $this->setQuery($sql);
            return $this->execute([$name, $email, $phone, $dob, $gender, $address, $major_id, $course_id, $id]);
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
}
