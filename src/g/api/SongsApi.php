<?php 

namespace g\api;

use g\model\SongModelInterface;
use g\model\SongModel;
use g\service\SongsServiceInterface;
use g\transformer\SongTransformerInterface;

use \Psr\Http\Message\ServerRequestInterface as IRequest;
use Slim\Http\Response as IResponse;



/**
 * @package Test\Crud
 */
class SongsApi 
{


	protected $service;	
	protected $transformer;	
	
	public function __construct(SongsServiceInterface $service , SongTransformerInterface $transformer  )
	{
		$this->service    = $service;
		$this->transformer    = $transformer;
	}
	

	public function latestAction(IRequest $request, IResponse $response, $args){
	
		$songs = $this->service->loadLatest(); 
		


		$songs = $this->transformer->transformSongs($songs);

		$data = [
              "songs" => $songs
		];


		$response = $response->withJson($data );

		return $response;

	}

}