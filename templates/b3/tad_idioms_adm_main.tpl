<div class="container-fluid">
  <{if $op=="tad_idioms_form"}>
    <h2><{$smarty.const._MA_TADIDIOMS_FORM}></h2>

  	<form action="main.php" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
      <div class="form-group">
        <label class="col-sm-2 control-label">
          <{$smarty.const._MA_TADIDIOMS_TITLE}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="title" value="<{$title}>" id="title" class="validate[required] form-control" placeholder="<{$smarty.const._MA_TADIDIOMS_TITLE}>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">
          <{$smarty.const._MA_TADIDIOMS_JUIN}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="juin" class="form-control" value="<{$juin}>" id="juin" placeholder="<{$smarty.const._MA_TADIDIOMS_JUIN}>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">
          <{$smarty.const._MA_TADIDIOMS_MEAN}>
        </label>
        <div class="col-sm-10">
          <textarea name="mean" class="form-control" id="mean" placeholder="<{$smarty.const._MA_TADIDIOMS_MEAN}>"><{$mean}></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12 text-center">
          <!--編號-->
          <input type="hidden" name="sn" value="<{$sn}>">
          <input type="hidden" name="op" value="<{$op}>">
          <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
        </div>
      </div>

  	</form>
  <{else}>

    <script>
      function delete_tad_idioms_func(sn){
        var sure = window.confirm("<{$smarty.const._TAD_DEL_CONFIRM}>");
        if (!sure)	return;
        location.href="main.php?op=delete_tad_idioms&sn=" + sn;
      }
    </script>

    <table class="table table-striped table-bordered table-hover">
      <tr>
        <td><{$smarty.const._MA_TADIDIOMS_SN}></td>
        <td><{$smarty.const._MA_TADIDIOMS_TITLE}></td>
        <td><{$smarty.const._MA_TADIDIOMS_JUIN}></td>
        <td><{$smarty.const._MA_TADIDIOMS_SHOW_TIMES}></td>
        <td><{$smarty.const._MA_TADIDIOMS_SEARCH_TIMES}></td>
        <!--td><{$smarty.const._MA_TADIDIOMS_CATE}></td-->
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
            <a href="main.php?op=tad_idioms_form&sn=<{$idioms.sn}>" class="btn btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
            <a href="javascript:delete_tad_idioms_func(<{$idioms.sn}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
          </td>
        </tr>
      <{/foreach}>
      </tbody>
    </table>
    <div class="text-center" style="margin: 20px;">
      <a href="main.php?op=tad_idioms_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
    </div>
    <{$bar}>
  <{/if}>
</div>