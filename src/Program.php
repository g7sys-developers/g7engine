<?php
  namespace G7Engine;
  use sysaengine\conn;

  class Program {
    /**
     * Get all program list
     * 
     * @param int $user_id
     * @param int $access_level_id
     * @return array
     */
    public static function getProgramList(int $user_id, int $access_level_id) : array {
      $DB = conn::DB();
      $query = $DB->query("SELECT accesslevel.f_return_programa(?, ?)", [$user_id, $access_level_id]);
      $result = $query->fetchAll();
      return $result;
    }
  }
?>