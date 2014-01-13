<?php
$modversion = array();

//---模組基本資訊---//
$modversion['name'] = _MI_TADIDIOMS_NAME;
$modversion['version'] = 1.1;
$modversion['description'] = _MI_TADIDIOMS_DESC;
$modversion['author'] = _MI_TADIDIOMS_AUTHOR;
$modversion['credits'] = _MI_TADIDIOMS_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = "images/logo_{$xoopsConfig['language']}.png";
$modversion['dirname'] = basename(dirname(__FILE__));

//---模組狀態資訊---//
$modversion['release_date'] = '2014/01/10';
$modversion['module_website_url'] = 'http://tad0616.net/';
$modversion['module_website_name'] = _MI_TAD_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'http://tad0616.net/';
$modversion['author_website_name'] = _MI_TAD_WEB;
$modversion['min_php']=5.2;
$modversion['min_xoops']='2.5';

//---paypal資訊---//
$modversion ['paypal'] = array();
$modversion ['paypal']['business'] = 'tad0616@gmail.com';
$modversion ['paypal']['item_name'] = 'Donation : ' . _MI_TAD_WEB;
$modversion ['paypal']['amount'] = 0;
$modversion ['paypal']['currency_code'] = 'USD';



//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;//---資料表架構---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][1] = "tad_idioms";

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

//---使用者主選單設定---//
$modversion['hasMain'] = 1;
$modversion['sub'][2]['name'] =_MI_TADIDIOMS_SMNAME2;
$modversion['sub'][2]['url'] = "view.php";

//---安裝設定---//
$modversion['onInstall'] = "include/onInstall.php";
$modversion['onUpdate'] = "include/onUpdate.php";
$modversion['onUninstall'] = "include/onUninstall.php";


//---樣板設定---//
$modversion['templates'] = array();
$i=1;
$modversion['templates'][$i]['file'] = 'tad_idioms_index_tpl.html';
$modversion['templates'][$i]['description'] = 'tad_idioms_index_tpl.html';
$i++;
$modversion['templates'][$i]['file'] = 'tad_idioms_adm_main.html';
$modversion['templates'][$i]['description'] = 'tad_idioms_adm_main.html';


//---區塊設定---//
$modversion['blocks'][1]['file'] = "tad_idioms_show.php";
$modversion['blocks'][1]['name'] = _MI_TADIDIOMS_BNAME1;
$modversion['blocks'][1]['description'] = _MI_TADIDIOMS_BDESC1;
$modversion['blocks'][1]['show_func'] = "tad_idioms_show";
$modversion['blocks'][1]['template'] = "tad_idioms_show.html";
$modversion['blocks'][1]['edit_func'] = "tad_idioms_show_edit";
$modversion['blocks'][1]['options'] = "1|1|1|1|random";

?>