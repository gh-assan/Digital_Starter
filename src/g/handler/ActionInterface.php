<?php

namespace g\handler;

use \Psr\Http\Message\ServerRequestInterface as IRequest;
use \Psr\Http\Message\ResponseInterface as IResponse;


interface ActionInterface 
{
    
    public function support(string $action): bool;
    public function handle(IRequest $request, IResponse $response);
}