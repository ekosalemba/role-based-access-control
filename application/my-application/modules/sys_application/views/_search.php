<style>
    .portlet{
        padding-bottom: 5px !important;
    }
    .form-group{
        margin-bottom: 5px !important;
    }
</style>
<div class="col-md-12">
    <div class="portlet light bordered">

        <div class="portlet-body" style="padding: 0px !important">
            <!-- BEGIN FORM-->
            <form method="POST" class="ajaxify-form form-horizontal" action="<?= @$url_search? : ''; ?>">
                <input id="search_type" type="hidden" name="search_type" value="<?= @$search['search_type']? : 'simple'; ?>" />
                <div id="search_simple">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2">Keyword</label>
                            <div class="col-md-6" style="margin-bottom: 5px">
                                <input type="text" name="s_keyword" value="<?= @$search['s_keyword']? : ''; ?>" class="form-control input-sm">
                            </div>
                            <div class="col-md-4">
                                <button class="btn blue btn-sm" type="submit" value="submit" name="save"><i class="fa fa-search"></i> Search</button>
                                <button class="btn default btn-sm" type="submit" value="reset" name="save" 
                                        onclick="$('<input />').attr('type', 'hidden')
                                                        .attr('name', this.name)
                                                        .attr('value', this.value)
                                                        .appendTo('.ajaxify-form');
                                                return true;">Reset</button>
                                <button id="btn-advance" class="btn dark btn-sm" type="button">Advance</button>
                            </div>
                        </div>
                    </div>
                </div>    
                <div id="search_advance">    
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2">Parent</label>
                            <div class="col-md-6">
                                <select name="dept_parent_id" class="form-control input-sm">
                                    <option value="0"></option>
                                    <?php
                                    $selected = '';
                                    foreach ($list_application as $key => $value)
                                    {
                                        if ($value['path'] === $search['dept_parent_id']? : '')
                                        {
                                            $selected = 'selected="selected"';
                                        } else
                                        {
                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?= $value['path'] ?>" <?= $selected ?> ><?= $value['tree_item'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">Code</label>
                            <div class="col-md-6">
                                <input type="text" name="dept_code" value="<?= @$search['dept_code']? : ''; ?>" class="form-control input-sm">
                                <span class="help-block"> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">Name</label>
                            <div class="col-md-6">
                                <input type="text" name="dept_name" value="<?= @$search['dept_name']? : ''; ?>" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">Description</label>
                            <div class="col-md-6">
                                <input type="text" name="dept_desc" value="<?= @$search['dept_desc']? : ''; ?>" class="form-control input-sm">
                                <span class="help-block"> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">Order</label>
                            <div class="col-md-2">
                                <input type="number" name="dept_order" value="<?= @$search['dept_order']? : ''; ?>" class="form-control input-sm" style="text-align: right">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button class="btn blue btn-sm" id="submit" type="submit" value="submit" name="save"><i class="fa fa-search"></i> Search</button>
                                <button class="btn default btn-sm" id="submit" type="submit" value="reset" name="save" 
                                        onclick="$('<input />').attr('type', 'hidden')
                                                        .attr('name', this.name)
                                                        .attr('value', this.value)
                                                        .appendTo('.ajaxify-form');
                                                return true;">Reset</button>
                                <button id="btn-simple" class="btn dark btn-sm" type="button">Simple</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btn-simple').click(function () {
        $('#search_advance').hide();
        $('#search_simple').show();
        $('#search_type').val('simple');
    });
    $('#btn-advance').click(function () {
        $('#search_simple').hide();
        $('#search_advance').show();
        $('#search_type').val('advance');
    });
    if ($('#search_type').val() === 'advance') {
        $('#search_simple').hide();
        $('#search_advance').show();
    } else {
        $('#search_advance').hide();
        $('#search_simple').show();
    }
</script>
