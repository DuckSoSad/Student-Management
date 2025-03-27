<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Course;
use App\Models\Major;
use App\Models\Student;

class StudentController extends BaseController
{
    protected $studentModel;
    protected $majorModel;
    protected $courseModel;

    public function __construct()
    {
        $this->studentModel = new Student();
        $this->majorModel = new Major();
        $this->courseModel = new Course();
    }

    public function index()
    {
        $title = 'Danh sách sinh viên';
        $students = $this->studentModel->getAll();

        $this->render('student.index', ['students' => $students, 'title' => $title]);
    }

    public function add()
    {
        $title = 'Thêm khóa sinh viên mới';
        $majors = $this->majorModel->getAll();
        $courses = $this->courseModel->getAll();
        $this->render('student.add', ['title' => $title, 'majors' => $majors, 'courses' => $courses]);
    }

    public function post()
    {
        if (isset($_POST['add']) && ($_POST['add']) != "") {
            $errors = [];

            if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
                $errors[] = "Bạn không được bỏ trống ảnh hoặc có lỗi khi tải ảnh lên";
            } else {
                $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!in_array($_FILES['avatar']['type'], $allowed_types)) {
                    $errors[] = "Chỉ được chọn ảnh JPG hoặc PNG";
                }
            }

            if (empty($_POST['name']))
                $errors[] = "Bạn không được bỏ trống tên";
            if (empty($_POST['email']))
                $errors[] = "Bạn không được bỏ trống email";
            if (empty($_POST['phone']))
                $errors[] = "Bạn không được bỏ trống số điện thoại";
            if (empty($_POST['dob']))
                $errors[] = "Bạn không được bỏ trống ngày sinh";
            if (empty($_POST['gender']))
                $errors[] = "Bạn không được bỏ trống giới tính";
            if (empty($_POST['address']))
                $errors[] = "Bạn không được bỏ trống địa chỉ";
            if (empty($_POST['major_id']))
                $errors[] = "Bạn không được bỏ trống ngành học";
            if (empty($_POST['course_id']))
                $errors[] = "Bạn không được bỏ trống khóa học";

            if (count($errors) > 0) {
                $_SESSION['post_data'] = $_POST;
                redirect('errors', $errors, 'admin/student/add');
            } else {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                $address = $_POST['address'];
                $major_id = $_POST['major_id'];
                $course_id = $_POST['course_id'];

                $target_dir = "public/images/";
                $avatarName = time() . "_" . basename($_FILES["avatar"]["name"]);
                $target_file = $target_dir . $avatarName;

                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    $result = $this->studentModel->add($avatarName, $name, $email, $phone, $dob, $gender, $address, $major_id, $course_id);
                    if ($result) {
                        redirect('success', 'Thêm mới thành công', 'admin/student');
                    }
                } else {
                    $errors[] = "Có lỗi xảy ra khi tải ảnh lên";
                    redirect('errors', $errors, 'admin/student/add');
                }
            }
        }
    }

    public function edit($id)
    {
        $title = 'Chỉnh sửa khóa sinh viên';
        $student = $this->studentModel->find($id);
        $majors = $this->majorModel->getAll();
        $courses = $this->courseModel->getAll();
        $this->render('student.edit', ['student' => $student, 'title' => $title, 'majors' => $majors, 'courses' => $courses]);
    }

    public function update($id)
    {
        if (isset($_POST['edit']) && ($_POST['edit']) != "") {
            $errors = [];

            // Kiểm tra thông tin bắt buộc
            if (empty($_POST['name']))
                $errors[] = "Bạn không được bỏ trống tên";
            if (empty($_POST['email']))
                $errors[] = "Bạn không được bỏ trống email";
            if (empty($_POST['phone']))
                $errors[] = "Bạn không được bỏ trống số điện thoại";
            if (empty($_POST['dob']))
                $errors[] = "Bạn không được bỏ trống ngày sinh";
            if (!isset($_POST['gender']))
                $errors[] = "Bạn không được bỏ trống giới tính";
            if (empty($_POST['address']))
                $errors[] = "Bạn không được bỏ trống địa chỉ";
            if (empty($_POST['major_id']))
                $errors[] = "Bạn không được bỏ trống ngành học";
            if (empty($_POST['course_id']))
                $errors[] = "Bạn không được bỏ trống khóa học";

            // Kiểm tra và xử lý ảnh (nếu có tải lên ảnh mới)
            $avatarName = $_POST['old_avatar']; // Giữ ảnh cũ nếu không có ảnh mới
            if (!empty($_FILES['avatar']['name'])) {
                if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (in_array($_FILES['avatar']['type'], $allowed_types)) {
                        // Xóa ảnh cũ nếu có
                        $oldImagePath = "public/images/" . $_POST['old_avatar'];
                        if (file_exists($oldImagePath) && !empty($_POST['old_avatar'])) {
                            unlink($oldImagePath);
                        }
                        // Lưu ảnh mới
                        $target_dir = "public/images/";
                        $avatarName = time() . "_" . basename($_FILES["avatar"]["name"]);
                        $target_file = $target_dir . $avatarName;
                        if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                            $errors[] = "Có lỗi xảy ra khi tải ảnh lên";
                        }
                    } else {
                        $errors[] = "Chỉ được chọn ảnh JPG hoặc PNG";
                    }
                } else {
                    $errors[] = "Có lỗi khi tải ảnh lên";
                }
            }

            if (count($errors) > 0) {
                $_SESSION['post_data'] = $_POST;
                redirect('errors', $errors, 'admin/student/edit/' . $id);
            } else {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                $address = $_POST['address'];
                $major_id = $_POST['major_id'];
                $course_id = $_POST['course_id'];

                $result = $this->studentModel->edit($avatarName, $name, $email, $phone, $dob, $gender, $address, $major_id, $course_id, $id);
                if ($result) {
                    redirect('success', 'Cập nhật thành công', 'admin/student');
                } else {
                    $errors[] = "Có lỗi xảy ra khi cập nhật";
                    redirect('errors', $errors, 'admin/student/edit/' . $id);
                }
            }
        }
    }

    public function delete($id)
    {
        $result = $this->studentModel->delete($id);
        if ($result) {
            redirect('success', 'Xóa thành công', 'admin/student');
        }
    }
}
