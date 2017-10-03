<?php 

namespace g\service;


interface SongsServiceInterface 
{

	/**
     *
     * @return SongModel[]|null
     * @throws MysqlException
     */
    public function loadList(): ?array;
}