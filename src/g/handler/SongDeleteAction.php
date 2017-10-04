<?php 

namespace g\handler;

use g\model\SongModelInterface;
use g\model\SongModel;
use g\service\SongsServiceInterface;
use g\handler\ActionInterface ;

use \Psr\Http\Message\ServerRequestInterface as IRequest;
use \Psr\Http\Message\ResponseInterface as IResponse;



use Slim\Views\PhpRenderer;

/**
 * @package Test\Crud
 */
class SongDeleteAction implements ActionInterface
{


	protected $service;	
	protected $renderer;	

	CONST ACTION = 'DELETE';
	
	public function __construct(SongsServiceInterface $service  , PhpRenderer $renderer )
	{
		$this->service    = $service;
		$this->renderer   = $renderer;
	}


	public function support(string $action): bool{

			return strtoupper($action) == SongDeleteAction::ACTION;
	}


    public function handle(IRequest $request, IResponse $response){

    	$song = $this->service->loadSingle($request->getAttribute("id")); 		

		if (null == $song) {
			//----
		}

		try{
			$result = $this->service->delete($song); 		
		}catch(Exception $e){}

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