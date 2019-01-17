<?php 

namespace Sysnews\Controllers;

use Sysnews\Models\Users;
use Phalcon\Http\Response;

class AuthController extends \Phalcon\Mvc\Controller 
{
 
    public function auth()
    {
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        $user = Users::findFirst("email = '$email'");
        if(password_verify($pass,$user->pass))
        {
             
            $token = $this->token($user->toArray());
            $response = new Response();
            $response->setJsonContent($token);
            return $response;
        }else 
        {
            $response = new Response();
            $response->setJsonContent(['message'=>"Error de autenticacion"]);
            return $response;
        }

     }

    private function token($user)
    {
        $payload = [
            'sub'   => $user["id"],
            'email' => $user["email"],
            'username' =>  $user["name"],
            'iat' => time(),
        ];
         return $this->auth->make($payload);
    }
}