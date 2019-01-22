<?php 

namespace Sysnews\Controllers;

use \Sysnews\Models\Users;
use Phalcon\Http\Response;

class UserController extends BaseController
{
    /**
     * La funcion index en usuarios busca los usuarios pero no la contraseña
     * @return  Response
     */
    public function index(): Response
    {
        $users = Users::find(['columns' => 'id,name,email']);

        return $this->response(['items' => $users]);
    }

    /**
     * La funcion show recibe el id y filtra los resultados, pero no devuelve la contraseña
     * @param  int $id
    */
    public function show(int $id): Response
    {
        $message = 'El usuario no existe';
        if (Users::check($id)) {
            $users = Users::find(['conditions' => "id = $id", 'columns' => 'id,name,email']);
            $message = $users->toArray();
        }
        return $this->response($message);
    }

    /**
     * Funcion para crear nuevos usuarios
     *  @return  Response
     */
    public function store(): Response
    {
        $user = new Users();
        $user->name = $this->request->getPost('name');
        $user->email = $this->request->getPost('email');
        $user->pass = password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT);
        $user->created_at = date('Y/m/d H:i:s');
        $user->update_at = date('Y/m/d H:i:s');

        if (!$user->save()) {
            throw new \Exception(current($user->getMessages()));
        }

        return $this->response($user->toArray());
    }

    /**
     * Funcion para modificar usuarios
     * @return Response
     */
    public function update(int $id): Response
    {
        $message = 'El usuario no existe';

        if (Users::check($id)) {
            $data = $this->request->getJsonRawBody();

            $user = Users::findFirst(["id = $id"]);
            $user->name = $data->name;
            $user->email = $data->email;
            $user->update_at = date('Y/m/d H:i:s');

            if (!$user->save()) {
                throw new Exception(current($user->getMessages()));
            }

            $message = $user->toArray();
        }

        return $this->response($message);
    }

    /**
     * Funcion para eliminar usuarios, recibe el id como parametro
     * @param int $id
     * @return Response
     *
     */
    public function delete(int $id) : Response
    {
        $message = 'El usuario no existe';

        if (Users::check($id)) {
            $user = Users::findFirst(["id = $id"]);
            $user->delete();
            $message = ['message' => 'Eliminado correctamente'];
        }

        return $this->response($message);
    }
}
