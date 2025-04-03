<?php
namespace App\Controllers\client;
use App\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    protected $users;
    public function __construct(){
        $this->users = new User();
    }
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
        $userId = $_SESSION['user']['id'];
        $user = $this->users->find($userId);
        if (!$user) {
            header('Location: /login');
            exit;
        }
        view('client.profile.index', compact('user'));
    }
    public function edit($id){
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
        }
        $user = $this->users->find($id);
        if (!$user) {
            header('Location: /login');
        }
        view('client.profile.update', compact('user'));
    }
    public function update($id)
    {
        $data = $_POST + $_FILES;
        $user = $this->users->find($id);
        if(is_upload('avatar')){
            $data['avatar'] = $this->uploadFile($data['avatar'], 'avatar');
            if($user['avatar'] && file_exists($user['avatar'])){
                unlink($user['avatar']);
            }
        }else{
            $data['avatar'] = $user['avatar'];
        }
        $this->users->update($id, $data);
        redirect('/profile');
    }
}