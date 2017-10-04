<?php 

namespace g\service;


use g\service\SongsServiceInterface;
use g\store\SongsStoreInterface;
use g\model\SongModelInterface;
use g\model\SongModel;
use Simplon\Mysql\QueryBuilder\ReadQueryBuilder;
use Simplon\Mysql\QueryBuilder\CreateQueryBuilder;
use Simplon\Mysql\QueryBuilder\DeleteQueryBuilder;
use Simplon\Mysql\QueryBuilder\UpdateQueryBuilder;
use Simplon\Mysql\MysqlException;


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


    /**
     * @param SongModelInterface $song
     *
     * @return SongModelInterface
     * @throws MysqlException
     */
    public function create($song): SongModelInterface{

    	$model = $this->store->create(
    			(new CreateQueryBuilder())->setModel($song)
		);


    	if (null == $model->getId()){
    		throw new MysqlException("Failed to create the song");
    	}

		return $model;	
    }


    /**
     * @param SongModelInterface $song
     *
     * @return SongModelInterface
     * @throws MysqlException
     */
    public function update($song): SongModelInterface{

        
        if (null == $song){
            throw new MysqlException("Can not update empty song");
        }

        if (null == $song->getId() ){
            throw new MysqlException("Can not update empty id");
        }

        return $this->store->update(
               (new UpdateQueryBuilder())
                    ->setModel($song)
                    ->addCondition(SongModelInterface::COLUMN_ID, $song->getId())
        );

    }


    /**
     * @param SongModelInterface $song
     *
     * @return bool
     * @throws MysqlException
     */
    public function delete($song): bool{


        if (null == $song){
            throw new MysqlException("Can not delete empty song");
        }

        return $this->store->delete(
               (new DeleteQueryBuilder())
                    ->setModel($song)
                    ->addCondition(SongModelInterface::COLUMN_ID, $song->getId())
        );
  
    }



    /**
     * @param int $rows
     * 
     * @return SongModel[]|null
     * @throws MysqlException
     */
    public function loadLatest($rows = SongsServiceInterface::LATEST_ROWS): ?array{

        $model = $this->store->read(
                (new ReadQueryBuilder())->addSorting(SongModelInterface::COLUMN_PUBLISH_DATE , 'desc' )
                                        ->setLimit($rows)
        );

        return $model;   
    }



}