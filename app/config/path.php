<?php
define('ROOT', dirname(dirname(__DIR__)) . '/');
define('APP', ROOT . 'app/');
define('MODELS', APP . 'models/');
define('CONTROLLERS', APP . 'controllers/');
define('TEMPLATES', APP . 'templates/');
define('CONFIG', APP . 'config/');
define('LIBS', ROOT . 'libs/');
define('ABSTRACT_LIBS', ROOT . 'libs/abstract/');
define('SMARTY_MAIN', ROOT . 'libs/smarty/');
define('CLI', ROOT.'cli/');
define('TASKS', CLI.'tasks/');
define('TASKS_DATA', CLI.'data/');

// for smarty spl

define('COMPILE_DIR', ROOT . 'cached/compile');
define('CACHED_DIR', ROOT . 'cached/cached');
define('CONFIG_DIR', ROOT . 'config/smarty');

if (isset($_SERVER['HTTP_HOST'])) {
   define('HOST', $_SERVER['HTTP_HOST']);
}

$includePath = array(LIBS, MODELS, ABSTRACT_LIBS, SMARTY_MAIN, TASKS);
set_include_path(implode($includePath, PATH_SEPARATOR));
function autoloadMain($class) {
   if (!class_exists($class)) {
      require $class . '.php';
   }
}

spl_autoload_register('autoloadMain');
