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

setlocale(LC_ALL, 'is_IS');

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

Route::set('competitions', 'competitions(/<action>)')
	->defaults(array(
		'controller' => 'competition',
		'action'     => 'list'
	));

Route::set('competition', 'competition(/<competition>(/<action>))')
	->defaults(array(
		'controller' => 'competition',
		'action'     => 'details'
	));

Route::set('class', 'competition/<competition>/class/<class>')
	->defaults(array(
		'controller' => 'competition_class',
		'action'     => 'details'
	));

Route::set('matches', 'competition/<competition>/round/<round>/matches')
	->defaults(array(
		'controller' => 'competition_round_match',
		'action'     => 'list'
	));

Route::set('competitors', 'competition/<competition>/round/<round>/competitors')
	->defaults(array(
		'controller' => 'competition_round_competitor',
		'action'     => 'list'
	));

Route::set('competitor', 'competition/<competition>/round/<round>/competitor/<competitor>')
	->defaults(array(
		'controller' => 'competition_round_competitor',
		'action'     => 'details'
	));

Route::set('times', 'competition/<competition>/round/<round>/times')
	->defaults(array(
		'controller' => 'competition_round_time',
		'action'     => 'list'
	));

Route::set('time', 'competition/<competition>/round/<round>/time/<time>')
	->defaults(array(
		'controller' => 'competition_round_time',
		'action'     => 'details'
	));

Route::set('rounds', 'competition/<competition>/round/<round>(/<action>)')
	->defaults(array(
		'controller' => 'competition_round',
		'action'     => 'details'
	));

Route::set('competitor', 'competition/<competition>/round/<round>/competitor/<competitor>(/<action>)')
	->defaults(array(
		'controller' => 'competition_round_competitor',
		'action'     => 'details'
	));

Route::set('default', '(<controller>(/<id>(/<action>)))')
	->defaults(array(
		'controller' => 'dashboard',
		'action'     => 'index',
	));
