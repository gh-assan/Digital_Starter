<?php 

namespace g\service;


interface SongServiceInterface 
{

	/**
     *
     * @return SongModel[]|null
     * @throws MysqlException
     */
    public function loadList(): ?array;
}