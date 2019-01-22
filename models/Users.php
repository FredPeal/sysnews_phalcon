<?php 

namespace Sysnews\Models;

use Phalcon\Mvc\Model;
use Exception;

class Users extends Model
{
    public $id ;
    public $name ;
    public $email ;
    public $pass ;
    public $created_at ;
    public $update_at ;

    /**
     * initalize function
     * Pasa la connecion y las relaciones, tambien sera necesaria para algunas opciones dependiendo la necesidad, (Lease la documentacion )
     *
     * @return void
     */
    public function initialize()
    {
        // $this->setSource('users');
        $this->setConnectionService('db');
        $this->hasMany('id', 'Sysnews\Models\Noticias', 'iduser', ['alias' => 'noticias', 'reusable' => true]);
    }

    /**
     * Check Function
     * Debe chequear si el usuario existe
     *
     * @param int $id
     * @return bool
     */
    public static function check(int $id): bool
    {
        $user = self::findFirst($id);

        if ($user) {
            return true;
        }

        throw new Exception('El usuario no existe');
    }
}
