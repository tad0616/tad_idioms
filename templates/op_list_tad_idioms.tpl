<table class="table table-striped table-bordered table-hover">
    <tr>
        <td><{$smarty.const._MA_TADIDIOMS_SN}></td>
        <td><{$smarty.const._MA_TADIDIOMS_TITLE}></td>
        <td><{$smarty.const._MA_TADIDIOMS_JUIN}></td>
        <td><{$smarty.const._MA_TADIDIOMS_SHOW_TIMES}></td>
        <td><{$smarty.const._MA_TADIDIOMS_SEARCH_TIMES}></td>
        <td><{$smarty.const._TAD_FUNCTION}></td>
    </tr>
    <tbody>

    <{foreach from=$all_content item=idioms}>
        <tr>
            <td><{$idioms.sn}></td>
            <td><{$idioms.title}></td>
            <td><{$idioms.juin}></td>
            <td><{$idioms.show_times}></td>
            <td><{$idioms.search_times}></td>
            <!--td><{$idioms.cate}></td-->
            <td>
            <a href="main.php?op=tad_idioms_form&sn=<{$idioms.sn}>" class="btn btn-sm btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
            <a href="javascript:delete_tad_idioms_func(<{$idioms.sn}>);" class="btn btn-sm btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
            </td>
        </tr>
    <{/foreach}>
    </tbody>
</table>
<div class="bar" >
    <a href="main.php?op=tad_idioms_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
</div>
<{$bar|default:''}>