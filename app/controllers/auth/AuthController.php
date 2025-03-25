<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Admin;

class AuthController extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    public function showLogin()
    {
        $title = 'Đăng nhập';
        $this->render('auth.login', ['title' => $title]);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Kiểm tra input có rỗng không
            if (empty($email) || empty($password)) {
                redirect('error', 'Vui lòng nhập đầy đủ thông tin!', 'login');
            }

            // Tìm admin theo email
            $admin = $this->adminModel->findByEmail($email);

            if (!$admin) {
                redirect('error', 'Email không tồn tại!', 'login');
            }

            // Kiểm tra mật khẩu
            if (!password_verify($password, $admin['password'])) {
                redirect('error', 'Mật khẩu không chính xác!', 'login');
            }

            // Lưu thông tin đăng nhập vào session
            $_SESSION['auth'] = [
                'id' => $admin['id'],
                'name' => $admin['username'],
                'email' => $admin['email']
            ];

            $_SESSION['auth_welcome'] = true; // Đánh dấu đã login để hiện popup

            redirect('success', 'Đăng nhập thành công!', 'admin');
        }

        $title = "Đăng nhập";
        $this->render('auth.login', ['title' => $title]);
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        session_destroy();
        redirect('success', 'Đăng xuất thành công!', 'login');
    }

    public function showRegister()
    {
        $title = 'Đăng ký';
        $this->render('auth.register', ['title' => $title]);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Kiểm tra input rỗng
            if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
                redirect('error', 'Vui lòng nhập đầy đủ thông tin!', 'register');
            }

            // Kiểm tra định dạng email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                redirect('error', 'Email không hợp lệ!', 'register');
            }

            // Kiểm tra username có ký tự đặc biệt không
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                redirect('error', 'Username chỉ được chứa chữ, số và dấu gạch dưới!', 'register');
            }

            // Kiểm tra password có khớp không
            if ($password !== $confirmPassword) {
                redirect('error', 'Mật khẩu không khớp!', 'register');
            }

            // Kiểm tra email đã tồn tại chưa
            $existingUser = $this->adminModel->findByEmail($email);
            if ($existingUser) {
                redirect('error', 'Email đã tồn tại, vui lòng chọn email khác!', 'register');
            }

            // Hash mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Gọi model để đăng ký user
            $result = $this->adminModel->register($username, $email, $hashedPassword);

            if ($result) {
                $_SESSION['success'] = "Đăng ký thành công!";
                redirect('success', 'Đăng ký thành công! Vui lòng đăng nhập.', 'login');
            } else {
                redirect('error', 'Lỗi hệ thống, vui lòng thử lại sau!', 'register');
            }
        }
    }

}
