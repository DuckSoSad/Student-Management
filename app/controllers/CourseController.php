<?php

namespace App\Controllers;

use App\Models\Course;

class CourseController extends BaseController
{
    protected $courseModel;

    public function __construct()
    {
        $this->courseModel = new Course();
    }

    public function index()
    {
        $title = 'Danh sách khóa sinh viên';
        $courses = $this->courseModel->getAll();
        $this->render('course.index', ['courses' => $courses, 'title' => $title]);
    }

    public function add()
    {
        $title = 'Thêm khóa sinh viên mới';
        $this->render('course.add', ['title' => $title]);
    }

    public function post()
    {
        if (isset($_POST['add']) && ($_POST['add']) != "") {
            $errors = [];

            if (empty($_POST['name'])) {
                $errors[] = "Bạn không được bỏ trống tên";
            }
            if (empty($_POST['start_date'])) {
                $errors[] = "Bạn không được bỏ trống ngày bắt đầu";
            }
            if (empty($_POST['end_date'])) {
                $errors[] = "Bạn không được bỏ trống ngày kết thúc";
            }

            if (count($errors) > 0) {
                $_SESSION['post_data'] = $_POST;
                redirect('errors', $errors, 'course/add');
            } else {
                $name = $_POST['name'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];

                $result = $this->courseModel->add($name, $start_date, $end_date);

                if ($result) {
                    redirect('success', 'Thêm mới thành công', 'course');
                }
            }
        }
    }

    public function edit($id)
    {
        $title = 'Chỉnh sửa khóa sinh viên';
        $course = $this->courseModel->find($id);
        $this->render('course.edit', ['course' => $course, 'title' => $title]);
    }

    public function update($id)
    {
        if (isset($_POST['edit']) && ($_POST['edit']) != "") {
            $errors = [];

            if (empty($_POST['name'])) {
                $errors[] = "Bạn không được bỏ trống tên";
            }
            if (empty($_POST['start_date'])) {
                $errors[] = "Bạn không được bỏ trống ngày bắt đầu";
            }
            if (empty($_POST['end_date'])) {
                $errors[] = "Bạn không được bỏ trống ngày kết thúc";
            }

            if (count($errors) > 0) {
                $_SESSION['post_data'] = $_POST;
                redirect('errors', $errors, 'course/edit/' . $id);
            } else {
                $name = $_POST['name'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];

                $result = $this->courseModel->edit($name, $start_date, $end_date, $id);

                if ($result) {
                    redirect('success', 'Cập nhật thành công', 'course');
                }
            }
        }
    }

    public function delete($id)
    {
        $result = $this->courseModel->delete($id);
        if ($result) {
            redirect('success', 'Xóa thành công', 'course');
        }
    }
}
