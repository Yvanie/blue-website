<?php

namespace BleuWebsite\Models;

use BleuWebsite\Core\Models;

class Blogs extends Models{
    protected $idBlog;
    protected $title;
    protected $content;
    protected $idUsers;
    protected $createAt;
    protected $updateAt;
    protected $image;
    protected $authors;
    

    public function __construct()
    {
        $this->table = str_replace(__NAMESPACE__. '\\', '', __CLASS__);
    }

    /**
     * Get the value of idBlog
     */ 
    public function getIdBlog()
    {
        return $this->idBlog;
    }

    /**
     * Set the value of idBlog
     *
     * @return  self
     */ 
    public function setIdBlog($idBlog)
    {
        $this->idBlog = $idBlog;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of idUsers
     */ 
    public function getIdUsers()
    {
        return $this->idUsers;
    }

    /**
     * Set the value of idUsers
     *
     * @return  self
     */ 
    public function setIdUsers($idUsers)
    {
        $this->idUsers = $idUsers;

        return $this;
    }

    /**
     * Get the value of createAt
     */ 
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set the value of createAt
     *
     * @return  self
     */ 
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get the value of updateAt
     */ 
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set the value of updateAt
     *
     * @return  self
     */ 
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
    

    /**
     * Get the value of author
     */ 
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */ 
    public function setAuthors($authors)
    {
        $this->authors = $authors;

        return $this;
    }


 
}