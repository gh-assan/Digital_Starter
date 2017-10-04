<?php

namespace g\handler;

use \Psr\Http\Message\ServerRequestInterface as IRequest;
use \Psr\Http\Message\ResponseInterface as IResponse;


use g\handler\ActionInterface;

interface ActionHandlerInterface 
{
    
    public function add(ActionInterface $actionHandler );
    public function handle(IRequest $request, IResponse $response , string $action);
}