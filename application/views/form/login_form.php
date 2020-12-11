<section id="login">
    <div class="container">
        <div class="box">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
                </div>
                <div class="col-md-4 col-sm-8 col-md-offset-4 col-sm-offset-2">
                    <div class="center">
                        <h3>Login</h3>
                    </div><!--/.center-->   
                    <?=form_open(base_url('index.php/login_control'), 'role="form" class="form-horizontal"'); ?>
                        <?=form_input('cpf', '', 'id="cpf" type="cpf" onkeypress="formatar_mascara(this,\'###.###.###-##\')" title="cpf" placeholder="CPF" class="form-control" required="required"') ?>
                        <?=form_password('user_pass', '', 'id="user_pass" placeholder="Senha" class="form-control" required="required"') ?>
                        <button type="submit" class="btn btn-warning btn-lg btn-block">Login</button>
                    <?=form_close() ?>

<!--                    <div class="big-gap"></div>-->
<!--                    <i class="glyphicon glyphicon-question-sign"> </i> <a href="--><?//=base_url('index.php/login_control/password_recovery_form'); ?><!--"> Recuperar Senha</a>-->
<!--                        --><?php //if ($this->session->userdata('student_can_register')){  ?>
<!--                     Novo Usuario?<a href="--><?//=base_url('index.php/login_control/register'); ?><!--">Registro aqui </a>-->
<!--                     --><?php //} ?>
<!--                </div>-->
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