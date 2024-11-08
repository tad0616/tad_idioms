<?php
//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_idioms_adm'])) {
    $_SESSION['tad_idioms_adm'] = isset($xoopsUser) && \is_object($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TADIDIOMS_INDEX] = 'index.php';
$interface_icon[_MD_TADIDIOMS_INDEX] = "fa-language";
