<?php 

namespace Sysnews\Controllers;

use Sysnews\Models\Noticias;
use Phalcon\Http\Response;

class NoticiasController extends BaseController
{
    public function index(): Response
    {
 
        return $this->response(Noticias::find());
    }

    public function show($id): Response
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

    public function update($id): Response
    {
        $noticia = Noticias::findFirst($id);
        $data = $this->request->getJsonRawBody();
        var_dump($data->titulo);
        
         
        $noticia->titulo = $data->titulo;
        $noticia->contenido = $data->contenido;
        $noticia->update_at = date('Y/m/d H:i:s');
       
        if (!$noticia->save()) {
            throw new \Exception(current($noticia->getMessages()));
        }

        return $this->response($noticia->toArray());

        $this->response($noticia);
    }

    public function delete(): Response
    {
        $noticia = Noticias::findFirst($id);
        $noticia->delete();

        $this->response(["message"=>"Eliminado correctamente"]);
    }
}