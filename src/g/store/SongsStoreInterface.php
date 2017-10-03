<?php

namespace g\store;

use Simplon\Mysql\Crud\CrudModelInterface;
use Simplon\Mysql\Crud\CrudStoreInterface;
use Simplon\Mysql\MysqlException;
use Simplon\Mysql\QueryBuilder\CreateQueryBuilder;
use Simplon\Mysql\QueryBuilder\DeleteQueryBuilder;
use Simplon\Mysql\QueryBuilder\ReadQueryBuilder;
use Simplon\Mysql\QueryBuilder\UpdateQueryBuilder;

use g\model\SongModel;



interface SongsStoreInterface extends CrudStoreInterface
{
    
    public function customMethod(int $id): ?SongModel;
}