<?php
define('ROOT', __DIR__.'/../');
define('APP', ROOT.'app/');
define('MODELS', APP.'models/');
define('CONTROLLERS', APP.'controllers/');
define('TEMPLATES', APP.'templates/');
define('CONFIG', APP.'config/');
define('LIBS', ROOT.'libs/');
define('ABSTRACT_LIBS', ROOT.'libs/abstract');


define('COMPILE_DIR', ROOT.'cached/compile');
define('CACHED_DIR', ROOT.'cached/cached');
define('CONFIG_DIR', ROOT.'config/smarty');

define('HOST', $_SERVER['HTTP_HOST']);
