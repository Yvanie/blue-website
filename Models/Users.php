<?php

namespace BleuWebsite\Models;

use BleuWebsite\Core\Models;

/**
 * Users model class
 */
class Users extends Models
{
    /**
     * @var int
     */
    protected $idUsers;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $role;

    /**
     * Statut
     *
     * @var string
     */
    protected $status;


    protected $createdAt;

    protected $creator;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->table = str_replace(__NAMESPACE__. '\\', '', __CLASS__);
    }

    /**
     * Get the user ID
     *
     * @return int
     */
    public function getIdUsers()
    {
        return $this->idUsers;
    }

    /**
     * Set the user ID
     *
     * @param int $idUsers
     * @return $this
     */
    public function setIdUsers($idUsers)
    {
        $this->idUsers = $idUsers;
        return $this;
    }

    /**
     * Get the username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the username
     *
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    

    /**
     * Get the email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }

    /**
     * Get the role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the role
     *
     * @param string $role
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of Creator
     */ 
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set the value of Creator
     *
     * @return  self
     */ 
    public function setCreator($creator)
    {
        $this->creator = $creator;

        return $this;
    }
}