<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ToDoController extends AbstractController
{
    /** 
     * @Route("/todo" , name="todo")
    */
    
    public function index(SessionInterface $session): Response
    {
        if(! $session-> has('todo') ){
            $todo=[
                'numero1'=>'koum fel sbeh ',
                '10h'=>'emchi akra',
                '19'=>'taacha',
            ];
            $session->set('todo',$todo);
            $this->addFlash(
               'info',
               'hello everybody'
            );

        }

        return $this->render('to_do/index.html.twig');
    }
    /**
     * @Route("/add/{name}/{content}", name="addTodo")
     */
    public function addTodo($name, $content, SessionInterface $session) {

        
        if (!$session->has('todo')) {
            
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        } else {
            
            $todo = $session->get('todo');
            if (isset($todo[$name])) {
                
                $this->addFlash('error', "Le todo $name existe déjà");
            } else {
                
                $todo[$name] = $content;
                $session->set('todo', $todo);
                $this->addFlash('success', "Le todo $name a été ajouté avec succès");
            }
        }
        return $this->redirectToRoute('todo');
    }
    /**
     * @Route("/delete/{name}", name="deleteTodo")
     */
    public function deleteTodo($name, SessionInterface $session) {

        
        if (!$session->has('todo')) {
            
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        } else {
            
            $todo = $session->get('todo');
            if (isset($todo[$name])) {
                unset($todo[$name]);
                $session->set('todo', $todo);
                $this->addFlash('success', "Le todo $name is deleted");
            } else {
                $this->addFlash('error', "Le todo $name n'existe pas ");
            }
        }
        return $this->redirectToRoute('todo');
    }
    
}

