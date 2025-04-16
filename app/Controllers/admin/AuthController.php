<?php
namespace App\Controllers\admin;

use App\Models\User;
use App\Controller;
use Rakit\Validation\Validator;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class AuthController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->users = new User();
    }

    public function showsignin()
    {
        if (isset($_SESSION['user'])) {
            redirect('/');
        }

        return view('admin.auth.formsignup');
    }

    public function signin()
    {
        $data = $_POST + $_FILES;
        $validator = new Validator();
        $email = $data['email'] ?? '';
        if (!empty($email)) {
            $users = $this->users->fetchUsers();
            foreach ($users as $user) {
                if ($user['email'] === $email) {
                    $_SESSION['error'] = ['email' => 'Email này đã được sử dụng. Vui lòng chọn email khác.'];
                    redirect('/signin');
                    exit;
                }
            }
        }
        $rules = [
            'full_name' => 'required|min:6|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:32',
            'phone' => 'required|numeric|min:10',
        ];
        $err = $this->validate($validator, $data, $rules);
        if(!empty($err)) {
            $_SESSION['error'] = $err;
            redirect('/signin');
            exit;
        }

        if (is_upload('avatar')) {
            $data['avatar'] = $this->uploadFile($data['avatar'], 'avatar');
        }
        
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->users->insert($data);
        
        $_SESSION['success'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
        redirect('/login');
        exit;
    }

    public function showLoginForm()
    {
        return view('admin.auth.index');
    }

    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Email không đúng định dạng.';
                return view('admin.auth.index');
            }
            if (strlen($email) > 255) {
                $_SESSION['error'] = 'Email không được vượt quá 255 ký tự.';
                return view('admin.auth.index');
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'Mật khẩu phải có ít nhất 6 ký tự.';
                return view('admin.auth.index');
            }

            if (strlen($password) > 32) {
                $_SESSION['error'] = 'Mật khẩu không được vượt quá 32 ký tự.';
                return view('admin.auth.index');
            }
            if (preg_match('/[\'";\-=]/', $email) || preg_match('/[\'";\-=]/', $password)) {
                $_SESSION['error'] = 'Dữ liệu không hợp lệ.';
                return view('admin.auth.index');
            }
            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Vui lòng nhập email và mật khẩu.';
                return view('admin.auth.index');
            }
            if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5) {
                if (time() - $_SESSION['last_attempt'] < 300) {  // 5 minutes lockout
                    $_SESSION['error'] = 'Vui lòng thử lại sau 5 phút.';
                    return view('admin.auth.index');
                }
                $_SESSION['login_attempts'] = 0;
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
                $_SESSION['error'] = 'Email không tồn tại.';
                return view('admin.auth.index');
            }
            if ($password !== $foundUser['password']) {
                $_SESSION['error'] = 'Mật khẩu không chính xác.';
                return view('admin.auth.index');
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
