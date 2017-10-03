<?php 

namespace g\service;


use g\service\SongServiceInterface;
use g\store\SongsStoreInterface;



/**
 * @package Test\Crud
 */
class SongsService implements SongServiceInterface
{

	protected $store;	
	
	public function __construct(SongsStoreInterface $store)
	{
		$this->store = $store;
	}

	/**
     *
     * @return SongModel[]|null
     * @throws MysqlException
     */
    public function loadList(): ?array{

    	return $this->store->read();

    }

}