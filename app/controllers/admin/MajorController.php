<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\major;

class MajorController extends BaseController
{
    protected $majorModel;

    public function __construct()
    {
        $this->majorModel = new major();
    }

    public function index()
    {
        $title = 'Danh sách ngành học';
        $majors = $this->majorModel->getAll();
        $this->render('major.index', ['majors' => $majors, 'title' => $title]);
    }

    public function add()
    {
        $title = 'Thêm ngành học mới';
        $this->render('major.add', ['title' => $title]);
    }

    public function post()
    {
        if (isset($_POST['add']) && ($_POST['add']) != "") {
            $errors = [];

            if (empty($_POST['name'])) {
                $errors[] = "Bạn không được bỏ trống tên";
            }

            if (count($errors) > 0) {
                $_SESSION['post_data'] = $_POST;
                redirect('errors', $errors, 'admin/major/add');
            } else {
                $name = $_POST['name'];

                $result = $this->majorModel->add($name);

                if ($result) {
                    redirect('success', 'Thêm mới thành công', 'admin/major');
                }
            }
        }
    }

    public function edit($id)
    {
        $title = 'Chỉnh sửa ngành học';
        $major = $this->majorModel->find($id);
        $this->render('major.edit', ['major' => $major, 'title' => $title]);
    }

    public function update($id)
    {
        if (isset($_POST['edit']) && ($_POST['edit']) != "") {
            $errors = [];

            if (empty($_POST['name'])) {
                $errors[] = "Bạn không được bỏ trống tên";
            }

            if (count($errors) > 0) {
                $_SESSION['post_data'] = $_POST;
                redirect('errors', $errors, 'admin/major/edit/' . $id);
            } else {
                $name = $_POST['name'];

                $result = $this->majorModel->edit($name, $id);

                if ($result) {
                    redirect('success', 'Cập nhật thành công', 'admin/major');
                }
            }
        }
    }

    public function delete($id)
    {
        $result = $this->majorModel->delete($id);
        if ($result) {
            redirect('success', 'Xóa thành công', 'admin/major');
        }
    }
}
