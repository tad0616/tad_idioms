<?php

use XoopsModules\Tad_idioms\Utility;

function xoops_module_update_tad_idioms(&$module, $old_version)
{
    global $xoopsDB;

    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_idioms');

    //if(!chk_chk1()) tad_idioms_go_update1();

    return true;
}
