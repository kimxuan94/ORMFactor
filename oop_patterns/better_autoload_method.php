You don't need exceptions to figure out if a class can be autoloaded. This is much simpler.

<?php
//Define autoloader
function __autoload($className) {
      if (file_exists($className . '.php')) {
          require_once $className . '.php';
          return true;
      }
      return false;
}

function canClassBeAutloaded($className) {
      return class_exists($className);
}
?>
