<{$toolbar}>


<h2 style="display:none;"><{$smarty.const._MD_TADIDIOMS_TITLE}></h2>

<form action="index.php" method="post" role="form">
<div class="form-group row">
    <label class="col-sm-2 col-form-label text-sm-right">
    <{$smarty.const._MD_TADIDIOMS_SEARCH}><{$smarty.const._TAD_FOR}>
    </label>
    <div class="col-sm-9">
    <input type="text" name="keyword" class="form-control">
    </div>
    <div class="col-sm-1">
    <button type="submit" class="btn"><{$smarty.const._MD_TADIDIOMS_SEARCH}></button>
    </div>
</div>
</form>

<{foreach from=$all_content item=idioms}>
<div id="<{$idioms.name}>"></div>
<div class="card card-body bg-light m-1" <{if $idioms.current}>style="background-color:#FFFF80"<{/if}>>
    <table style='width:auto;'>
        <tr>
            <td><{$idioms.sn}>.</td>
            <{$idioms.main}>
        </tr>
    </table>
    <div style='margin:10px 0px 10px 35px;'><{$idioms.mean}></div>
</div>
<{/foreach}>

<{if $isAdmin}>
<a href='admin/main.php?op=tad_idioms_form'  class='btn btn-info'><{$smarty.const._TAD_ADD}></a>

<{/if}>
<{$bar}>