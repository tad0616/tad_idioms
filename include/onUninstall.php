<?php

function xoops_module_uninstall_tad_idioms(&$module)
{
    global $xoopsDB;
    $date = date('Ymd');

    rename(XOOPS_ROOT_PATH . '/uploads/tad_idioms', XOOPS_ROOT_PATH . "/uploads/tad_idioms_bak_{$date}");

    return true;
}
