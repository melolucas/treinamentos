<!-- Popup Login-->
<div id="login" class="well my-popup" style="max-width:44em;">
    <h4>Login</h4>
        <?php echo form_open(base_url('index.php/login_control') ,'role="form" class="form-horizontal"'); ?>
          <div class="popup-form">
            <div class="col-xs-12 nopadding">
                <?php echo form_input('user_email', '', 'placeholder="Email address" class="form-control input" required="required"') ?>
                <?php echo form_password('user_pass', '', 'placeholder="Password" class="form-control input" required="required"') ?>
            </div>
          </div>
          <div class=" col-xs-12 nopadding">
            <?php echo form_submit('submit', 'Login', 'class="btn btn-warning btn-block"') ?>  
          </div>
          <div class=" col-xs-12 popup-bottom">
            <button type="reset" class=" btn btn-sm btn-default">Limpar</button>
            <button class="login_close btn btn-sm btn-default pull-right">Fechar</button>
          </div>
        <?php echo form_close() ?>
</div>

<!-- Popup Register-->
<div id="register" class="well my-popup" style="max-width:44em;">
    <h4>Registo</h4>
        <?php echo form_open(base_url('index.php/login_control/register') ,'role="form" class="form-horizontal"'); ?>
          <?=form_hidden('token', time()); ?>
          <div class="popup-form">
            <div class="col-xs-12 nopadding">
                <?php echo form_input('user_name', '', 'placeholder="Nome completo " class="form-control" required="required"') ?>
                <?php echo form_input('user_email', '', 'pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="you@domain.com" placeholder="Email address" class="form-control" required="required"') ?>
                <?php echo form_password('user_pass', '', 'placeholder="Senha (mínimo 6 caracteres) " class="form-control" required="required"') ?>
                <?php echo form_password('user_passcf', '', 'placeholder="Confirme a Senha " class="form-control" required="required"') ?>
                <p class="text-muted">* Todos os campos são necessários.</p>
            </div>
          </div>
          <div class=" col-xs-12 nopadding">
            <?php echo form_submit('submit', 'Registo', 'class="btn btn-primary btn-block"') ?>  
          </div>
          <div class=" col-xs-12 popup-bottom">
            <button type="reset" class=" btn btn-sm btn-default">Restabelecer</button>
            <button class="register_close btn btn-sm btn-default pull-right">Fechar</button>
          </div>
        <?php echo form_close() ?>
</div>

<script src="<?php echo base_url('assets/js/jquery.popupoverlay.js') ?>"></script>
<style type="text/css">
@media (max-width: 991px) {
  .my-popup {
    transform: scale(0.8);
    width: 60%;
  }
}
@media (min-width: 992px) {
  .my-popup {
    transform: scale(0.8);
    width: 25%;
  }
}

.popup_visible .my-popup {
  transform: scale(1);
} 
.my-popup h4{
  text-align: center;
}

.popup-form p{
  font-size: 12px;
}
.popup-form .input{
  border-radius: 0px;
}

.popup-bottom{
  margin-top: 20px;
}
</style>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      // Initialize the plugin
      $('.my-popup').popup({
      transition: 'all 0.3s'
    });
    });
</script>