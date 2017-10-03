<?php

namespace g\model;

use Simplon\Mysql\Crud\CrudModel;

use g\model\SongModelInterface;

/**
 * @package Test\Crud
 */
class SongModel extends CrudModel implements SongModelInterface
{
    
    /**
     * @var int
     */
    protected $id;
    
    /**
     * @var string
     */
    protected $name;


    /**
     * @var string  
     */
    protected $publishDate;
    

    public function __construct(string $name = null , string $publishDate = null )
    {
        $this->name    = $name;
        $this->publishDate    = $publishDate;
    }


    
    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->id;
    }

    /**
     * @param int $id
     *
     * @return SongModelInterface
     */
    public function setId(int $id): SongModelInterface
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return SongModelInterface
     */
    public function setName(string $name): SongModelInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string 
     */
    public function getPublishDate(): string 
    {
        return $this->publishDate;
    }

    /**
     * @param string  $publishDate
     *
     * @return SongModelInterface
     */
    public function setPublishDate(string  $publishDate): SongModelInterface
    {
        $this->publishDate = $publishDate;

        return $this;
    }


}