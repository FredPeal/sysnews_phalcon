<?php 

namespace Sysnews\Controllers;

use Sysnews\Models\Noticias;
use Phalcon\Http\Response;

class NoticiasController extends BaseController
{
    /**
     * Busca en la base de datos nas noticias que coincidan con el titulo, deben llevar mas filtros , pero aun no funcionan
     *
     */
    public function index(): Response
    {
        $datos = $this->request->getQuery();
        unset($datos['_url'], $datos['page'], $datos['count']);

        $noticias = Noticias::find([
            'conditions' => 'titulo = :titulo:',
            'bind' => [
                'titulo' => $datos['titulo'],
            ],
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
     */
    public function show(Int $id): Response
    {
        $noticia = Noticias::findFirst($id);
        $noticia->vista++;
        $noticia->save();

        return $this->response($noticia);
    }

    /**
     * Funcion para almacenar noticias, en caso de que no funcione captura la execepcion y la devuelve
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
            throw new \Exception(current($noticia->getMessages()));
        }

        return $this->response($noticia->toArray());
    }

    /**
     * Funcion para actualizar noticas por el ID, recibe un id copmo parametro
     * OJO , deben enviar los datos en Json mediante PUT o no funcionara
     */
    public function update(Int $id): Response
    {
        $noticia = Noticias::findFirst($id);
        $data = $this->request->getJsonRawBody();

        $noticia->titulo = $data->titulo;
        $noticia->contenido = $data->contenido;
        $noticia->update_at = date('Y/m/d H:i:s');

        if (!$noticia->save()) {
            throw new \Exception(current($noticia->getMessages()));
        }

        return $this->response($noticia->toArray());
    }

    /**
     * Funcion para borrar una noticia
     */
    public function delete($id): Response
    {
        $noticia = Noticias::findFirst($id);
        $noticia->delete();

        $this->response(['message' => 'Eliminado correctamente']);
    }
}
