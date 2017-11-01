<?php

namespace TodoListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends Controller
{
    public function indexAction()
    {
        return $this->render('TodoListBundle:Default:index.html.twig', ['tasks' => json_encode($this->get('todo_list.todo_repository')->findAll(), JSON_PRETTY_PRINT) ]);
    }
    /**
     * 
     * @return JsonResponse
     */
    public function allAction()
    {
        $repository = $this->get('todo_list.todo_repository');
        
        return new JsonResponse($repository->findAll());
    }
    
    /**
     * 
     * @return JsonResponse
     */
    public function oneAction($id)
    {
        $task = $this->get('todo_list.todo_repository')->find($id);
        
        if(!$task){
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }
        
        return new JsonResponse($task);
    }
    
    /**
     * @return JsonResponse
     */
    public function newAction(Request $request)
    {
        if(!$request->request->has('name')){
            return new JsonResponse('Parameter \'name\' is required', Response::HTTP_NOT_ACCEPTABLE);
        }
       
        $todo = $this->get('todo_list.task_editor')->createNewTask($request->request->all());
         
        return new Response(null, Response::HTTP_ACCEPTED, ['Location'=>$this->generateUrl('one_task',['id'=>$todo->getId()])] ); 
    }
    
    /**
     * @param string $id
     */
    public function deleteAction($id)
    {
        $this->get('todo_list.task_editor')->deleteTask($id);
        
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
        try{
            $this->get('todo_list.task_editor')->editTask($id, $request->request->all());
        }
        catch(NotFoundHttpException $e){
            return new JsonResponse($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
        
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
