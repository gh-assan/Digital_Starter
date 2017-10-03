<?php 

namespace g\controller;

use g\model\SongModelInterface;
use g\service\SongServiceInterface;

use Slim\Views\PhpRenderer;

/**
 * @package Test\Crud
 */
class SongsContrller 
{


	protected $service;	
	protected $model;	
	protected $renderer;	
	
	public function __construct(SongServiceInterface $service , SongModelInterface $model , PhpRenderer $renderer )
	{
		$this->service    = $service;
		$this->model      = $model;
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