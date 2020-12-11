<?php date_default_timezone_set($this->session->userdata['time_zone']); ?>
<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Add Post </p></div>
    </div>
    <div class="block-content">
    <form action="<?=base_url().'index.php/blog/save'?>" method="post" id="ajax-form" role="form" class="form-horizontal">  
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="form-group">
                <label for="title" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Titulo: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                    <?=form_input('blog_title', set_value('blog_title'), 'placeholder="Titulo do post" id="title" class="form-control" required="required"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="post_descr" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;">Conteúdo : </label>
                <div class="col-lg-9 col-sm-9 col-xs-7 col-mb">
                  <?php 
                    $placeholder = 'Use a tag < p > ou < span > para parágrafos';
                    $data = array(
                        'name'        => 'post_descr',
                        'placeholder' => "$placeholder",
                        'id'          => 'post_descr',
                        'value'       => '',
                        'rows'        => '15',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?=form_textarea($data) ?>
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