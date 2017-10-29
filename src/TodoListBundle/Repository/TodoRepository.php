<?php
namespace TodoListBundle\Repository;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Doctrine\ORM\EntityRepository;
/**
 * Description of TodoRepository
 *
 * @author kiryaserg
 */
class TodoRepository extends EntityRepository {
    /**
     * 
     * @param string $id
     */
    public function delete($id){
        
        $this->getEntityManager()->createQuery(
              'DELETE TodoListBundle:Todo todo 
               WHERE todo.id = :id')
            ->setParameter("id", $id)
            ->execute();
    }
}
