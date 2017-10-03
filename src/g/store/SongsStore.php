<?php

namespace g\store;

use Simplon\Mysql\Crud\CrudModelInterface;
use Simplon\Mysql\Crud\CrudStore;
use Simplon\Mysql\MysqlException;
use Simplon\Mysql\QueryBuilder\CreateQueryBuilder;
use Simplon\Mysql\QueryBuilder\DeleteQueryBuilder;
use Simplon\Mysql\QueryBuilder\ReadQueryBuilder;
use Simplon\Mysql\QueryBuilder\UpdateQueryBuilder;

use g\model\SongModel;
use g\store\SongsStoreInterface;



/**
 * @package Test\Crud
 */
class SongsStore extends CrudStore implements SongsStoreInterface
{
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'song';
    }

    /**
     * @return CrudModelInterface
     */
    public function getModel(): CrudModelInterface
    {
        return new SongModel();
    }

    /**
     * @param CreateQueryBuilder $builder
     *
     * @return SongModel
     * @throws MysqlException
     */
    public function create(CreateQueryBuilder $builder): SongModel
    {
        /** @var SongModel $model */
        $model = $this->crudCreate($builder);

        return $model;
    }

    /**
     * @param ReadQueryBuilder|null $builder
     *
     * @return SongModel[]|null
     * @throws MysqlException
     */
    public function read(?ReadQueryBuilder $builder = null): ?array
    {
        /** @var SongModel[]|null $response */
        $response = $this->crudRead($builder);

        return $response;
    }

    /**
     * @param ReadQueryBuilder $builder
     *
     * @return null|SongModel
     * @throws MysqlException
     */
    public function readOne(ReadQueryBuilder $builder): ?SongModel
    {
        /** @var SongModel|null $response */
        $response = $this->crudReadOne($builder);

        return $response;
    }

    /**
     * @param UpdateQueryBuilder $builder
     *
     * @return SongModel
     * @throws MysqlException
     */
    public function update(UpdateQueryBuilder $builder): SongModel
    {
        /** @var SongModel|null $model */
        $model = $this->crudUpdate($builder);

        return $model;
    }

    /**
     * @param DeleteQueryBuilder $builder
     *
     * @return bool
     * @throws MysqlException
     */
    public function delete(DeleteQueryBuilder $builder): bool
    {
        return $this->crudDelete($builder);
    }   
    
    /**
     * @param int $id
     *
     * @return null|SongModel
     * @throws MysqlException
     */
    public function customMethod(int $id): ?SongModel
    {
        $query = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id=:id';

        if ($result = $this->getCrudManager()->getMysql()->fetchRow($query, ['id' => $id]))
        {
            return (new SongModel())->fromArray($result);
        }

        return null;
    }
}