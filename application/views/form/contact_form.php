<?php 
if ($message) {
    echo $message;
}
?>
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Formulário de Contato</p></div>
    </div>
    <div class="block-content">
    <?=form_open(base_url('index.php/message_control/contact'), 'role="form" class="form-horizontal"'); ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                <?=form_hidden('name', $this->session->userdata('user_name')); ?>
                <?=form_hidden('email', $this->session->userdata('user_email')); ?>
                <?=form_hidden('token', time()); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="name" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">From: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                   <?=form_input('name', $this->session->userdata('user_name').' < '.$this->session->userdata('user_email').' >', 'placeholder="Subject" class="form-control" required="required" disabled') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="subject" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Sujeito: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                   <?=form_input('subject', '', 'placeholder="Subject" class="form-control" required="required"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="message" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;">Mensagem : </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'mensagem',
                        'placeholder' => 'Sua mensagem',
                        'value'       => '',
                        'rows'        => '10',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?=form_textarea($data) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Enviar</button>
                    <span class="col-sm-1">&nbsp;</span>
                    <a href="<?=base_url('index.php/message_control');?>" class="btn btn-default">Cancelar</a>
                </div>
            </div>
            <?=form_close() ?>
        </div>
    </div>
    </div>
    </div>
</div>
<?php include 'application/views/plugin_scripts/bootstrap-wysihtml5.php';?>