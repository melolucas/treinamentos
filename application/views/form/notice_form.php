<?php include 'application/views/plugin_scripts/datepicker.php';?>
<?php date_default_timezone_set($this->session->userdata['time_zone']); ?>

<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>

<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Add aviso </p></div>
    </div>
    <div class="block-content">
    <form action="<?php echo base_url().'index.php/noticeboard/save'?>" method="post" id="ajax-form" role="form" class="form-horizontal">  
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="form-group">
                <label for="title" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Titulo: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                    <?php echo form_input('notice_title', set_value('notice_title'), 'placeholder="Notice title" id="title" class="form-control" required="required"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="Description" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;">Descrição : </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'notice_descr',
                        'placeholder' => 'Description',
                        'id'          => 'Description',
                        'value'       => '',
                        'rows'        => '4',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="daterange" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Intervalo de data: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                    <div class="input-group">
                        <input type="text" name="daterange" id="daterange" class="form-control"/>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Status: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                <select name="notice_status" id="status" class="form-control">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
                </div>
            </div>

            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Salvar</button>

                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</div>
<?php include 'application/views/plugin_scripts/bootstrap-wysihtml5.php';?>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#daterange').daterangepicker({
            timePicker: false, 
            timePickerIncrement: 30, 
            format: 'YYYY-MM-DD' 
        });
    });
</script>
