<?php 

namespace Sysnews\Controllers;

use Sysnews\Models\Noticias;
use Phalcon\Http\Response;

class NoticiasController extends BaseController
{
    public function index(): Response
    {
        $datos = $this->request->getQuery();
        unset($datos['_url'], $datos['page'], $datos['count']);

        $first_element = true;

        $noticias = Noticias::query();

        foreach ($datos as $key => $value) {
            if ($first_element) {
                $noticias->where("$key = :$key:");
            } else {
                $noticias->andWhere("$key = :$key:");
            }

            $first_element = false;
        }

        $noticias->bind($datos);
        $noticias->join('Sysnews\Models\Users', 'Sysnews\Models\Users.id = iduser');
        $noticias->columns(['titulo', 'contenido', 'Sysnews\Models\Users.created_at', 'vista', 'name']);

        $datos = $this->paginate($noticias->execute()->toArray(), $this->request->getQuery('page'), $this->request->getQuery('count'));
        return $this->response($datos);
    }

    public function show(Int $id): Response
    {
        $noticia = Noticias::findFirst($id);
        $noticia->vista++;
        $noticia->save();

        return $this->response($noticia);
    }

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

    public function delete($id): Response
    {
        $noticia = Noticias::findFirst($id);
        $noticia->delete();

        $this->response(['message' => 'Eliminado correctamente']);
    }
}
