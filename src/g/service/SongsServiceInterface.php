<?php 

namespace g\service;

use g\model\SongModelInterface;

interface SongsServiceInterface 
{

	/**
     *
     * @return SongModel[]|null
     * @throws MysqlException
     */
    public function loadList(): ?array;


    /**
     * @param int $id
     *
     * @return SongModelInterface[]|null
     * @throws MysqlException
     */
    public function loadSingle($id): ?SongModelInterface;


    /**
     * @param SongModelInterface $song
     *
     * @return SongModelInterface
     * @throws MysqlException
     */
    public function create($song): SongModelInterface;

    /**
     * @param SongModelInterface $song
     *
     * @return bool
     * @throws MysqlException
     */
    public function delete($song): bool;
}