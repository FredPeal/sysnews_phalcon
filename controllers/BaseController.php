<?php 

namespace Sysnews\Controllers;

use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

class BaseController extends \Phalcon\Mvc\Controller
{
    /**
     * La function recibe un parametroy lo convierte en una respuesta json
     *
     * @param mixed $message
     * @return Response
     */
    public function response($message): Response
    {
        $response = new Response();
        $response->setJsonContent($message);
        return $response;
    }

    /**
     * Recibo un array y uso el paginador de  Phalcon
     * Por defualt toma la primera pagina con 10 resultados y devuelve el array
     *
     * @param array $data , int $page , int $limit
     * @return array
     */
    public function paginate(array $data, int $page = 1, int $limit = 10): array
    {
        $paginator = new PaginatorArray(
            [
                'data' => $data,
                'limit' => $limit,
                'page' => $page,
            ]
        );
        //var_dump($paginator->getPaginate());
        return $paginator->getPaginate();
    }
}
