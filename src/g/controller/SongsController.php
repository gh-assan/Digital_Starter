<?php 

namespace g\controller;

use g\model\SongModelInterface;
use g\model\SongModel;
use g\service\SongsServiceInterface;
use g\handler\ActionHandlerInterface;

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
	protected $handler;	
	
	public function __construct(SongsServiceInterface $service  , PhpRenderer $renderer , ActionHandlerInterface $handler )
	{
		$this->service    = $service;
		$this->renderer   = $renderer;
		$this->handler    = $handler;
	}
	
	
	public function listAction(IRequest $request, IResponse $response, $args){
	
		$songs = $this->service->loadList(); 
		
		$data = [
              "songs" => $songs
		];

		return $this->renderer->render($response, 'songs.phtml', $data);

	}


	public function getAction(IRequest $request, IResponse $response, $args){
	
		
		$action = $request->getQueryParam("action" , 'GET');
		
		return $this->handler->handle($request,$response , $action);

	}


	public function addAction(IRequest $request, IResponse $response, $args){
	
		$data = [];
		return $this->renderer->render($response, 'song_create.phtml', $data);

	}


	public function createAction(IRequest $request, IResponse $response, $args){
	
		$action = $request->getQueryParam("action" , 'CREATE');
		
		return $this->handler->handle($request,$response , $action);

	}


	public function updateAction(IRequest $request, IResponse $response, $args){
		
		$action = $request->getQueryParam("action" , 'UPDATE');
		
		return $this->handler->handle($request,$response , $action);

	}


}