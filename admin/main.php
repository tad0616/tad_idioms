<?php
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_idioms_adm_main.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------function區--------------*/
//tad_idioms編輯表單
function tad_idioms_form($sn = '')
{
    global $xoopsDB, $xoopsUser, $xoopsTpl;

    //抓取預設值
    if (!empty($sn)) {
        $DBV = get_tad_idioms($sn);
    } else {
        $DBV = [];
    }

    //預設值設定

    //設定「sn」欄位預設值
    $sn = (!isset($DBV['sn'])) ? $sn : $DBV['sn'];

    //設定「title」欄位預設值
    $title = (!isset($DBV['title'])) ? '' : $DBV['title'];

    //設定「juin」欄位預設值
    $juin = (!isset($DBV['juin'])) ? '' : $DBV['juin'];

    //設定「mean」欄位預設值
    $mean = (!isset($DBV['mean'])) ? '' : $DBV['mean'];

    //設定「show_times」欄位預設值
    $show_times = (!isset($DBV['show_times'])) ? null : $DBV['show_times'];

    //設定「search_times」欄位預設值
    $search_times = (!isset($DBV['search_times'])) ? null : $DBV['search_times'];

    //設定「cate」欄位預設值
    $cate = (!isset($DBV['cate'])) ? '' : $DBV['cate'];

    $op = (empty($sn)) ? 'insert_tad_idioms' : 'update_tad_idioms';
    //$op="replace_tad_idioms";

    $FormValidator = new FormValidator("#myForm", true);
    $FormValidator->render();

    $xoopsTpl->assign('op', 'tad_idioms_form');
    $xoopsTpl->assign('next_op', $op);
    $xoopsTpl->assign('mean', $mean);
    $xoopsTpl->assign('juin', $juin);
    $xoopsTpl->assign('title', $title);
    $xoopsTpl->assign('sn', $sn);
}

//新增tad_idioms計數器
function add_tad_idioms_counter($sn = '')
{
    global $xoopsDB, $xoopsModule;
    $sql = 'update ' . $xoopsDB->prefix('tad_idioms') . " set `search_times`=`search_times`+1 where `sn`='{$sn}'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

//新增資料到tad_idioms中
function insert_tad_idioms()
{
    global $xoopsDB, $xoopsUser;

    $myts = \MyTextSanitizer::getInstance();
    $_POST['title'] = $myts->addSlashes($_POST['title']);
    $_POST['juin'] = $myts->addSlashes($_POST['juin']);
    $_POST['mean'] = $myts->addSlashes($_POST['mean']);

    $sql = 'insert into ' . $xoopsDB->prefix('tad_idioms') . "
    (`title` , `juin` , `mean` , `show_times` , `search_times` , `cate`)
    values('{$_POST['title']}' , '{$_POST['juin']}' , '{$_POST['mean']}' , 0 , 0 , '{$_POST['cate']}')";
    $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $sn = $xoopsDB->getInsertId();

    return $sn;
}

//更新tad_idioms某一筆資料
function update_tad_idioms($sn = '')
{
    global $xoopsDB, $xoopsUser;

    $myts = \MyTextSanitizer::getInstance();
    $_POST['title'] = $myts->addSlashes($_POST['title']);
    $_POST['juin'] = $myts->addSlashes($_POST['juin']);
    $_POST['mean'] = $myts->addSlashes($_POST['mean']);

    $sql = 'update ' . $xoopsDB->prefix('tad_idioms') . " set
     `title` = '{$_POST['title']}' ,
     `juin` = '{$_POST['juin']}' ,
     `mean` = '{$_POST['mean']}' ,
     `cate` = '{$_POST['cate']}'
    where sn='$sn'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    return $sn;
}

//列出所有tad_idioms資料
function list_tad_idioms($show_function = 1)
{
    global $xoopsDB, $xoopsModule, $xoopsTpl;

    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('tad_idioms') . '';

    //Utility::getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 20, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $all_content = [];
    $i = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //以下會產生這些變數： $sn , $title , $juin , $mean , $show_times , $search_times , $cate
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $all_content[$i]['sn'] = $sn;
        $all_content[$i]['title'] = $title;
        $all_content[$i]['juin'] = $juin;
        $all_content[$i]['show_times'] = $show_times;
        $all_content[$i]['search_times'] = $search_times;
        $all_content[$i]['cate'] = $cate;
        ++$i;
    }

    $xoopsTpl->assign('all_content', $all_content);
    $xoopsTpl->assign('bar', $bar);
}

//以流水號取得某筆tad_idioms資料
function get_tad_idioms($sn = '')
{
    global $xoopsDB;
    if (empty($sn)) {
        return;
    }
    $sql = 'select * from ' . $xoopsDB->prefix('tad_idioms') . " where sn='$sn'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//刪除tad_idioms某筆資料資料
function delete_tad_idioms($sn = '')
{
    global $xoopsDB;
    $sql = 'delete from ' . $xoopsDB->prefix('tad_idioms') . " where sn='$sn'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', 0, 'int');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    //新增資料
    case 'insert_tad_idioms':
        $sn = insert_tad_idioms();
        header("location: {$_SERVER['PHP_SELF']}?sn=$sn");
        break;
    //更新資料
    case 'update_tad_idioms':
        update_tad_idioms($sn);
        header("location: {$_SERVER['PHP_SELF']}");
        break;
    //輸入表格
    case 'tad_idioms_form':
        tad_idioms_form($sn);
        break;
    //刪除資料
    case 'delete_tad_idioms':
        delete_tad_idioms($sn);
        header("location: {$_SERVER['PHP_SELF']}");
        break;
    //預設動作
    default:
        list_tad_idioms();
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
require_once __DIR__ . '/footer.php';
