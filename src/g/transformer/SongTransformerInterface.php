<?php

namespace g\transformer;

use g\model\SongModelInterface;
use g\transformer\TransformerException;


interface SongTransformerInterface
{

	/**
     * @param SongModelInterface $song
     *
     * @return array
     * @throws MysqlException
     */
    public function transform($song): array;


    /**
     * @param SongModelInterface[] $songs
     *
     * @return array
     * @throws MysqlException
     */
    public function transformSongs($songs): array;


}

