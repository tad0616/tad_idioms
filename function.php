<?php

use XoopsModules\Tadtools\Utility;
xoops_loadLanguage('main', 'tadtools');

/********************* 自訂函數 ********************
 * @param string $sn
 * @return string|void
 */

//以流水號秀出某筆tad_idioms資料內容
function show_one_tad_idioms($sn = '')
{
    global $xoopsDB, $xoopsModule;
    if (empty($sn)) {
        return;
    }
    $sn = (int) ($sn);

    //計數器欄位值 +1
    add_tad_idioms_counter($sn);

    $sql = 'select * from ' . $xoopsDB->prefix('tad_idioms') . " where sn='{$sn}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $all    = $xoopsDB->fetchArray($result);

    //以下會產生這些變數： $sn , $title , $juin , $mean , $show_times , $search_times , $cate
    foreach ($all as $k => $v) {
        $$k = $v;
    }

    $data = "
  <table summary='list_table' id='tbl'>
  <tr><th>" . _MD_TADIDIOMS_SN . "</th><td>{$sn}</td></tr>
  <tr><th>" . _MD_TADIDIOMS_TITLE . "</th><td>{$title}</td></tr>
  <tr><th>" . _MD_TADIDIOMS_JUIN . "</th><td>{$juin}</td></tr>
  <tr><th>" . _MD_TADIDIOMS_MEAN . "</th><td>{$mean}</td></tr>
  <tr><th>" . _MD_TADIDIOMS_SHOW_TIMES . "</th><td>{$show_times}</td></tr>
  <tr><th>" . _MD_TADIDIOMS_SEARCH_TIMES . "</th><td>{$search_times}</td></tr>
  <tr><th>" . _MD_TADIDIOMS_CATE . "</th><td>{$cate}</td></tr>
  </table>";

    //raised,corners,inset
    $main = div_3d('', $data, 'corners');

    return $main;
}

/********************* 預設函數 *********************/
