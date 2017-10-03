<?php

namespace g\model;

use Simplon\Mysql\Crud\CrudModelInterface;

interface SongModelInterface extends CrudModelInterface
{

    const COLUMN_ID = 'id';
    const COLUMN_NAME = 'name';
    const COLUMN_PUBLISH_DATE = 'publish_date';
    
    
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     *
     * @return SongModelInterface
     */
    public function setId(int $id): SongModelInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     *
     * @return SongModelInterface
     */
    public function setName(string $name): SongModelInterface;

    /**
     * @return string 
     */
    public function getPublishDate(): string ;

    /**
     * @param string  $publishDate
     *
     * @return SongModelInterface
     */
    public function setPublishDate(string  $publishDate): SongModelInterface;

}