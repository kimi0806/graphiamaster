<?php
define('App', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('Controller', App . 'controller' . DIRECTORY_SEPARATOR);
define('Core', App . 'core' . DIRECTORY_SEPARATOR);
define('Model', App . 'model' . DIRECTORY_SEPARATOR);
define('View', App . 'view' . DIRECTORY_SEPARATOR);

$modules = [App, Controller, Core, Model, View];

set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));
spl_autoload_register('spl_autoload', false);
?>