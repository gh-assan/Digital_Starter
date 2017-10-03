<?php

namespace g\transformer;

use g\store\SongsStoreInterface;
use g\transformer\TransformerException;


/**
 * @package Test\Crud
 */
class SongTransformer implements SongTransformerInterface
{

	/**
     * @param SongModelInterface $song
     *
     * @return array
     * @throws MysqlException
     */
    public function transform($song): array{


    	if (null == $song){
    		throw new TransformerException("Error transforming the song");
    		
    	}
    	
    	$result = [] ; 

		$result['name']        = $song->getName();    	
		$result['publishDate'] = $song->getPublishDate();    	

		return $result;	
    }

    /**
     * @param SongModelInterface[] $songs
     *
     * @return array
     * @throws MysqlException
     */
    public function transformSongs($songs): array{


    	if (null == $songs){
    		throw new TransformerException("Error transforming the song list");
    		
    	}

    	$result = [] ; 
    	foreach ($songs as $key => $song) {
    		$result[] = $this->transform($song);
    	}
    	
		return $result;	
    }

}