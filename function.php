<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2012-06-02
// $Id:$
// ------------------------------------------------------------------------- //
//引入TadTools的函式庫
if(!file_exists(XOOPS_ROOT_PATH."/modules/tadtools/tad_function.php")){
 redirect_header("http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50",3, _TAD_NEED_TADTOOLS);
}
include_once XOOPS_ROOT_PATH."/modules/tadtools/tad_function.php";


/********************* 自訂函數 *********************/


//以流水號秀出某筆tad_idioms資料內容
function show_one_tad_idioms($sn=""){
	global $xoopsDB,$xoopsModule;
	if(empty($sn)){
		return;
	}else{
		$sn=intval($sn);
	}

  	//計數器欄位值 +1
	add_tad_idioms_counter($sn);

	$sql = "select * from ".$xoopsDB->prefix("tad_idioms")." where sn='{$sn}'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	$all=$xoopsDB->fetchArray($result);

	//以下會產生這些變數： $sn , $title , $juin , $mean , $show_times , $search_times , $cate
	foreach($all as $k=>$v){
		$$k=$v;
	}

	$data="
	<table summary='list_table' id='tbl'>
	<tr><th>"._MD_TADIDIOMS_SN."</th><td>{$sn}</td></tr>
	<tr><th>"._MD_TADIDIOMS_TITLE."</th><td>{$title}</td></tr>
	<tr><th>"._MD_TADIDIOMS_JUIN."</th><td>{$juin}</td></tr>
	<tr><th>"._MD_TADIDIOMS_MEAN."</th><td>{$mean}</td></tr>
	<tr><th>"._MD_TADIDIOMS_SHOW_TIMES."</th><td>{$show_times}</td></tr>
	<tr><th>"._MD_TADIDIOMS_SEARCH_TIMES."</th><td>{$search_times}</td></tr>
	<tr><th>"._MD_TADIDIOMS_CATE."</th><td>{$cate}</td></tr>
	</table>";

	//raised,corners,inset
	$main=div_3d("",$data,"corners");

	return $main;
}


/********************* 預設函數 *********************/
//圓角文字框
function div_3d($title="",$main="",$kind="raised",$style="",$other=""){
	$main="<table style='width:auto;{$style}'><tr><td>
	<div class='{$kind}'>
	<h1>$title</h1>
	$other
	<b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>
	<div class='boxcontent'>
 	$main
	</div>
	<b class='b4b'></b><b class='b3b'></b><b class='b2b'></b><b class='b1b'></b>
	</div>
	</td></tr></table>";
	return $main;
}
?>