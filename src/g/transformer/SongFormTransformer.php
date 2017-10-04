<?php

namespace g\transformer;

use g\transformer\SongFormTransformerInterface;
use g\transformer\TransformerException;
use \Psr\Http\Message\ServerRequestInterface as IRequest;


/**
 * @package Test\Crud
 */
class SongFormTransformer implements SongFormTransformerInterface
{

	/**
     * @param ServerRequestInterface $request
     *
     * @return array
     * @throws MysqlException
     */
    public function transform(IRequest $request): array{

    	
        $result = [] ; 

        if ($request->isGet()) {
            $result['name'] = $request->getAttribute("name");
            $result['publishDate'] = $request->getAttribute("publishDate");
        }else if ($request->isPost()) {

            $body = $request->getParsedBody();

            $result['name'] = $body['name'];
            $result['publishDate'] = $body['publishDate'];
        }

		return $result;	
    }


}