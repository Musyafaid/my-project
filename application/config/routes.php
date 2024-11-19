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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'C_home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'C_dashboard';
$route['dashboard/product'] = 'C_dashboard/product';
$route['dashboard/product/(:num)/(:num)'] = 'C_dashboard/product_status/$1/$2';
$route['dashboard/product/update'] = 'C_dashboard/update_product/';
$route['dashboard/product/(:num)'] = 'C_dashboard/product/$1';
$route['home/(:num)'] = 'C_home/index/$1';
$route['home'] = 'C_home/index';
$route['home/product'] = 'C_product/search';
$route['home/product/detail'] = 'C_home/detail_product';


$route['seller/register'] = 'C_auth_seller/seller_register';
$route['seller/login'] = 'C_auth_seller/login';
$route['dashboard/logout'] = 'C_dashboard/logout';

$route['checkout/carts'] = 'C_checkout/carts';
$route['checkout/carts/update'] = 'C_checkout/update_carts';
$route['checkout/remove'] = 'C_checkout/remove_carts';
$route['checkout/buy'] = 'C_checkout/buy';
$route['checkout/success'] = 'C_checkout/success';
$route['checkout/address'] = 'C_checkout/shipping_address';


$route['user/register'] = 'C_auth_user/user_register';
$route['user/login'] = 'C_auth_user/login';