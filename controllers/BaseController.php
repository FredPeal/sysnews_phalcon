<?php 

namespace Sysnews\Controllers;

use Phalcon\Http\Response;

class BaseController extends \Phalcon\Mvc\Controller
{

    public function response($message)
    {
        $response = new Response();
        $response->setJsonContent($message);
        return $response;
    }
}