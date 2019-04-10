<?php

use XoopsModules\Tad_idioms\Utility;

include dirname(__DIR__) . '/preloads/autoloader.php';

function xoops_module_install_tad_idioms(&$module)
{

    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_idioms");

    return true;
}
