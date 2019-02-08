<?php


use Sysnews\Library\Migration;

class Categorias extends Migration
{
    public function up()
    {
        $table = $this->table('categorias');
        $this->prepareToElastic();
        $table->addColumn('nombre', 'string');
        $this->UpdateElastic('categoria');
        die();
    }
}
