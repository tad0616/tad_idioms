<table style="width:auto;margin:10px auto;font-family:<{$smarty.const._MB_TADIDIOMS_FONT}>;">
  <tr>
    <{if $block.no_juin}>
      <td style="font-size: 2.5em;"><{$block.title}></td>
    <{else}>
      <{foreach from=$block.main item=word}>
        <td style="vertical-align: middle; text-align:right;width:30px;height:30px;line-height:30px;">
          <span style="font-size: 1.875em;"><{$word.txt}></span>
        </td>
        <td style="vertical-align:middle;text-align:left;font-size: 0.8em;width:12px;line-height:10px;">
          <span style="font-size: 0.8em;width:12px;line-height:<{$word.lh}>%;"><{$word.juin}></span>
        </td>
        <td style="vertical-align: middle; text-align:left;width:10px;padding:0px;">
          <span style="margin:0px;font-size: 0.8em;"><{$word.sud}></span>
        </td>
      <{/foreach}>
    <{/if}>
  </tr>
</table>

<{if $block.mean}>
  <div class="well well-small"><{$block.mean}></div>
<{/if}>

<a href="<{$xoops_url}>/modules/tad_idioms/index.php?g2p=<{$block.g2p}>&show_sn=<{$block.show_sn}>#<{$block.show_sn}>" class="btn btn-xs btn-mini btn-info pull-right">more...</a>

<div class="clearfix"></div>
