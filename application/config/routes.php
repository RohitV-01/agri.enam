<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Enam_ctrl';
$route['404_override'] = 'Url_ctrl/index';
$route['translate_uri_dashes'] = FALSE;

$route['elearning-videos/(:any)'] = 'Elearning_ctrl/index/$1';
$route['elearning/id/(:num)'] = 'Elearning_ctrl/video_detail/$1';
$route['nam/(:any)'] = 'Enam_ctrl/$1';
$route['layout_page/(:any)'] = 'Enam_ctrl/$1';

$route['enam-registration'] = 'Enam_ctrl/enam_registration';
$route['all_news_desc'] = 'Enam_ctrl/all_news_desc';

//$route['events'] = 'Enam_ctrl/event_landing_page';
$route['events/(:any)'] = 'Event_ctrl/index/$1';

$route['emandi'] = 'Dashboard_ctrl/emandi';
$route['emandi/(:any)'] = 'Dashboard_ctrl/emandi/index/$1';
$route['emandi/(:any)/(:any)'] = 'Dashboard_ctrl/emandi/index/$1/$2';
$route['apmc'] = 'Dashboard_ctrl/apmc';
$route['dashboard/trade-data'] = 'Dashboard_ctrl/min_max_modal_prices';
$route['dashboard/trade-data/(:any)/(:any)'] = 'Dashboard_ctrl/min_max_modal_prices/$1/$2';
$route['dashboard/stakeholder-data'] = 'Enam_ctrl/stakeholderdata';

$route['stakeholders-data'] = 'Dashboard_ctrl/stakeholders_data';
$route['success-stories1'] = 'Stories_ctrl/index';
$route['apmc-contact-details'] = 'Enam_ctrl/mandi_contact';
$route['trading-details'] = 'Enam_ctrl/mandi_trading';
$route['mandis-online'] = 'Mandi_ctrl/online_mandi';


$route['training-calender'] = 'Training_ctrl/index';
$route['site_search'] = 'Site_search_ctrl/index';

$route['contact-us'] = 'Email_ctrl/contact_us';
//new page for darpan
$route['datapage'] = 'Enam_ctrl/datapage';

//Agmarknet Price Dashboard
$route['dashboard/agmarknet'] = 'Dashboard_ctrl/agmarknet';
$route['dashboard/agmarknet/(:any)/(:any)'] = 'Dashboard_ctrl/agmarknet/$1/$2';
//rems price dashboard
$route['dashboard/rems'] = 'Dashboard_ctrl/rems';
$route['dashboard/rems/(:any)/(:any)'] = 'Dashboard_ctrl/rems/$1/$2';

//Feedback Training
$route['training_feedback/stakeholder'] = 'Feedback_ctrl/stackholder';
$route['training_feedback/mandistaff'] = 'Feedback_ctrl/mandistaff';

//FPO
$route['fpo'] = 'Fpo_ctrl/fpo';

//FPO
$route['co_operation'] = 'Co_operation_ctrl/co_operation';

//Live Price Dashboard
$route['dashboard/live_price'] = 'Dashboard_ctrl/liveprice';
$route['dashboard/live_price/(:any)/(:any)'] = 'Dashboard_ctrl/liveprice/$1/$2';

//Weather Broadcast
$route['weather_forecast'] = 'Enam_ctrl/weather_forecast';

////////////////////admin/////////

$route['admin/admin'] = 'admin/Auth/index';
$route['admin/admin/menus'] = 'admin/Menu_ctrl';
$route['admin/admin/menus/(:any)'] = 'admin/Menu_ctrl/index/$1';
$route['admin/admin/dashboard'] = 'admin/Admin_ctrl/dashboard';
$route['admin/admin/language'] = 'admin/Language_ctrl/index';
$route['admin/admin/video']='admin/Video_ctrl/video_cat';
$route['admin/admin/videos']='admin/Video_ctrl/index';
$route['admin/admin/users'] = 'admin/Users_ctrl/index';
$route['admin/admin/widgets'] = 'admin/Widget_ctrl/index';
$route['admin/admin/news'] = 'admin/News_ctrl/index';
$route['admin/admin/links'] = 'admin/Links_ctrl/index';
$route['admin/admin/events'] = 'admin/Event_ctrl/index';
$route['admin/admin/slider'] = 'admin/Slider_ctrl/index';
$route['admin/admin/commodity'] = 'admin/Commodity_ctrl/index';
$route['admin/admin/success_story'] = 'admin/Story_ctrl/index';
$route['admin/admin/Static_pages'] = 'admin/Static_ctrl/index';
$route['admin/admin/add_page'] = 'admin/Page_ctrl/index';
$route['admin/admin/add_page/(:num)'] = 'admin/Page_ctrl/index/$1';
$route['admin/admin/all_pages'] = 'admin/Page_ctrl/all_pages';
$route['admin/admin/heading'] = 'admin/Heading_ctrl/index';
$route['admin/admin/cache_mgnt'] = 'admin/Cache_ctrl/index';
$route['admin/admin/lang_file'] = 'admin/Lang_ctrl/index';
$route['admin/admin/notification'] = 'admin/Notification_ctrl/admin_notification';
$route['admin/admin/user_profile_update'] = 'admin/user_profile/profile';
$route['admin/admin/profile_update'] = 'admin/user_profile/profile';
$route['admin/admin/change_password'] = 'admin/user_profile/change_password';
$route['admin/admin/training'] = 'admin/Training_ctrl/index';
$route['admin/admin/commodity_category'] = 'admin/Commodity_ctrl/category';
$route['admin/admin/commodity-add'] = 'admin/Commodity_ctrl/commodity_list';
$route['admin/admin/trade_data'] = 'admin/Admin_ctrl/trade_data';

$route['admin/admin/(:any)'] = 'admin/Admin_ctrl/$1';


$route['admin/admin/edit_page'] = 'admin/Admin_ctrl/$1';
$route['admin/admin/home_page'] = 'admin/Admin_ctrl/$1';
$route['login'] = 'Enam_ctrl/login_redirect';
$route['registration'] = 'Enam_ctrl/registration_redirect';
