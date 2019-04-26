<?php

use XoopsModules\Tadtools\Utility;

function xoops_module_update_tad_idioms(&$module, $old_version)
{
    global $xoopsDB;

    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_idioms");

    return true;
}
