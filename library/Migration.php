<?php

namespace Sysnews\Library;

use Phinx\Migration\AbstractMigration;
use Elasticsearch\ClientBuilder;

class Migration extends AbstractMigration
{
    protected $columnas = [];
    protected $indice;

    /**
     * prepareToElastic function
     *
     * @return void
     */
    public function prepareToElastic()
    {
        $exist = $this->tables[0]->exists();
        if ($exist) {
            $cm = $this->tables[0]->getColumns();
            $this->indice = $this->tables[0]->getName();
            foreach ($cm as $col) {
                $this->columnas[] = $col->getName();
            }
        }
    }

    public function UpdateMapping(array $map)
    {
        $body = [
            'properties' => [
                'categoria' => [
                    'properties' => [
                        'noticias' => [
                            'properties' => [
                                'provincia' => [
                                    'type' => 'string'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Undocumented function
     *
     * @param [string] $indice
     * @return void
     */
    public function UpdateElastic(string $tipo, string $indice = null)
    {
        $indice = $indice ? $indice : $this->indice;
        $columnas_elastic = $this->tables[0]->getColumns();

        if ($this->$tables[0]->exists()) {
            foreach ($columnas_elastic as $columna) {
                if (in_array($columna->getName(), $this->columnas)) {
                    $this->peticion($indice, $columna->getName());
                }
            }
        } else {
            echo 'Ignorando actualizacion de Elasticsearch';
        }
    }

    /**
     * Undocumented function
     *
     * @param string $indice
     * @param string $type
     * @param string $clave
     * @param string $col
     * @param mixed $dataType
     * @return void
     */
    public function addToNestedDocument(int $id, string $indice, string $type, string $clave, string $col, $dataType = '')
    {
        $indice = $indice ? $indice : $this->indice;
        $body = [
            'index' => $indice,
            'type' => $tipo,
            'conflicts' => 'proceed',
            'body' => [
                'script' => [
                    'inline' => "int total = 0;\nfor (int i = 0; i < ctx._source.$clave.length; ++i) {ctx._source.$clave[i].$col = $dataType}\nreturn total;"
                ],
            ]
         ];
    }

    /**
     * peticion function
     *
     * @param [type] $indice
     * @param [type] $col
     * @return void
     */
    public function peticion($indice, $col, $tipo)
    {
        $uri = getenv('ELASTICSEARCH_HOST') . ':9200';
        $body = [
            'index' => $indice,
            'type' => $tipo,
            'conflicts' => 'proceed',
            'body' => [
                'script' => [
                    'inline' => 'ctx._source.campito_lindo=0'
                ],
                'query' => [
                    'match_all' => new \stdClass()
                ]
            ]
         ];
        $client = ClientBuilder::create()->setHosts([$uri])->build();
        $client->updateByQuery($body);
    }
}
