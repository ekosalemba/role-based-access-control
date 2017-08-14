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
            <a href="#">Application</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<?php
$this->load->view('sys_templates/notification');
?>

<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <?php
    // include '_search.php';
    ?>
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet">
            <div class="portlet-body">
                <div class="col-md-4 col-sm-12 pull-left" style="padding: 0 0 15px;">
                    <a href="<?= $url_add ?>" class="btn green btn-sm ajaxify"><i class="fa fa-plus"></i>
                        <span> Add data</span>
                    </a>
                </div>
                <div class="col-md-8 col-sm-12 pull-right" style="padding: 0; text-align: right">
                    <div class="pull-right" style="margin: 0 15px 15px 15px;"> 
                        Show <strong><?= @$total_rows? : ''; ?> </strong> record(s)
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="3%">#</th>
                                <th width="7%">Actions</th>
                                <th width="10%">Code</th>
                                <th width="45%">Name</th>
                                <th width="35%">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($rs_id)
                            {
                                foreach ($rs_id as $key => $value)
                                {
                                    ?>

                                    <tr role="row">
                                        <td style="text-align: center">
                                            <?= $no ?>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" type="button" class="btn btn-default btn-xs dropdown-toggle">
                                                    Action <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li><a class="ajaxify" href="<?= $url_detail . '/' . $value['app_id']; ?>"><i class="fa fa-search"></i> Detail</a>
                                                    </li>
                                                    <li><a class="ajaxify" href="<?= $url_edit . '/' . $value['app_id']; ?>"><i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li><a  class="ajaxify-confirm" confirm="Are you sure want to delete?" href="<?= $url_delete . '/' . $value['app_id']; ?>"><i class="fa fa-trash"></i> Delete </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td><?= @$value['app_code']? : ''; ?></td>
                                        <td><?= @$value['app_name']? : ''; ?></td>
                                        <td><?= @$value['app_desc']? : ''; ?></td>
                                    </tr>
                                    <?php
                                    $no++;
                                }
                            } else
                            {
                                ?>
                                <tr><td colspan="12">Data not found!</td></tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="pull-right" style="margin: 0 15px 15px 15px;"> 
                    Show
                    <select name="per_page" class="ajaxify-select" href="<?php echo base_url(); ?>index.php/sys_config/config_pagination/set_per_page" dest="<?php echo $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4); ?>">
                        <?php
                        foreach ($select_per_page as $key => $value)
                        {
                            $selected = ($per_page === $value['value']) ? 'selected="selected"' : '';
                            $str = '<option value="' . $value['value'] . '" ' . $selected . '>';
                            $str .= $value['name'];
                            $str .= '</option>';
                            echo $str;
                        }
                        ?>
                    </select>
                    of <strong><?= @$total_rows? : ''; ?> </strong> record(s)
                </div>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
    <!-- End: life time stats -->
</div>
</div>
<!-- END PAGE CONTENT-->