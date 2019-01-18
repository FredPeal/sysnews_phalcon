<?php 

namespace Sysnews\Models;

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $id ;
    public $name ;
    public $email ;
    public $pass ;
    public $created_at ;
    public $update_at ;

    public function initialize()
    {
        // $this->setSource('users');
        $this->setConnectionService('db');
        $this->hasMany('id', 'Sysnews\Models\Noticias', 'iduser', ['alias' => 'noticias', 'reusable' => true]);
    }

    public function getSource()
    {
        return 'users';
    }
}
