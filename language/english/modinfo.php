<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2012-06-02
// $Id:$
// ------------------------------------------------------------------------- //
include_once XOOPS_ROOT_PATH . "/modules/tadtools/language/{$xoopsConfig['language']}/modinfo_common.php";

define('_MI_TADIDIOMS_NAME', 'Tad Learn Idioms');
define('_MI_TADIDIOMS_AUTHOR', 'Tad');
define('_MI_TADIDIOMS_CREDITS', 'Tad');
define('_MI_TADIDIOMS_DESC', 'Idiom learning module');
define('_MI_TADIDIOMS_ADMENU1', 'Idiom management');
define('_MI_TADIDIOMS_SMNAME2', 'Idiom interpretation');
define('_MI_TADIDIOMS_BNAME1', 'Phrase back at any time');
define('_MI_TADIDIOMS_BDESC1', 'Phrase back at any time (tad_idioms_show)');

define('_MI_TADIDIOMS_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TADIDIOMS_HELP_HEADER', __DIR__ . '/help/helpheader.html');
define('_MI_TADIDIOMS_BACK_2_ADMIN', 'Back to Administration of ');

//help
define('_MI_TADIDIOMS_HELP_OVERVIEW', 'Overview');
