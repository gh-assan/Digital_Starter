<?php 

namespace g\controller;

use g\model\SongModelInterface;
use g\model\SongModel;
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
		
		$data = [
              "songs" => $songs
		];

		return $this->renderer->render($response, 'songs.phtml', $data);

	}


	public function getAction(IRequest $request, IResponse $response, $args){
	
		$song = $this->service->loadSingle($request->getAttribute("id")); 		
		
		$data = [
              "song" => $song
		];

		return $this->renderer->render($response, 'song_edit.phtml', $data);

	}


	public function addAction(IRequest $request, IResponse $response, $args){
	
		$data = [];
		return $this->renderer->render($response, 'song_create.phtml', $data);

	}


	public function createAction(IRequest $request, IResponse $response, $args){
	
		
		$body = $request->getParsedBody();

		$name = $body['name'];
		$publishDate = $body['publishDate'];

		$song = new SongModel($name,$publishDate);

		$song = $this->service->create($song); 		
		
		$data = [
              "message" => "Song created Successfully"
		];

		return $this->renderer->render($response, 'songs.phtml', $data);

	}


	public function deleteAction(IRequest $request, IResponse $response, $args){
	
		
		$song = $this->service->loadSingle($request->getAttribute("id")); 		

		if (null == $song) {
			//----
		}


		$result = $this->service->delete($song); 		

		if( $result ) { 
		
			$data = [
	              "message" => "Song deleted Successfully"
			];
		}else{
			$data = [
	              "message" => "failed to delete the Song"
			];
		}

		return $this->renderer->render($response, 'songs.phtml', $data);

	}

	
}