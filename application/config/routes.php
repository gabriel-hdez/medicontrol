<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'inicio';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// rutas 

$route['archivos/asignaturas'] 				= 'archivos_ce/asignaturas';
$route['archivos/asignaturas/nuevo'] 			= 'archivos_ce/asignaturas/nuevo';
$route['archivos/asignaturas/editar/(:num)'] 	= 'archivos_ce/asignaturas/editar/$1';
$route['archivos/asignaturas/estado/(:num)'] 	= 'archivos_ce/asignaturas/estado/$1';

$route['archivos/ubicaciones'] 					= 'archivos_ce/ubicaciones';
$route['archivos/ubicaciones/nuevo'] 			= 'archivos_ce/ubicaciones/nuevo';
$route['archivos/ubicaciones/editar/(:num)'] 	= 'archivos_ce/ubicaciones/editar/$1';
$route['archivos/ubicaciones/estado/(:num)'] 	= 'archivos_ce/ubicaciones/estado/$1';

$route['archivos/edificios'] 				= 'archivos_ce/edificios';
$route['archivos/edificios/nuevo'] 			= 'archivos_ce/edificios/nuevo';
$route['archivos/edificios/editar/(:num)'] 	= 'archivos_ce/edificios/editar/$1';
$route['archivos/edificios/estado/(:num)'] 	= 'archivos_ce/edificios/estado/$1';

$route['archivos/aulas'] 				= 'archivos_ce/aulas';
$route['archivos/aulas/nuevo'] 			= 'archivos_ce/aulas/nuevo';
$route['archivos/aulas/editar/(:num)'] 	= 'archivos_ce/aulas/editar/$1';
$route['archivos/aulas/estado/(:num)'] 	= 'archivos_ce/aulas/estado/$1';

$route['archivos/secciones'] 				= 'archivos_ce/secciones';
$route['archivos/secciones/nuevo'] 			= 'archivos_ce/secciones/nuevo';
$route['archivos/secciones/editar/(:num)'] 	= 'archivos_ce/secciones/editar/$1';
$route['archivos/secciones/estado/(:num)'] 	= 'archivos_ce/secciones/estado/$1';

$route['archivos/periodos'] 				= 'archivos_ce/periodos';
$route['archivos/periodos/nuevo'] 			= 'archivos_ce/periodos/nuevo';
$route['archivos/periodos/editar/(:num)'] 	= 'archivos_ce/periodos/editar/$1';
$route['archivos/periodos/estado/(:num)'] 	= 'archivos_ce/periodos/estado/$1';
