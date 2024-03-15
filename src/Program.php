<?php
  namespace G7Engine;
  use sysaengine\conn;

  class Program {
    /**
     * Get all program list
     * 
     * @param string $username
     * @param int $access_level_id
     * @return array
     */
    public static function getProgramList(string $username, int $access_level_id) : array {
      $DB = conn::DBALConnection();
      $result = $DB->fetchAllAssociative("SELECT * FROM accesslevel.f_return_programs(?::varchar, ?::int)", [$username, $access_level_id]);
      return $result;
    }

    /**
     * Check if user has permission to access a program
     * 
     * @param string $username
     * @param int $access_level_id
     * @param string $module
     * @param string $program
     * @return bool
     */
    public static function hasPermission(string $username, int $access_level_id, string $module, string $program) : bool {
      $DB = conn::DBALConnection();
      $result = $DB->fetchOne("SELECT accesslevel.f_permissiontoaccesspage(?::varchar, ?::int, ?::varchar, ?::varchar)", [$username, $access_level_id, $module, $program]);
      return $result;
    }

    /**
     * Check if user has permission to access prgorama by menu command
     * 
     * @param string $username
     * @param int $access_level_id
     * @param string $menu_command
     * @return bool
     */
    public static function hasPermissionByMenuCommand(string $username, int $access_level_id, string $menu_command) : bool {
      $DB = conn::DBALConnection();
      $result = $DB->fetchAssociative("SELECT modprg, ideprg FROM tabela008 WHERE comando_menu=?", [$menu_command]);
      if($result === false)
        return false;

      return self::hasPermission($username, $access_level_id, $result['modprg'], $result['ideprg']);
    }
  }
?>