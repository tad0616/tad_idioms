<{$toolbar|default:''}>

<h2 style="display:none;"><{$smarty.const._MD_TADIDIOMS_TITLE}></h2>

<form action="index.php" method="post" role="form" style=margin-bottom:20px;">
    <div class="input-group">
        <div class="input-group-prepend input-group-addon">
            <span class="input-group-text"><{$smarty.const._MD_TADIDIOMS_SEARCH}><{$smarty.const._TAD_FOR}></span>
        </div>
        <input type="text" name="keyword" class="form-control" title="<{$smarty.const._MD_TADIDIOMS_SEARCH}>" placeholder="<{$smarty.const._MD_TADIDIOMS_SEARCH}>">
        <div class="input-group-append input-group-btn">
            <button type="submit" class="btn btn-primary"><{$smarty.const._MD_TADIDIOMS_SEARCH}></button>
        </div>
    </div>
</form>

<{foreach from=$all_content item=idioms}>
    <div id="<{$idioms.name}>"></div>
    <div class="alert alert-info" <{if $idioms.current|default:false}>style="background-color:#FFFF80"<{/if}>>
        <table style='width:auto;'>
            <tr>
                <td><{$idioms.sn}>.</td>
                <{$idioms.main}>
            </tr>
        </table>
        <div style='margin:10px 0px 10px 35px;'><{$idioms.mean}></div>
    </div>
<{/foreach}>

<{if $smarty.session.tad_idioms_adm|default:false}>
    <div class="bar">
        <a href='admin/main.php?op=tad_idioms_form'  class='btn btn-info'><i class="fa fa-plus-square" aria-hidden="true"></i>  <{$smarty.const._TAD_ADD}></a>
    </div>
<{/if}>

<{$bar|default:''}>