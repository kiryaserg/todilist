<?php

namespace TodoListBundle\Entity;

/**
 * Todo
 */
class Todo implements \JsonSerializable 
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $isRead = false;
    
    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * 
     * @param string $user
     */
    public function __construct() {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Todo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set isRead
     *
     * @param boolean $isRead
     *
     * @return Todo
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get isRead
     *
     * @return boolean
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * @return array
     */
    public function  jsonSerialize()
    {
        $vars = get_object_vars($this);
        
        if(isset($vars['createdAt']) && is_object($vars['createdAt']) ){
            $vars['createdAt'] = $vars['createdAt']->format('Y-m-d H:i:s'); 
        } 
        
        return  $vars; 
    }
}
