<?php

namespace BleuWebsite\Models;

use BleuWebsite\Core\Models;

/**
 * Newsletters model class
 */
class Newsletters extends Models
{
    /**
     * @var int
     */
    protected $idNewsletters;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var \DateTime
     */
    protected $createAt;


    protected $confirmtoken;

    protected $status="disabled";   

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->table = str_replace(__NAMESPACE__. '\\', '', __CLASS__);
    }

    /**
     * Get the newsletter ID
     *
     * @return int
     */
    public function getIdNewsletters()
    {
        return $this->idNewsletters;
    }

    /**
     * Set the newsletter ID
     *
     * @param int $idNewsletters
     * @return $this
     */
    public function setIdNewsletters($idNewsletters)
    {
        $this->idNewsletters = $idNewsletters;
        return $this;
    }

    /**
     * Get the email address
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the email address
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
     * Get the creation date
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set the creation date
     *
     * @param \DateTime $CreateAt
     * @return $this
     */
    public function setCreateAt($createAt=new \DateTime('now'))
    {
        $this->createAt = $createAt;
        return $this;
    }

    /**
     * Get the confirmation token
     *
     * @return string The confirmation token
     */
    public function getConfirmtoken()
    {
        return $this->confirmtoken;
    }
/**
 * Set the confirmation token
 *
 * @param string $confirmtoken The confirmation token to set
 * @return $this
 */

    public function setConfirmtoken($confirmtoken)
    {
        $this->confirmtoken = $confirmtoken;
        return $this;   
    }

    /**
     * Get the status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
/**
 * Set the value of status
 *
 * @param string $status The new status value
 * @return $this
 */

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;   
    }
}