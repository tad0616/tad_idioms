<h2><{$smarty.const._MA_TADIDIOMS_FORM}></h2>

<form action="main.php" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
    <div class="form-group row mb-3">
        <label class="col-sm-2 control-label col-form-label text-sm-right text-sm-end">
            <{$smarty.const._MA_TADIDIOMS_TITLE}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="title" value="<{$title|default:''}>" id="title" class="validate[required] form-control" placeholder="<{$smarty.const._MA_TADIDIOMS_TITLE}>">
        </div>
    </div>

    <div class="form-group row mb-3">
        <label class="col-sm-2 control-label col-form-label text-sm-right text-sm-end">
            <{$smarty.const._MA_TADIDIOMS_JUIN}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="juin" class="form-control" value="<{$juin|default:''}>" id="juin" placeholder="<{$smarty.const._MA_TADIDIOMS_JUIN}>">
        </div>
    </div>

    <div class="form-group row mb-3">
        <label class="col-sm-2 control-label col-form-label text-sm-right text-sm-end">
            <{$smarty.const._MA_TADIDIOMS_MEAN}>
        </label>
        <div class="col-sm-10">
            <textarea name="mean" class="form-control" id="mean" placeholder="<{$smarty.const._MA_TADIDIOMS_MEAN}>"><{$mean|default:''}></textarea>
        </div>
    </div>

    <div class="bar">
        <!--編號-->
        <input type="hidden" name="sn" value="<{$sn|default:''}>">
        <input type="hidden" name="op" value="<{$next_op|default:''}>">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>  <{$smarty.const._TAD_SAVE}></button>
    </div>

</form>