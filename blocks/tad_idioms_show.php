<?php
use XoopsModules\Tadtools\Utility;
//區塊主函式 (成語隨時背(tad_idioms_show))
function tad_idioms_show($options)
{
    global $xoopsDB;
    $num = empty($options[0]) ? 1 : (int) ($options[0]);

    if ('day' === $options[3]) {
        $day = date('z');
        $start = $day % 200;
        $by = "order by sn limit $start,$num";
    } else {
        $by = "order by rand() limit 0,$num";
    }

    $sql = 'select * from ' . $xoopsDB->prefix('tad_idioms') . " $by ";

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //以下會產生這些變數： $sn , $title , $juin , $mean , $show_times , $search_times , $cate
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        if (empty($g2p)) {
            $g2p = ceil($sn / 20);
        }
        if (empty($show_sn)) {
            $show_sn = $sn;
        }

        if (0 == $options[1]) {
            $block['no_juin'] = true;
            $block['title'] = $title;
        } else {
            $block['no_juin'] = false;
            $ji = explode(' ', $juin);
            $main = [];
            $i = 0;
            $sound = [_MB_TADIDIOMS_2, _MB_TADIDIOMS_3, _MB_TADIDIOMS_4, _MB_TADIDIOMS_5];
            foreach ($ji as $n => $juin) {
                $sud = substr($juin, -2);
                if (in_array($sud, $sound)) {
                    $juin = substr($juin, 0, -2);
                    $lh = strlen($juin) > 6 ? 80 : 120;
                } else {
                    $sud = '&nbsp;&nbsp;';
                    $lh = strlen($juin) > 6 ? 80 : 120;
                }
                $m = $n * 3;
                $txt = substr($title, $m, 3);
                $main[$i]['txt'] = $txt;
                $main[$i]['lh'] = $lh;
                $main[$i]['juin'] = $juin;
                $main[$i]['sud'] = $sud;
                ++$i;
            }
        }

        $mean = 1 == $options[2] ? $mean : '';
    }

    $block['g2p'] = $g2p;
    $block['show_sn'] = $show_sn;
    $block['main'] = $main;
    $block['mean'] = $mean;

    return $block;
}

//區塊編輯函式
function tad_idioms_show_edit($options)
{
    $chked1_0 = (0 == $options[1]) ? 'checked' : '';
    $chked1_1 = (1 == $options[1]) ? 'checked' : '';
    $chked2_0 = (0 == $options[2]) ? 'checked' : '';
    $chked2_1 = (1 == $options[2]) ? 'checked' : '';
    $chked3_day = ('day' === $options[3]) ? 'checked' : '';
    $chked3_random = ('day' !== $options[3]) ? 'checked' : '';

    $form = "
    <ol class='my-form'>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TADIDIOMS_TADIDIOMS_SHOW_EDIT_BITEM0 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[0]' value='{$options[0]}' size=6>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TADIDIOMS_TADIDIOMS_SHOW_EDIT_BITEM1 . "</lable>
            <div class='my-content'>
                <input type='radio' $chked1_1 name='options[1]' value='1'>" . _YES . "
                <input type='radio' $chked1_0 name='options[1]' value='0'>" . _NO . "
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TADIDIOMS_TADIDIOMS_SHOW_EDIT_BITEM2 . "</lable>
            <div class='my-content'>
                <input type='radio' $chked2_1 name='options[2]' value='1'>" . _YES . "
                <input type='radio' $chked2_0 name='options[2]' value='0'>" . _NO . "
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TADIDIOMS_TADIDIOMS_SHOW_EDIT_BITEM4 . "</lable>
            <div class='my-content'>
                <input type='radio' $chked3_day name='options[3]' value='day'>" . _MB_TADIDIOMS_BITEM4_BY_DAY . "
                <input type='radio' $chked3_random name='options[3]' value='random'>" . _MB_TADIDIOMS_BITEM4_BY_RANDOM . '
            </div>
        </li>
    </ol>';

    return $form;
}
