<?php 

namespace Sysnews\Controllers;

use Sysnews\Models\Users;
use Phalcon\Http\Response;

class AuthController extends \Phalcon\Mvc\Controller
{
    /**
     * Busca un usuario en la base de datos que coincida con ese emai
     * Luego compara la contraseña , si es correcta entonces genera el token con el id, email y nombre , luego retorna el token
     *
     * @return  Response
     */
    public function auth(): Response
    {
        $email = $this->request->getPost('email', 'email', '');
        $pass = $this->request->getPost('pass');
        $user = Users::findFirst("email = '$email'");
        $response = new Response();
        $token = ['message' => 'Error de autenticacion'];

        if (password_verify($pass, $user->pass)) {
            $token = $this->token($user->toArray());
        }

        $response->setJsonContent($token);
        return $response;
    }

    /**
     * La funcion debe de recibir los datos del usuario en array para luego retornar el token
     *
     * @param string $user
     * @return string
     */
    private function token($user) : string
    {
        $payload = [
            'sub' => $user['id'],
            'email' => $user['email'],
            'username' => $user['name'],
            'iat' => time(),
        ];
        return $this->auth->make($payload);
    }
}
