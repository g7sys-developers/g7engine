<?php
  namespace G7Engine;

  class Session {
    const SESSION_ALIAS = 'g7sys';

    /**
     * Get session by name
     * 
     * @param string $name
     * @return mixed
     */
    public static function get(string $name) : mixed {
      if (isset($_SESSION[self::SESSION_ALIAS][$name])) {
        return $_SESSION[self::SESSION_ALIAS][$name];
      }

      return null;
    }

    /**
     * Set session by name
     * 
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public static function set(string $name, $value) : void {
      $_SESSION[self::SESSION_ALIAS][$name] = $value;
    }

    /**
     * Set may in session
     * 
     * @param array $data
     * @return void
     */
    public static function setMany(array $data) : void {
      foreach ($data as $name => $value) {
        self::set($name, $value);
      }
    }

    /**
     * Exists session
     * 
     * @param
     * @return bool
     */
    public static function exists() : bool {
      return isset($_SESSION[self::SESSION_ALIAS]);
    }

    /**
     * Has session by name
     * 
     * @param string $name
     * @return bool
     */
    public static function has(string $name) : bool {
      return isset($_SESSION[self::SESSION_ALIAS][$name]);
    }
  }