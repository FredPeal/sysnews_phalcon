<?php 

namespace Sysnews\Models;

use Exception;
use Phalcon\Validation;

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
        $this->belongsTo('iduser', 'Sysnews\Models\Users', 'id', ['alias' => 'users']);
    }

    /**
     * Check Function
     * Debe chequear si la noticia existe
     *
     * @param int $id
     * @return bool
     */
    public static function check(int $id): bool
    {
        $noticia = self::findFirst($id);

        if ($noticia) {
            return true;
        }
        throw new Exception('La noticia no existe');
    }

    /**
     * Funcion beforeUpd
     * Debe de verificar si la notica pertenece a ese usuario
     *
     * @param int $id, int $iduser
     * @return  bool
     */
    public static function beforeUpd(int $id, int $iduser) : bool
    {
        $noticia = Noticias::find([
            'conditions' => 'id = :id: AND iduser = :iduser:',
            'bind' => [
                'id' => $id,
                'iduser' => $iduser
            ]
         ]);

        if (empty($noticia->toArray()) || count($noticia->toArray()) == 0) {
            return false;
        }

        return true;
    }

    /**
     * beforeUpdate function
     *
     * Antes de modificar debe verificar que la noticia pertenece a ese usuario
     * @return void
     */
    public function beforeUpdate()
    {
        $userId = $this->di->getAuth()->data('sub');
        if ($userId != $this->iduser) {
            throw new Exception('Esta noticia no le pertence ');
        }
    }

    public function validation()
    {
        $validator = new Validation;
        $validator->add('id', new DigitValidator(
            [
                'message' => ':field tiene que ser un numero',
            ]
            ));

        return $this->validate($validator);
    }
}
