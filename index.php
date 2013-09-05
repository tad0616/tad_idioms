<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2012-06-02
// $Id:$
// ------------------------------------------------------------------------- //
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "tad_idioms_index_tpl.html";
/*-----------function區--------------*/


//列出所有tad_idioms資料
function list_tad_idioms(){
	global $xoopsDB,$xoopsModule;
	$sql = "select * from ".$xoopsDB->prefix("tad_idioms")."";

	//getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
  $PageBar=getPageBar($sql,20,10);
  $bar=$PageBar['bar'];
  $sql=$PageBar['sql'];
  $total=$PageBar['total'];

	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

	$all_content="";

	while($all=$xoopsDB->fetchArray($result)){
	  //以下會產生這些變數： $sn , $title , $juin , $mean , $show_times , $search_times , $cate
    foreach($all as $k=>$v){
      $$k=$v;
    }
    
    $ji=explode(" ",$juin);
    $main="";
    $sound=array('ˊ','ˇ','ˋ','˙');
    foreach($ji as $n=>$juin){
      $sud=substr($juin,-2);
      if(in_array($sud,$sound)){
        $juin=substr($juin,0,-2);
        $lh=strlen($juin)>6?80:120;
      }else{
        $sud="&nbsp;&nbsp;";
        $lh=strlen($juin)>6?80:120;
      }
      $m=$n*3;
      $txt=substr($title,$m,3);
      $main.="
      <td style='vertical-align: middle; text-align:right;width:30px;'><span style='font-size:30px;font-family:標楷體;'>$txt</span></td>
        <td style='vertical-align: middle;width:11px;'><span style='font-size:10px;font-family:標楷體;writing-mode:tb-rl;line-height:{$lh}%;'>$juin</span></td>
        <td style='vertical-align: middle; text-align:left;width:19px;'><span style='font-size:10px;font-family:標楷體'>$sud</span></td>
      ";
    }
      
		$all_content.="<tr style='height:80px;'>
		<td><table style='width:240px;'>{$main}</table><div>{$mean}</div></td>
		</tr>";
	}

  //if(empty($all_content))return "";

	$data="
	<table summary='list_table' style='width:100%;'>
	<tbody>
	$all_content
	<tr>
	<td class='bar'>
	<a href='{$_SERVER['PHP_SELF']}?op=tad_idioms_form'  class='link_button_r'>"._BP_ADD."</a>
	{$bar}</td></tr>
	</tbody>
	</table>";

	//raised,corners,inset
	//$main=div_3d("",$data,"corners");

	return $data;
}


/*-----------執行動作判斷區----------*/
$op=empty($_REQUEST['op'])?"":$_REQUEST['op'];
$sn=empty($_REQUEST['sn'])?"":intval($_REQUEST['sn']);


switch($op){
  //預設動作
  default:
  if(empty($sn)){
  	$main=list_tad_idioms();
  	//$main.=tad_idioms_form($sn);
  }else{
  	$main=show_one_tad_idioms($sn);
  }
  break;
}

/*-----------秀出結果區--------------*/
module_footer($main);
?>