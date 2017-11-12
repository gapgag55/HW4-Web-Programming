<?php 

class Route {
  public static $isRoute = false;

  public static function callController($path, $location) {
    $cluster    = explode('@', $location);
    $controller = $cluster[0];
    $function   = $cluster[1];

    (new $controller())->$function();
  }
  
  public static function get( $path, $location ) {
    $path = $GLOBALS['ROOT'] . $path;

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == $path) {
      self::callController($path, $location);
      self::$isRoute = true;
    }
  }

  public static function post( $path, $location ) {
    $path = $GLOBALS['ROOT'] . $path;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == $path) {
      self::callController($path, $location);
      self::$isRoute = true;
    }
  }

  public static function any( $path, $location ) {
    if( !self::$isRoute ) {
      self::callController($path, $location);
    }
  }

}