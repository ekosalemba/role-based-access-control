<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url(); ?>index.php/sys_home/dashboard/index">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Settings</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a class="ajaxify"  href="<?php echo base_url(); ?>index.php/sys_application/application/index">Application</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Detail</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="portlet light bordered bg-inverse form-fit">
    <div class="portlet-title" style="padding-top: 10px">
        <div class="caption">
            <i class="fa fa-slack font-blue-hoki"></i>
            <span class="caption-subject font-blue-hoki bold uppercase"><?= @$form_label? : '' ?></span>
            <span class="caption-helper"></span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form method="POST" class="form-horizontal form-bordered form-row-stripped" action="<?php echo @$url_action? : ''; ?>">
            <input type="hidden" name="app_id" value="<?php echo @$result['app_id']? : ''; ?>">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">Code</label>
                    <div class="col-md-9">
                        <span class="help-block"><?= @$result['app_code']? : ''; ?>&nbsp;</span>
                    </div>
                </div>
                <div clasis="form-group">
                    <label class="control-label col-md-3">Title</label>
                    <div class="col-md-9">
                        <span class="help-block"><?= @$result['app_title']? : ''; ?>&nbsp;</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Name</label>
                    <div class="col-md-9">
                        <span class="help-block"><?= @$result['app_name']? : ''; ?>&nbsp;</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Description</label>
                    <div class="col-md-9">
                        <span class="help-block"><?= @$result['app_desc']? : ''; ?>&nbsp;</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Order</label>
                    <div class="col-md-2">
                        <span class="help-block"><?= @$result['app_order']? : ''; ?>&nbsp;</span>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
