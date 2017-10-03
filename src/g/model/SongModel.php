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

}