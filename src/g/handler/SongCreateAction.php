<?php 

namespace g\handler;

use g\model\SongModelInterface;
use g\model\SongModel;
use g\service\SongsServiceInterface;
use g\handler\ActionInterface ;
use g\transformer\SongFormTransformerInterface;
use g\form\FormInterface;

use \Psr\Http\Message\ServerRequestInterface as IRequest;
use \Psr\Http\Message\ResponseInterface as IResponse;



use Slim\Views\PhpRenderer;

/**
 * @package Test\Crud
 */
class SongCreateAction implements ActionInterface
{


	protected $service;	
	protected $renderer;	
	protected $transformer;	
	protected $form;	

	CONST ACTION = 'CREATE';
	
	public function __construct(SongsServiceInterface $service  , PhpRenderer $renderer , SongFormTransformerInterface $transformer , FormInterface $form)
	{
		$this->service    = $service;
		$this->renderer   = $renderer;
		$this->transformer   = $transformer;
		$this->form   	  = $form;
	}


	public function support(string $action): bool{

			return strtoupper($action) == SongCreateAction::ACTION;
	}


    public function handle(IRequest $request, IResponse $response){

    	$song = $this->transformer->transform($request);
    	
    	if (!$this->form->build()->validate($song)){

    		$errors = $this->form->getErrors();
    		$data = [
              "message" => $errors
			];

			return $this->renderer->render($response, 'song_create.phtml', $data);	
    	}

		$song = new SongModel($song['name'],$song['publishDate']);


		$song = $this->service->create($song); 		
		
		$data = [
              "message" => "Song created Successfully"
		];

		//return $this->renderer->render($response, 'songs.phtml', $data);

		return $response->withRedirect('/songs');

    }
}