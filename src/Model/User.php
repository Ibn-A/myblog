<?php
namespace App\model;

class User {

    /**
     * @var int
     */
    private $id_user;
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * Get the value of username
     *
     * @return  string
     */ 
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */ 
    public function setUsername(string $username):self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password):self
    {
        $this->password = $password;

        return $this;
    }

    

    /**
     * Get the value of id_user
     *
     * @return  int
     */ 
    public function getId(): ?int
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @param  int  $id_user
     *
     * @return  self
     */ 
    public function setId(int $id): self
    {
        $this->id_user = $id;

        return $this;
    }
}