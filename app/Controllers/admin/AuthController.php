<?php
namespace App\Controllers\admin;
use App\Controller;
use App\Models\User;
class AuthController extends Controller{
    protected $users;
    public function __construct()
    {
        $this->users = new User();
    }
    public function showsignin()
    {
        return view('admin.auth.formsignup');
    }
    public function signin()
    {
        $data = $_POST + $_FILES;
        if(is_upload('avatar')){
            $data['avatar'] = $this->uploadFile($data['avatar'], 'avatar');
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->users->insert($data);
        redirect('/admin/auth/');
    }
    public function showLoginForm()
    {
        return view('admin.auth.index');
    }
    public function handleLogin(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            if (empty($email) || empty($password)) {
                return view('admin.auth.index', ['error' => 'Vui lòng nhập email và mật khẩu.']);
            }
            $users = $this->users->fetchUsers();
            $foundUser = null;
            foreach ($users as $user) {
                if ($user['email'] === $email) {
                    $foundUser = $user;
                    break;
                }
            }
            if (!$foundUser) {
                return view('admin.auth.index', ['error' => 'Email không tồn tại.']);
            }
            if ($password !== $foundUser['password']) {
                return view('admin.auth.index', ['error' => 'Mật khẩu không chính xác.']);
            }
            $_SESSION['user'] = [
                'id' => $foundUser['id'],
                'full_name' => $foundUser['full_name'] ?? 'admin',
                'email' => $foundUser['email'],
                'role' => $foundUser['role'] ?? 'user'
            ];
            header('Location: ' . ($foundUser['role'] === 'admin' ? '/admin/' : '/'));
            exit;
        }
    }
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: /login');
        exit();
    }


}