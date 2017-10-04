<?php

namespace g\transformer;

use \Psr\Http\Message\ServerRequestInterface as IRequest;
use g\transformer\TransformerException;


interface SongFormTransformerInterface
{

	/**
     * @param ServerRequestInterface $request
     *
     * @return array
     * @throws MysqlException
     */
    public function transform(IRequest $request): array;



}

