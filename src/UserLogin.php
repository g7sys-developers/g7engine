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
     * Constructs class to login
     * 
     * @param string $username
     * @param string $password
     * @return void
     */
    public function __construct(
        protected string $username, 
        protected string $password
    ) {}

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
    public function getPassword(): string
    {
        return $this->password;
    }
}
?>