<?php

namespace TodoListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TodoListBundle\Entity\Todo;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TodoListBundle:Default:index.html.twig');
    }
    /**
     * 
     * @return JsonResponse
     */
    public function allAction()
    {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository(Todo::class);
        
        return new JsonResponse($repository->findAll());
    }
    
    /**
     * 
     * @return JsonResponse
     */
    public function oneAction($id)
    {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository(Todo::class);
        
        return new JsonResponse($repository->find($id));
    }
    
    /**
     * @return JsonResponse
     */
    public function newAction(Request $request)
    {
        if(!$request->request->has('name')){
            return new JsonResponse('Parameter \'name\' is required', Response::HTTP_NOT_ACCEPTABLE);
        }
       
        $name = $request->get('name');
        $todo = new Todo();
        $todo->setName($name);

        $entityManager = $this->getDoctrine()->getManager(); 
        $entityManager->persist($todo);
        $entityManager->flush();
         
        return new Response(null, Response::HTTP_ACCEPTED, ['Location'=>$this->generateUrl('one_task',['id'=>$todo->getId()])] ); 
    }
    
    /**
     * @param string $id
     */
    public function deleteAction($id)
    {
        $this->getDoctrine()
              ->getManager()
              ->getRepository(Todo::class)
              ->delete($id);
        
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
    
    /**
     * 
     * @param string $id
     * @param Request $request
     * @return JsonResponse
     */
    public function editAction($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager ->getRepository(Todo::class);
        
        /**
         * @var Todo
         */
        $todo = $repository->find($id);
        
        if(!$todo){
            return new JsonResponse('Item not found', Response::HTTP_NOT_FOUND);
        }
        
        if($request->request->has('name')){
            $todo->setName($request->get('name'));
        }
        
        if($request->request->has('isread')){
            $todo->setIsRead((bool) $request->get('isread'));
        }
        
        $entityManager->flush();
        
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
