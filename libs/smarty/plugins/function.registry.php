<?php
/**
 * ${NAME}
 * 
 * @package www
 * @copyright 2011 OOO NetExpert
 * @license closed
 */
function smarty_function_registry($params, $template){
  return Registry::get($params['name']);
}
?>