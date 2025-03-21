<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\User;
use App\Helpers\EmailSender;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $users = $this->user->findAll();
        return view("admin.users.index", compact('users'));
    }

    public function create()
    {
        return view("admin.users.create");
    }

    public function store()
    {
        $data = $_POST + $_FILES;
        $errors = [];
    }
    public function edit($id)
    {
        $users = $this->user->find($id);
        return view("admin.users.edit", compact('users'));
    }

    public function update($id)
    {
        $newStatus = $_POST['status'] ?? '';
        $user = $this->user->find($id);

        if (!$user) {
            redirect('/admin/users/');
        }

        $currentStatus = $user['status'];
        $allowedTransitions = [
            'active' => ['inactive'],
            'inactive' => ['banned'],
            'banned' => null,
        ];

        if (!isset($allowedTransitions[$currentStatus]) || !in_array($newStatus, $allowedTransitions[$currentStatus])) {
            redirect('/admin/users/');
        }
        $this->user->update($id, ['status' => $newStatus]);
        redirect('/admin/users/');
    }





}