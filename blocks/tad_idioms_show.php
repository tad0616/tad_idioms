<?php
use XoopsModules\Tadtools\Utility;
//區塊主函式 (成語隨時背(tad_idioms_show))
function tad_idioms_show($options)
{
    global $xoopsDB;
    $num = empty($options[0]) ? 1 : (int) ($options[0]);

    if ($options[4] == "day") {
        $day = date("z");
        $start = $day % 200;
        $by = "order by sn limit $start,$num";
    } else {
        $by = "order by rand() limit 0,$num";
    }

    $sql = "select * from " . $xoopsDB->prefix("tad_idioms") . " $by ";

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while ($all = $xoopsDB->fetchArray($result)) {
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

        if ($options[1] == 0) {
            $block['no_juin'] = true;
            $block['title'] = $title;
        } else {
            $block['no_juin'] = false;
            $ji = explode(" ", $juin);
            $main = array();
            $i = 0;
            $sound = array(_MB_TADIDIOMS_2, _MB_TADIDIOMS_3, _MB_TADIDIOMS_4, _MB_TADIDIOMS_5);
            foreach ($ji as $n => $juin) {
                $sud = substr($juin, -2);
                if (in_array($sud, $sound)) {

                    $juin = substr($juin, 0, -2);
                    $lh = strlen($juin) > 6 ? 80 : 120;
                } else {
                    $sud = "&nbsp;&nbsp;";
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

        $mean = $options[2] == 1 ? $mean : "";
    }

    $sound_js = "";
    if ($options[3] == 1) {
        $sound_js = play_idioms_sound($title . " , " . $mean);
    }

    $block['g2p'] = $g2p;
    $block['show_sn'] = $show_sn;
    $block['main'] = $main;
    $block['mean'] = $mean;
    $block['sound_js'] = $sound_js;

    return $block;
}

function play_idioms_sound($title = "")
{
    $main = "
    <script language='javascript' src='https://tts.itri.org.tw/TTScript/Text2SpeechJsApiV2.php?key=ekn@-_ji50*2A*14*2Aefg*60ab'></script>
    <script type=\"text/javascript\">
        $(document).ready(function(){
        $('.ttsmedia_block > div > img').attr('alt','ttsmedia');
        });
    </script>
    <div id='ttscontent' style='display:none;'>$title</div>
    <div id='ttsmedia' class='ttsmedia_block'></div>
    <script language='javascript'>
        var tts = new TTS();
        tts.PlayerSet.hidden = false;
        tts.PlayerSet.width = 150;
        tts.PlayerSet.height = 40;
        tts.ConvertInit('id:ttscontent','ttsmedia','Bruce','100','0','0','0','5');
    </script>";

    return $main;
}

//區塊編輯函式
function tad_idioms_show_edit($options)
{
    $chked1_0 = ($options[1] == 0) ? "checked" : "";
    $chked1_1 = ($options[1] == 1) ? "checked" : "";
    $chked2_0 = ($options[2] == 0) ? "checked" : "";
    $chked2_1 = ($options[2] == 1) ? "checked" : "";
    $chked3_0 = ($options[3] == 0) ? "checked" : "";
    $chked3_1 = ($options[3] == 1) ? "checked" : "";
    $chked4_day = ($options[4] == 'day') ? "checked" : "";
    $chked4_random = ($options[4] == 'random') ? "checked" : "";

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
            <lable class='my-label'>" . _MB_TADIDIOMS_TADIDIOMS_SHOW_EDIT_BITEM3 . "</lable>
            <div class='my-content'>
                <input type='radio' $chked3_1 name='options[3]' value='1'>" . _YES . "
                <input type='radio' $chked3_0 name='options[3]' value='0'>" . _NO . "
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TADIDIOMS_TADIDIOMS_SHOW_EDIT_BITEM4 . "</lable>
            <div class='my-content'>
                <input type='radio' $chked4_day name='options[4]' value='day'>" . _MB_TADIDIOMS_BITEM4_BY_DAY . "
                <input type='radio' $chked4_random name='options[4]' value='random'>" . _MB_TADIDIOMS_BITEM4_BY_RANDOM . "
            </div>
        </li>
    </ol>";

    return $form;
}
