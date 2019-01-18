<?php 

namespace Sysnews\Models;

class Noticias extends \Phalcon\Mvc\Model
{
    public $id;
    public $titulo;
    public $iduser;
    public $contenido;
    public $created_at;
    public $update_at;
    public $soft_delete;
    public $vista;

    public function initialize()
    {
        // $this->setSource('users');
        $this->setConnectionService('db');
        $this->belongsTo('iduser', 'Sysnews\Models\Users', 'id', ['alias' => 'users']);
    }

    public function getSource()
    {
        return 'noticias';
    }
}
