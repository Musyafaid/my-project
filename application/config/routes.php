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
$route['dashboard/logout'] = 'C_dashboard/logout/';

$route['dashboard/product'] = 'C_dashboard/product';
$route['dashboard/confirmation/(:any)'] = 'C_dashboard/confirmation/$1';
$route['dashboard/confirmation'] = 'C_dashboard/confirmation/';
$route['dashboard/product/(:num)/(:num)'] = 'C_dashboard/product_status/$1/$2';
$route['dashboard/product/update'] = 'C_dashboard/update_product/';
$route['dashboard/product/(:num)'] = 'C_dashboard/product/$1';
$route['seller/mail'] = 'C_auth_seller/send';
$route['dashboard/order/(:any)'] = 'C_dashboard/order_detail/$1';
$route['dashboard/order'] = 'C_dashboard/order_table';
$route['home/(:num)'] = 'C_home/index/$1';
$route['home'] = 'C_home/index';
$route['home/product'] = 'C_product/search';
$route['home/product/detail'] = 'C_home/detail_product';
$route['dashboard/data_sallary'] = 'C_dashboard/data_sallary_recap';





$route['seller/register'] = 'C_auth_seller/seller_register';
$route['seller/login'] = 'C_auth_seller/login';

$route['checkout'] = 'C_checkout/index';
$route['checkout/update'] = 'C_checkout/update_carts';
$route['checkout/remove'] = 'C_checkout/remove_carts';
$route['checkout/buy'] = 'C_checkout/buy';
$route['checkout/success'] = 'C_checkout/success';
$route['checkout/address'] = 'C_checkout/shipping_address';
$route['checkout/history'] = 'C_checkout/history';


$route['user/register'] = 'C_auth_user/user_register';
$route['user/login'] = 'C_auth_user/login';
$route['user/logout'] = 'C_home/logout';

$route['admin/register'] = 'C_auth_admin/register';
$route['admin/login'] = 'C_auth_admin/login';
$route['admin/logout'] = 'C_admin_dashboard/logout';
$route['admin/dashboard'] = 'C_admin_dashboard/index';
$route['admin/dashboard/category'] = 'C_admin_dashboard/category';
$route['admin/dashboard/category/(:num)'] = 'C_admin_dashboard/category';
$route['admin/dashboard/category?search=(:any)'] = 'C_admin_dashboard/category';
$route['admin/dashboard/category/add'] = 'C_admin_dashboard/add';
$route['admin/dashboard/category/edit/(:num)'] = 'C_admin_dashboard/edit/$1';
$route['admin/dashboard/category/delete/(:num)'] = 'C_admin_dashboard/delete/$1';

$route['admin/dashboard/sub_category'] = 'C_admin_dashboard/sub_category';
// $route['admin/dashboard/sub_category/(:num)'] = 'C_admin_dashboard/sub_category';
$route['admin/dashboard/sub_category?search=(:any)'] = 'C_admin_dashboard/sub_category';
$route['admin/dashboard/sub_category/add'] = 'C_admin_dashboard/add_sub_category';
$route['admin/dashboard/sub_category/delete/(:num)'] = 'C_admin_dashboard/delete_sub_category/$1';
$route['admin/dashboard/sub_category/edit/(:num)'] = 'C_admin_dashboard/edit_sub_category/$1';
