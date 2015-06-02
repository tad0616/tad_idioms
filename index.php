<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2012-06-02
// $Id:$
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = "tad_idioms_index_tpl.html";
include_once XOOPS_ROOT_PATH . "/header.php";
/*-----------function區--------------*/

//列出所有tad_idioms資料
function list_tad_idioms($show_sn = "") {
    global $xoopsDB, $xoopsModule, $xoopsTpl;

    $andkeyword = "";
    if (isset($_POST['keyword'])) {
        $myts       = MyTextSanitizer::getInstance();
        $keyword    = $myts->addSlashes($_POST['keyword']);
        $andkeyword = " where `title` like '%{$keyword}%' or `mean` like '%{$keyword}%'";
    }

    $sql = "select * from " . $xoopsDB->prefix("tad_idioms") . " $andkeyword";

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = getPageBar($sql, 20, 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());

    $all_content = "";
    $i           = 0;

    while ($all = $xoopsDB->fetchArray($result)) {
        //以下會產生這些變數： $sn , $title , $juin , $mean , $show_times , $search_times , $cate
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $ji    = explode(" ", $juin);
        $main  = "";
        $sound = array(_MD_TADIDIOMS_2, _MD_TADIDIOMS_3, _MD_TADIDIOMS_4, _MD_TADIDIOMS_5);
        foreach ($ji as $n => $juin) {
            $sud = substr($juin, -2);
            if (in_array($sud, $sound)) {
                $juin = substr($juin, 0, -2);
                $lh   = strlen($juin) > 6 ? 80 : 120;
            } else {
                $sud = "&nbsp;&nbsp;";
                $lh  = strlen($juin) > 6 ? 80 : 120;
            }
            $m   = $n * 3;
            $txt = substr($title, $m, 3);
            $main .= "
      <td style='font-size:2em;font-family:" . _MD_TADIDIOMS_FONT . ";'>$txt</td>
      <td style='font-size:11px;font-family:" . _MD_TADIDIOMS_FONT . ";width:12px;line-height:{$lh}%;'>$juin</td>
      <td style='font-size:11px;font-family:" . _MD_TADIDIOMS_FONT . ";width:12px'>$sud</td>
      ";
        }

        $newsn = sprintf('%1$03d', $sn);

        $all_content[$i]['current'] = $sn == $show_sn ? 1 : 0;
        $all_content[$i]['name']    = $sn;
        $all_content[$i]['sn']      = $newsn;
        $all_content[$i]['main']    = $main;
        $all_content[$i]['mean']    = $mean;
        $all_content[$i]['title']   = $title;
        ++$i;
    }

    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('all_content', $all_content);
}

/*-----------執行動作判斷區----------*/
$op      = empty($_REQUEST['op']) ? "" : $_REQUEST['op'];
$sn      = empty($_REQUEST['sn']) ? "" : (int)($_REQUEST['sn']);
$show_sn = empty($_REQUEST['show_sn']) ? "" : (int)($_REQUEST['show_sn']);

$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
$xoopsTpl->assign("bootstrap", get_bootstrap());
$xoopsTpl->assign("jquery", get_jquery(true));
$xoopsTpl->assign("isAdmin", $isAdmin);

switch ($op) {
    //預設動作
    default:
        list_tad_idioms($show_sn);
        break;
}

/*-----------秀出結果區--------------*/
include_once XOOPS_ROOT_PATH . '/footer.php';
