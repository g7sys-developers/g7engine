<?php
namespace G7Engine;

use G7Engine\traits\Auth;
use G7Engine\interfaces\Auth as AuthInterface;
use sysaengine\conn;

class UserLogin implements AuthInterface{
    use Auth;

    /**
     * Database connection
     * 
     * @var object
     */
    private object $DB;

    /**
     * Username
     * 
     * @var string
     */
    private string $username;

    /**
     * Password
     * 
     * @var string
     */
    private string $password;

    /**
     * Constructs class to login
     * 
     * @param string $username
     * @param string $password
     * @return void
     */
    public function __construct() {
        $this->DB = conn::DB();
    }

    /**
     * Get connection
     * 
     * @return object
     */
    public function getBuilder(): object
    {
        return $this->DB;
    }

    /**
     * Get username
     * 
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get password
     * 
     * @return string
     */
    protected function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set username
     * 
     * @param string $username
     * @return UserLogin
     */
    public function setUsername(string $username): UserLogin
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Set password
     * 
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): UserLogin
    {
        $this->password = $password;
        return $this;
    }
}
?>