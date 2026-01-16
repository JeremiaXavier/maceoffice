<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;




/***************   Admin panel routes   **********************/



//Ck Editor Image Upload
$route['upload'] = "admin/CkEditor/upload";

/************
 * 
 * 
 * Authentication
 * 
 * *********/
$route['admin/auth'] = 'auth/admin/login';
$route['admin/login'] = 'auth/admin/login';

$route['users/auth'] = 'auth/users/login';
$route['users/login'] = 'auth/users/login';


$route['register'] = 'auth/register';
$route['auth/forgot_password'] = 'auth/login/forgot_password';
$route['auth/forgot_password_post'] = 'auth/login/forgot_password_post';
$route['auth/change_password_post'] = 'auth/login/change_password_post';

$route['save_registration'] = 'auth/register/register_user';

$route['admin/save_login'] = 'auth/admin/login/login';
$route['users/save_login'] = 'auth/users/login/login';

$route['validate_registration'] = 'auth/register/validate_register_form';
$route['change_captcha'] = 'auth/login/refresh_captcha';
$route['change_captcha2'] = 'auth/register/refresh_captcha';


$route['keyboard_shortcuts'] = 'admin/keyboard/keyboard_shortcuts';

$route['admin/logout'] = 'auth/admin/login/logout';
$route['users/logout'] = 'auth/users/login/logout';



$route['adminhome'] = 'admin/home';
$route['usershome'] = 'users/home';


$route['admin/profile'] = 'admin/profile';
$route['admin/login_history'] = 'admin/profile/login_history';
$route['admin/list_logs'] = 'admin/profile/list_logs';
$route['admin/list_logs_json'] = 'admin/profile/list_logs_json';

$route['users/profile'] = 'users/profile';
$route['users/login_history'] = 'users/profile/login_history';
$route['users/list_logs'] = 'users/profile/list_logs';
$route['users/list_logs_json'] = 'users/profile/list_logs_json';

$route['list_failed_logs'] = 'admin/profile/list_failed_logs';
$route['list_failed_logs_json'] = 'admin/profile/list_failed_logs_json';



$route['profile_image_store']['post'] = 'admin/profile/update_profile_image';

$route['admin/update_profile'] = 'admin/profile/update_profile';
$route['admin/change_password'] = 'admin/profile/change_password';

$route['users/update_profile'] = 'users/profile/update_profile';
$route['users/change_password'] = 'users/profile/change_password';

$route['permissions'] = 'admin/permissions';
$route['permission_json'] = 'admin/permissions/permission_json';
$route['list_permissions/(:any)'] = 'admin/permissions/list_permissions/$1';
$route['change_module_permission'] = 'admin/permissions/change_module_permission';
$route['change_module_permission_usertype'] = 'admin/permissions/change_module_permission_usertype';
$route['website'] = 'admin/website';


$route['feedbacks'] = 'admin/feedbacks';
$route['add_backlog'] = 'admin/feedbacks/add_backlog';
$route['list_backlogs'] = 'admin/feedbacks/list_backlogs';
$route['change_feedback_status'] = 'admin/feedbacks/change_feedback_status';

$route['export'] = 'admin/export';

//$route['user'] = 'home/home/user_home/2';









/***************   Home page routes   **********************/

$route['visits'] = 'apis/visits';


$route['construction'] = 'home/construction';




//Loop through all the services from table
$route['sportive'] = 'home/services/1';
$route['corposure'] = 'home/services/2';
$route['aesthetic_atelier'] = 'home/services/3';
$route['aesthetic_dentistry'] = 'home/services/4';
$route['jeevanthika'] = 'home/services/5';
$route['high_performance'] = 'home/services/6';



$route['sanjeevini_membership'] = 'home/membership/1';
$route['membership_details/(:any)'] = 'home/membership_details/$1';



$route['gallery_categories'] = 'home/gallery_categories';
$route['image_gallery/(:any)'] = 'home/image_gallery/$1';


$route['contact_us'] = 'home/contact_us';
$route['expertise'] = 'home/expertise';
$route['blogs'] = 'home/blogs';
$route['about_us'] = 'home/about_us';
$route['testimonials'] = 'home/testimonials';
$route['testimonials_details'] = 'home/testimonials_details';
$route['blogs_details/(:any)'] = 'home/blogs_details/$1';
$route['blogs_details'] = 'home/blogs_details';

$route['news_details/(:any)'] = 'home/news_details/$1';
$route['services_details/(:any)'] = 'home/services_details/$1';

$route['news'] = 'home/news';


$route['save_contact_us'] = 'home/save_contact_us';



$route['blogs_pagination/(:any)'] = 'pagination/blogs_pagination/$1';
$route['news_pagination/(:any)'] = 'pagination/news_pagination/$1';
$route['testimonial_pagination/(:any)'] = 'pagination/testimonial_pagination/$1';
$route['image_gallery_pagination/(:any)/(:any)'] = 'pagination/image_gallery_pagination/$1/$2';
$route['video_gallery_pagination/(:any)/(:any)'] = 'pagination/video_gallery_pagination/$1/$2';
