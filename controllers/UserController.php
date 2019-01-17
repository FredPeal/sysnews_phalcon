<?php 

namespace Sysnews\Controllers;

use Phalcon\Mvc\Controller;
use \Sysnews\Models\Users;
use Phalcon\Http\Response;

class UserController extends BaseController 
{
    public function index(): Response
    {
       
        $users = Users::find();

        $users = array_map(
                            function($value)
                            {
                                return ['name'=>$value['name'],'email'=>$value['email'],'created_at'=>$value['created_at'],'updated_at'=>$value['update_at']];
                            },$users->toArray()
                        );
        

  

      return $this->response(['items'=>$users]);

    }

    public function show($id): Response
    {
        // $users = ;
        return $this->response(Users::findFirst($id));
    }

    public function store(): Response
    {
        $user = new Users();
        $user->name = $this->request->getPost('name');
        $user->email = $this->request->getPost('email');
        $user->pass = password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT);
        $user->created_at = date('Y/m/d H:i:s');
        $user->update_at = date('Y/m/d H:i:s');

        if (!$user->save()) {

            throw new Exception(current($user->getMessages()));
        }

        return $this->response($user->toArray());

    }

    public function update($id): Response
    {
        $data = $this->request->getJsonRawBody();

        $user = Users::findFirst(["id = $id"]);
        $user->name = $data->name;
        $user->email = $data->email;
        $user->update_at = date('Y/m/d H:i:s');

        if (!$user->save()) {

            throw new Exception(current($user->getMessages()));
        }

        return $this->response($user->toArray());

    }

    public function delete($id)
    {
        $user = Users::findFirst(["id = $id"]);
        $user->delete();

        return $this->response(["message"=>"Eliminado correctamente"]);
    }
}
