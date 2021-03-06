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
$route['default_controller'] = 'trangchu';
$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;
$route['dangnhap'] = 'trangchu/login';
$route['dangky'] = 'trangchu/dangky';
$route['dang-ky'] = 'trangchu/register';
$route['thoat'] = 'trangchu/thoat';
$route['thongtin'] = 'dashboard';
$route['viplike'] = 'viplike';
$route['addviplike'] = 'viplike/addviplike';
$route['getuidfb'] = 'viplike/checkid';
$route['getmoney'] = 'viplike/changemoneylike';
$route['addviplikes1'] = 'viplike/addlikedb';
$route['danhsachlikes1'] = 'viplike/listvip';
$route['xoaviplike/(:num)'] = 'viplike/delviplike/$1';
$route['updatelike/(:num)'] = 'viplike/update/$1';

$route['addcmt'] = 'comment/addcmt';
$route['giamgia'] = 'comment/changemoneylike';
$route['addcmtsv'] = 'comment/addcmntdb';
$route['listcmt'] = 'comment/listcmt';
$route['xoacmt/(:num)'] = 'comment/delcmt/$1';
$route['updatecmt/(:num)'] = 'comment/update/$1';


$route['hethan'] = 'exp';
$route['addtoken'] = 'token';
$route['addtokensv'] = 'token/addtoken';
$route['deltoken'] = 'token/deltoken';
$route['deltokensv'] = 'token/deltokendb';
$route['gettokendb'] = 'token/gettokendb';
$route['testtoken'] = 'token/testtoken';
$route['xoatoken'] = 'token/xoatokendie'; //';
$route['napthe'] = 'trangchu/napthe';
$route['banggia'] = 'trangchu/banggia';

$route['themdaily'] = 'daily';
$route['listdaily'] = 'daily/danhsachdaily';
$route['kichhoat/(:num)'] = 'daily/kichhoat/$1';
$route['khoa/(:num)'] = 'daily/khoaacc/$1';
$route['mokhoa/(:num)'] = 'daily/mokhoa/$1';
$route['xoadaily/(:num)'] = 'daily/xoadaily/$1';
$route['capnhatdaily/(:num)'] = 'daily/capnhat/$1';
$route['capnhat-daily/(:num)'] = 'daily/update/$1';

$route['themctv'] = 'ctv';
$route['listctv'] = 'ctv/danhsachctv';
$route['kichhoatctv/(:num)'] = 'ctv/kichhoat/$1';
$route['khoactv/(:num)'] = 'ctv/khoaacc/$1';
$route['mokhoactv/(:num)'] = 'ctv/mokhoa/$1';
$route['xoactv/(:num)'] = 'ctv/xoactv/$1';
$route['capnhatctv/(:num)'] = 'ctv/capnhat/$1';
$route['capnhat-ctv/(:num)'] = 'ctv/update/$1';

$route['taogiftcode'] = 'giftcode';
$route['listgiftcode'] = 'giftcode/listcode';
$route['giftcode'] = 'giftcode/sudunggiftcode';

$route['history'] = 'history';
$route['member'] = 'member';
$route['actmem/(:num)'] = 'member/kichhoat/$1';
$route['lockmem/(:num)'] = 'member/khoaacc/$1';
$route['unlockmem/(:num)'] = 'member/mokhoa/$1';
$route['delmem/(:num)'] = 'member/xoamem/$1';

$route['congtien'] = 'giaodich';
$route['capnhattien'] = 'giaodich/capnhattien';
$route['chuyentien'] = 'giaodich/chuyentien';

$route['listthongbao'] = 'thongbao';
$route['xoathongbao/(:num)'] = 'thongbao/xoathongbao/$1';

$route['updateinfo'] = 'thongtin';
$route['update-info'] = 'thongtin/updateinfo';
$route['changepass'] = 'thongtin/changepass';
$route['changepassok'] = 'thongtin/updatepass';

$route['auto/like'] = 'Cron/viplike';
$route['auto/cmt'] = 'Cron/vipcmt';
$route['auto/botcamxuc'] = 'Cron/botcamxuc';

$route['topdoanhthu'] = 'giaodich/top10money';

$route['listpakagelike'] = 'pakage';
$route['listpakagecmt'] = 'pakage/listcmt';
$route['listpakageshare'] = 'pakage/listshare';

$route['adreaction'] = 'reaction';
$route['adreactiondb'] = 'reaction/addreaction';
$route['getmoneyre'] = 'reaction/changemoneylike';
$route['checktoken'] = 'reaction/check';
$route['listreaction'] = 'reaction/listreaction';
$route['updatereaction/(:num)'] = 'reaction/update/$1';