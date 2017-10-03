<?php 

namespace g\service;


use g\service\SongsServiceInterface;
use g\store\SongsStoreInterface;
use g\model\SongModelInterface;
use g\model\SongModel;
use Simplon\Mysql\QueryBuilder\ReadQueryBuilder;


/**
 * @package Test\Crud
 */
class SongsService implements SongsServiceInterface
{

	protected $store;	
	
	public function __construct(SongsStoreInterface $store)
	{
		$this->store = $store;
	}

	/**
     *
     * @return SongModelInterface[]|null
     * @throws MysqlException
     */
    public function loadList(): ?array{

    	return $this->store->read();

    }


    /**
     * @param int $id
     *
     * @return SongModelInterface[]|null
     * @throws MysqlException
     */
    public function loadSingle($id): ?SongModelInterface{

    	$model = $this->store->readOne(
    			(new ReadQueryBuilder())->addCondition(SongModelInterface::COLUMN_ID, $id)
		);

		return $model;
    }


}