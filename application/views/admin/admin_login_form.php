<section id="login">
    <div class="container">
        <div class="box">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
                    <?=(isset($message)) ? $message : ''; ?>
                </div>
                <div class="col-md-4 col-sm-8 col-md-offset-4 col-sm-offset-2">
                    <div class="center">
                        <h3></h3>
                    </div><!--/.center-->   
                    <?php echo form_open(base_url('index.php/admin'), 'role="form" class="form-horizontal"'); ?>
                        <?php
                        $option = array();
                        $option[0] = 'Selecione usuario para função';
                        foreach ($user_role as $value) {
                            if ($value->user_role_id < 5) {
                                $option[$value->user_role_id] = $value->user_role_name;
                            }
                        }
                        ?>
                        <?php echo form_dropdown('user_role', $option, '', 'class="form-control"') ?>

                        <?=form_input('cpf', '', 'id="cpf" type="text" title="CPF" placeholder="CPF" onkeypress="formatar_mascara(this,\'###.###.###-##\')" class="form-control" required="required"') ?>
                        <?=form_password('user_pass', '', 'id="user_pass" placeholder="Senha" class="form-control" required="required"') ?>
                        <button type="submit" class="btn btn-warning btn-lg btn-block">Login</button>
                    <?=form_close() ?>

                    <div class="big-gap"></div>
                    <i class="glyphicon glyphicon-question-sign"> </i> <a href="<?=base_url('index.php/login_control/password_recovery_form'); ?>"> Esqueceu a senha?</a>
                </div>
                </div>
            </div>
        </div> 
    </div>
</section><!--/#login-->

<script type="text/javascript">
    function formatar_mascara(src, mascara) {
        var campo = src.value.length;
        var saida = mascara.substring(0,1);
        var texto = mascara.substring(campo);
        if(texto.substring(0,1) != saida) {
            src.value += texto.substring(0,1);
        }
    }
</script>