<?php 

namespace Controllers;

use Phalcon\Mvc\Controller;
use Models\User;

class UserController extends Controller 
{
    public function index()
    {

    }

    public function show($id)
    {

    }

    public function store()
    {
        $user = new User;
        $user->name=$this->request->getPost('name');
        $user->email=$this->request->getPost('email');
        $user->email=$this->request->getPost('pass');
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
