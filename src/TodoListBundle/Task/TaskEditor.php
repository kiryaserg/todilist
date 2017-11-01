<?php

namespace TodoListBundle\Task;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use TodoListBundle\Repository\TodoRepository;
use Doctrine\ORM\EntityManager;
use TodoListBundle\Entity\Todo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Description of TaskEditor
 *
 * @author kiryaserg
 */
class TaskEditor {

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var TodoRepository
     */
    private $repository;

    /**
     * 
     * @param TodoRepository $repository
     * @param EntityManager $entityManager
     */
    public function __construct(TodoRepository $repository, EntityManager $entityManager) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * 
     * @param string $taskData
     * @return Todo
     */
    public function createNewTask($taskData) {
        $todo = new Todo();
        $todo->setName($taskData['name']);

        $this->entityManager->persist($todo);
        $this->entityManager->flush();

        return $todo;
    }

    /**
     * 
     * @param string $id
     * @param array $taskData
     * @throws NotFoundHttpException
     */
    public function editTask($id, $taskData) {
        /**
         * @var Todo
         */
        $todo = $this->repository->find($id);

        if (!$todo) {
            throw new NotFoundHttpException('Entity not found');
        }

        if (isset($taskData['name'])) {
            $todo->setName($taskData['name']);
        }

        if (isset($taskData['isread'])) {
            $todo->setIsRead((bool) $taskData['isread']);
        }

        $this->entityManager->flush();
    }

    /**
     * 
     * @param string $id
     */
    public function deleteTask($id) {
        $this->repository->delete($id);
    }

}
