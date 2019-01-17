<?php 

namespace Sysnews\Controllers;

use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

class BaseController extends \Phalcon\Mvc\Controller
{

    public function response($message)
    {
        $response = new Response();
        $response->setJsonContent($message);
        return $response;
    }

    public function paginate($data,$page=1,$limit=10)
    {
        $paginator = new PaginatorArray(
            [
                'data'  => $data,
                'limit' => $limit,
                'page'  => $page,
            ]
        );

         return $paginator->getPaginate();
    }
}