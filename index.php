<?php

/*
 * Set debugging ON
 * Do not use in production
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);

/*
 * Define some core constants
 */
define('ROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

/**
 * A simple wrapper function around print_r and wrapped in HTML pre tags
 * @param mixed $w
 * @return string
 */
function pr($w)
{
	return '<pre>' . print_r($w, true) . '</pre>';
}

/*
 * The autoloader, quick-nd-dirty
 */
spl_autoload_register(function($class) {
	$file = ROOT . DS . str_replace('\\', DS, $class) . '.php';

	if(file_exists($file))
	{
		include_once($file);
	}
	else
	{
		trigger_error('The requested file <em>' . $file . '</em> could not be found', E_USER_ERROR);
	}
});

/*
 * Let the fun begin
 */

$acl = new ACL();
print pr($acl);

print pr($acl->test('guest', 'node', 'read'));
print pr($acl->test('guest', 'node', 'create'));
print pr($acl->test('guest', 'node', 'update'));
print pr($acl->test('guest', 'node', 'delete'));

print pr($acl->test('user', 'node', 'read'));
print pr($acl->test('user', 'node', 'create'));
print pr($acl->test('user', 'node', 'update'));
print pr($acl->test('user', 'node', 'delete'));
