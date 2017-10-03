<?php 

namespace g\controller;

use g\model\SongModelInterface;
use g\service\SongsServiceInterface;

use \Psr\Http\Message\ServerRequestInterface as IRequest;
use \Psr\Http\Message\ResponseInterface as IResponse;


use Slim\Views\PhpRenderer;

/**
 * @package Test\Crud
 */
class SongsController 
{


	protected $service;	
	protected $renderer;	
	
	public function __construct(SongsServiceInterface $service  , PhpRenderer $renderer )
	{
		$this->service    = $service;
		$this->renderer   = $renderer;
	}
	
	/*
	public function getAction(IRequest $request, IResponse $response, $args){				
	
		$result = $this->service->loadSingle($request->getAttribute("id")); 		
		$response = $response->withJson($result);
		return $response;		
	}
	*/
	
	public function listAction(IRequest $request, IResponse $response, $args){
	
		$songs = $this->service->loadList(); 
		//$response = $response->withJson($result);

		$data = [
              "songs" => $songs
		];

		return $this->renderer->render($response, 'songs.phtml', $data);

		//return $response;		
	}
	
}