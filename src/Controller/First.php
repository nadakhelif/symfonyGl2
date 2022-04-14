<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class first {
    /**
     * @Route("/first")
     */
public function index (){
    return new Response("<h1>hello everybody</h1>");

}
}
?>