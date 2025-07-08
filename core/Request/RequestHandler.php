<?php


namespace Core\Request;


class RequestHandler
{
    public function __construct(private Request $request){}

    public function getRequestUri(): string
    {
        return $this->closure(function (){
            return $this->getUri();
        });
    }

    private function closure($closure){
        return $closure->bindTo($this->request, Request::class)();
    }
}