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
class SongUpdateAction implements ActionInterface
{


	protected $service;	
	protected $renderer;	
	protected $transformer;	
	protected $form;	

	CONST ACTION = 'UPDATE';
	
	public function __construct(SongsServiceInterface $service  , PhpRenderer $renderer , SongFormTransformerInterface $transformer , FormInterface $form)
	{
		$this->service    = $service;
		$this->renderer   = $renderer;
		$this->transformer   = $transformer;
		$this->form   	  = $form;
	}


	public function support(string $action): bool{

			return strtoupper($action) == SongUpdateAction::ACTION;
	}


    public function handle(IRequest $request, IResponse $response){

    	$song = $this->transformer->transform($request);
    	$oldSong = $this->service->loadSingle($request->getAttribute("id")); 		
    	
    	if (!$this->form->build()->validate($song)){

    		$errors = $this->form->getErrors();
    		$data = [
              "message" => $errors,
               "song" => $oldSong
			];

			return $this->renderer->render($response, 'song_edit.phtml', $data);	
    	}

    	


		if (null == $oldSong) {
			//----
		}


		$oldSong->setName($song['name']);
		$oldSong->setPublishDate($song['publishDate']);


		$song = $this->service->update($oldSong); 	
		
		$data = [
              "message" => "Song updated Successfully"
		];

		//return $this->renderer->render($response, 'songs.phtml', $data);

		return $response->withRedirect('/songs');

    }
}