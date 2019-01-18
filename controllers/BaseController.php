<?php 

namespace Sysnews\Controllers;

use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

class BaseController extends \Phalcon\Mvc\Controller
{
    /**
     *La function recibe un parametroy lo convierte en una respuesta json
     */
    public function response($message)
    {
        $response = new Response();
        $response->setJsonContent($message);
        return $response;
    }

    /**
     * Recibo un array y uso el paginador de  Phalcon
     * Por defualt toma la primera pagina con 10 resultados y devuelve el array
     */
    public function paginate(array $data, int $page = 1, int $limit = 10)
    {
        $paginator = new PaginatorArray(
            [
                'data' => $data,
                'limit' => $limit,
                'page' => $page,
            ]
        );

        return $paginator->getPaginate();
    }
}
