<?php
use Xmf\Request;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_idioms_admin.tpl';
require_once __DIR__ . '/header.php';

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$sn = Request::getInt('sn');

switch ($op) {

    //新增資料
    case 'insert_tad_idioms':
        $sn = insert_tad_idioms();
        header("location: {$_SERVER['PHP_SELF']}?sn=$sn");
        exit;

    //更新資料
    case 'update_tad_idioms':
        update_tad_idioms($sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //輸入表格
    case 'tad_idioms_form':
        tad_idioms_form($sn);
        break;

    //刪除資料
    case 'delete_tad_idioms':
        delete_tad_idioms($sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //預設動作
    default:
        list_tad_idioms();
        $op = 'list_tad_idioms';
        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('now_op', $op);
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/
//tad_idioms編輯表單
function tad_idioms_form($sn = '')
{
    global $xoopsTpl;

    $DBV = !empty($sn) ? get_tad_idioms($sn) : [];

    //預設值設定

    //設定「sn」欄位預設值
    $sn = (!isset($DBV['sn'])) ? $sn : $DBV['sn'];

    //設定「title」欄位預設值
    $title = (!isset($DBV['title'])) ? '' : $DBV['title'];

    //設定「juin」欄位預設值
    $juin = (!isset($DBV['juin'])) ? '' : $DBV['juin'];

    //設定「mean」欄位預設值
    $mean = (!isset($DBV['mean'])) ? '' : $DBV['mean'];

    $op = (empty($sn)) ? 'insert_tad_idioms' : 'update_tad_idioms';

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
    global $xoopsDB;
    $sql = 'UPDATE ' . $xoopsDB->prefix('tad_idioms') . '
    SET `search_times` = `search_times` + 1
    WHERE `sn` = ?';
    Utility::query($sql, 'i', [$sn]) or Utility::web_error($sql, __FILE__, __LINE__);

}

//新增資料到tad_idioms中
function insert_tad_idioms()
{
    global $xoopsDB;

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_idioms') . '`
    (`title`, `juin`, `mean`, `show_times`, `search_times`, `cate`)
    VALUES (?, ?, ?, 0, 0, ?)';
    Utility::query($sql, 'ssss', [$_POST['title'], $_POST['juin'], $_POST['mean'], $_POST['cate']]) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $sn = $xoopsDB->getInsertId();

    return $sn;
}

//更新tad_idioms某一筆資料
function update_tad_idioms($sn = '')
{
    global $xoopsDB;

    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_idioms') . '` SET
    `title` = ?,
    `juin` = ?,
    `mean` = ?,
    `cate` = ?
    WHERE `sn` = ?';
    Utility::query($sql, 'ssssi', [$_POST['title'], $_POST['juin'], $_POST['mean'], $_POST['cate'], $sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    return $sn;
}

//列出所有tad_idioms資料
function list_tad_idioms()
{
    global $xoopsDB, $xoopsTpl;

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

    $SweetAlert = new SweetAlert();
    $SweetAlert->render("delete_tad_idioms_func", "main.php?op=delete_tad_idioms&sn=", 'sn');
}

//以流水號取得某筆tad_idioms資料
function get_tad_idioms($sn = '')
{
    global $xoopsDB;
    if (empty($sn)) {
        return;
    }
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_idioms') . '` WHERE `sn`=?';
    $result = Utility::query($sql, 'i', [$sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//刪除tad_idioms某筆資料資料
function delete_tad_idioms($sn = '')
{
    global $xoopsDB;
    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_idioms') . '` WHERE `sn` =?';
    Utility::query($sql, 'i', [$sn]) or Utility::web_error($sql, __FILE__, __LINE__);

}
