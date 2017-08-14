<?php
$this->load->view('sys_templates/notification');
?>
<div class="portlet light bordered bg-inverse form-fit">
    <div class="portlet-title" style="padding: 5px 10px 0">
        <div class="caption">
            <i class="fa fa-slack  font-blue-hoki"></i>
            <span class="caption-subject font-blue-hoki bold uppercase"><?= $form_label ?></span>
            <span class="caption-helper"></span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form method="POST" class="ajaxify-form form-horizontal form-bordered form-row-stripped" action="<?php echo @$url_action? : ''; ?>">
            <input type="hidden" name="dept_id" value="<?php echo @$result['dept_id']? : ''; ?>">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">Parent</label>
                    <div class="col-md-9">
                        <select class="form-control" name="dept_parent_id">
                            <option value="0"></option>
                            <?php
                            $selected = '';
                            foreach ($list_application as $key => $value)
                            {
                                if ($value['dept_id'] === $result['dept_parent_id']? : '')
                                {
                                    $selected = 'selected="selected"';
                                } else
                                {
                                    $selected = '';
                                }
                                ?>
                                <option value="<?= $value['dept_id'] ?>" <?= $selected ?> ><?= $value['tree_item'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Code</label>
                    <div class="col-md-9">
                        <input type="text" name="dept_code" value="<?= @$result['dept_code']? : ''; ?>" class="form-control">
                        <span class="help-block"> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Name</label>
                    <div class="col-md-9">
                        <input type="text" name="dept_name" value="<?= @$result['dept_name']? : ''; ?>" class="form-control" required="required">
                        <span class="help-block">*required</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Description</label>
                    <div class="col-md-9">
                        <input type="text" name="dept_desc" value="<?= @$result['dept_desc']? : ''; ?>" class="form-control">
                        <span class="help-block"> </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Order</label>
                    <div class="col-md-2">
                        <input type="number" name="dept_order" value="<?= @$result['dept_order']? : ''; ?>" class="form-control" style="text-align: right">
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn green" type="submit"><i class="fa fa-check"></i> Save</button>
                        <button class="btn default" type="reset">Reset</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>