<?php

namespace g\handler;

use \Psr\Http\Message\ServerRequestInterface as IRequest;
use \Psr\Http\Message\ResponseInterface as IResponse;


use g\handler\ActionInterface;

class  ActionHandler implements ActionHandlerInterface 
{
    
    private $handler = [];

    public function add(ActionInterface $actionHandler ){

    	$this->handler[] = $actionHandler;
    }

    public function handle(IRequest $request, IResponse $response , string $action){

    	foreach ($this->handler as  $handler) {
    		
    		if ($handler->support($action) ){
    			return $handler->handle($request,$response);
    		}
    	}

    }
}