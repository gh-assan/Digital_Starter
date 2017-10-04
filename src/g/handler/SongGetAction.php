<?php 

namespace g\handler;

use g\model\SongModelInterface;
use g\model\SongModel;
use g\service\SongsServiceInterface;
use g\handler\Actioninterface ;

use \Psr\Http\Message\ServerRequestInterface as IRequest;
use \Psr\Http\Message\ResponseInterface as IResponse;



use Slim\Views\PhpRenderer;

class SongGetAction implements Actioninterface 
{


	protected $service;	
	protected $renderer;	

	CONST ACTION = 'GET';
	
	public function __construct(SongsServiceInterface $service  , PhpRenderer $renderer )
	{
		$this->service    = $service;
		$this->renderer   = $renderer;
	}


	public function support(string $action): bool{

			return strtoupper($action) == SongGetAction::ACTION;
	}


    public function handle(IRequest $request, IResponse $response){

    	$song = $this->service->loadSingle($request->getAttribute("id")); 		
		
		$data = [
              "song" => $song
		];

		return $this->renderer->render($response, 'song_edit.phtml', $data);
    }
}