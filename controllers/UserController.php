<?php 

namespace Sysnews\Controllers;

use Phalcon\Mvc\Controller;
use \Sysnews\Models\Users;
use Phalcon\Http\Response;

class UserController extends Controller 
{
    public function index()
    {
       
        $users = Users::find();

        $users = array_map(
                            function($value)
                            {
                                return ['name'=>$value['name'],'email'=>$value['email'],'created_at'=>$value['created_at'],'updated_at'=>$value['update_at']];
                            },$users->toArray()
                        );
        

  

        $response = new Response();
        $response->setJsonContent($users);
        return $response;
    }

    public function show($id)
    {
        $users = Users::find("id = $id");
        $response = new Response();
        $response->setJsonContent($users->toArray());
        return $response;
    }

    public function store()
    {
        $user = new Users();
        $user->name = $this->request->getPost('name');
        $user->email = $this->request->getPost('email');
        $user->pass = password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT);
        $user->created_at = date('Y/m/d H:i:s');
        $user->update_at = date('Y/m/d H:i:s');
        //var_dump($user);
        //$user->create();
        if ($user->save() == false) {
            echo 'Se registro un error';
            foreach ($robot->getMessages() as $message) {
              echo message;
            }
           } else {
            echo 'Agregado exitosamente';
           } 

    }

    public function update($id)
    {
        $data = $this->request->getJsonRawBody();

        $user = Users::findFirst(["id = $id"]);
        $user->name = $data->name;
        $user->email = $data->email;
        $user->update_at = date('Y/m/d H:i:s');
        $user->save();

    }

    public function delete($id)
    {
        $user = Users::findFirst(["id = $id"]);
        $user->delete();
    }
}
