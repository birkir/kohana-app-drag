<?php defined('SYSPATH') or die('No direct script access.');

require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	require SYSPATH.'classes/kohana'.EXT;
}

date_default_timezone_set('Atlantic/Reykjavik');

setlocale(LC_ALL, 'is_IS.utf-8');

spl_autoload_register(array('Kohana', 'auto_load'));

ini_set('unserialize_callback_func', 'spl_autoload_call');

I18n::lang('is-is');

if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

Kohana::init(array(
	'base_url'   => '/',
	'index_file' => '',
	'charset'    => 'utf-8',
	'cache_dir'  => APPPATH.'/cache',
	'errors'     => TRUE,
	'profile'    => TRUE,
	'caching'    => FALSE
));

Kohana::$log->attach(new Log_File(APPPATH.'logs'));

Kohana::$config->attach(new Config_File);

Kohana::modules(array(
	'auth'       => MODPATH.'auth',       // Basic authentication
	'cache'      => MODPATH.'cache',      // Caching with multiple backends
	'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	'database'   => MODPATH.'database',   // Database access
	'image'      => MODPATH.'image',      // Image manipulation
	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	'userguide'  => MODPATH.'userguide',  // User guide and API documentation
));

Route::set('media', 'media/<folder>/<file>', array('file' => '.+'))
	->defaults(array(
		'controller' => 'media',
		'action'     => 'index'
	));

Route::set('default', '(<controller>(/<id>(/<action>)))')
	->defaults(array(
		'controller' => 'dashboard',
		'action'     => 'index',
	));
