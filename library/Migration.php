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
