<?php 

namespace Sysnews\Controllers;

use Sysnews\Models\Noticias;
use Phalcon\Http\Response;
use Exception;

class NoticiasController extends BaseController
{
    /**
     * Busca en la base de datos nas noticias que coincidan con el titulo, deben llevar mas filtros , pero aun no funcionan
     *
     * @return  Response
     */
    public function index(): Response
    {
        $datos = ['true' => 1];

        $query = '1 = :true:';

        if ($this->request->has('titulo') && !empty($this->request->getQuery('titulo'))) {
            $datos['titulo'] = $this->request->getQuery('titulo');
            $query = 'AND titulo = :titulo:';
        }

        if ($this->request->has('contenido') && !empty($this->request->getQuery('contenido'))) {
            $datos['contenido'] = $this->request->getQuery('contenido') . '%';
            $query = $query . 'AND contenido Like  :contenido:';
        }

        if ($this->request->has('fecha') && !empty($this->request->getQuery('fecha'))) {
            $datos['created_at'] = $this->request->getQuery('fecha');
            $query = $query . ' AND created_at = :created_at:';
        }

        // var_dump($query);
        // var_dump($datos);

        $noticias = Noticias::find([
                    'conditions' => $query,
                    'bind' => $datos,
                ]);

        $result = [];

        foreach ($noticias as $noticia) {
            $data = $noticia->toArray();
            $data['user'] = $noticia->users;

            $result[] = $data;
        }

        return $this->response($result);
    }

    /**
     * Funcion para buscar noticias por el id
     *
     * @param  int $id
     * @return  Response
     */
    public function show(int $id): Response
    {
        //$message = 'La noticia no existe';
        if (Noticias::check($id)) {
            $noticia = Noticias::findFirst($id);
            $noticia->vista++;
            $noticia->save();

            $message = $noticia->toArray();
        } else {
            //die('3');
            throw new Exception('no existe');
        }

        return $this->response($message);
    }

    /**
     * Funcion para almacenar noticias, en caso de que no funcione captura la execepcion y la devuelve
     *
     * @return  Response
     */
    public function store(): Response
    {
        $noticia = new Noticias();
        $noticia->iduser = $this->auth->data('sub');
        $noticia->titulo = $this->request->getPost('titulo');
        $noticia->contenido = $this->request->getPost('contenido');
        $noticia->created_at = date('Y/m/d H:i:s');
        $noticia->update_at = date('Y/m/d H:i:s');
        $noticia->soft_delete = 0;
        $noticia->vista = 0;

        if (!$noticia->save()) {
            throw new Exception(current($noticia->getMessages()));
        }

        return $this->response($noticia->toArray());
    }

    /**
     * Funcion para actualizar noticas por el ID, recibe un id copmo parametro
     * OJO , deben enviar los datos en Json mediante PUT o no funcionara
     *
     * @param int $id
     * @return Response
     */
    public function update(int $id): Response
    {
        $message = 'La noticia no existe';
        if (Noticias::check($id)) {
            $noticia = Noticias::findFirst($id);
            $data = $this->request->getJsonRawBody();

            $noticia->titulo = $data->titulo;
            $noticia->contenido = $data->contenido;
            $noticia->update_at = date('Y/m/d H:i:s');

            if (!$noticia->save()) {
                throw new \Exception(current($noticia->getMessages()));
            }

            $message = $noticia->toArray();
        }

        return $this->response($message);
    }

    /**
     * Funcion para borrar una noticia
     *
     * @param int $id
     * @return  Response
     */
    public function delete(int $id): Response
    {
        $message = 'No existe la noticia';
        if (Noticias::check($id)) {
            $noticia = Noticias::findFirst($id);
            $noticia->soft_delete = 1 ;
            $noticia->save();
            $message = ['message' => 'Eliminado correctamente'];
        }

        return $this->response($message);
    }
}
