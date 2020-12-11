<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
</div>
<div class="block">  
  <div class="navbar block-inner block-header">
      <div class="row">
          <p class="text-muted">Novo usuário</p>
      </div>
  </div>
  <div class="block-content">
      <div class="row">
          <div class="col-sm-12">
            <?php echo form_open(base_url() . 'index.php/user_control/add_user', 'role="form" class="form-horizontal"'); ?>
                <div class="form-group">
                  <label for="user_name" class="col-sm-2 control-label col-xs-2">Nome de usuário: *</label>
                  <div class="col-xs-6">
                      <?php echo form_input('user_name', '', 'placeholder="Nome de Usuario" class="form-control" required="required"') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_email" class="col-sm-2 control-label col-xs-2">Email: </label>
                  <div class="col-xs-6">
                      <?php echo form_input('user_email', '', 'pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="you@domain.com" placeholder="Email endereço" class="form-control" ') ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="user_phone" class="col-sm-2 control-label col-xs-2">Telefone: </label>
                  <div class="col-xs-6">
                      <?php echo form_input('user_phone', '', 'pattern="^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$" title="Enter Valid Phone Number" min="8" max="15" placeholder="Fone numero" class="form-control" ') ?>
                  </div>
                </div>
              <div class="form-group">
                  <label for="user_phone" class="col-sm-2 control-label col-xs-2">CPF:</label>
                  <div class="col-xs-6">
                      <?php echo form_input('cpf',  '', ' title="CPF" min="13" max="13" placeholder="CPF"  onkeypress="formatar_mascara(this,\'###.###.###-##\')" class="form-control"') ?>
                  </div>
              </div>
                <div class="form-group">
                  <label for="user_pass" class="col-sm-2 control-label col-xs-2">Senha: *</label>
                  <div class="col-xs-6">
                      <?php echo form_password('user_pass', '', 'placeholder="Senha (Minimo 6 caracteres)" class="form-control" required="required"') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_passcf" class="col-sm-2 control-label col-xs-2">Confirmar a senha: *</label>
                  <div class="col-xs-6">
                      <?php echo form_password('user_passcf', '', 'placeholder="Confirmar Senha" class="form-control" required="required"') ?>
                  </div>
                </div>
                  <?php
                  $option = array();
                  $option[0] = 'Tipo de usuario';
                  foreach ($user_role as $value) {
                      if ($value->user_role_id > $this->session->userdata('user_role_id')) {
                          $option[$value->user_role_id] = $value->user_role_name;
                      }
                  }
                  ?>
                <div class="form-group">
                  <label for="user_role" class="col-sm-2 control-label col-xs-2">Permissão: *</label>
                  <div class="col-xs-6">
                      <?php echo form_dropdown('user_role', $option,'','class="form-control"') ?>
                  </div>
                </div>
              <?php
              $option = array();
              $option[0] = 'Cargo';
              foreach ($cargo as $cargos) {

                  $option[$cargos->idCargo] = $cargos->cargo;
                  // echo $cargos->idCargo; echo $cargos->cargo;
                      //  exit;
              }
              ?>
              <div class="form-group">
                  <label for="cargo" class="col-sm-2 control-label col-xs-2">Cargo: *</label>
                  <div class="col-xs-6">
                      <?php echo form_dropdown('cargo', $option,'','class="form-control"') ?>
                  </div>
              </div>
              <!-- Região em testes -->
              <div class="form-group">
                  <label for="cargo" class="col-sm-2 control-label col-xs-2">Região:</label>
                  <div class="col-xs-6">
                    <select class="form-control" id="regiao" name="regiao">
                      <option value="999" selected disabled>Escolha uma região:</option>
                      <option value="999">Sem região</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                    </select>
                  </div>
              </div>
                <div class="form-group">
                  <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                      <p class="text-muted">* Os campos obrigatórios.</p>
                  </label>
                </div>

                <div class="col-xs-offset-1 col-sm-offset-2 col-xs-4">
                    <button type="submit" class="btn btn-primary col-xs-6">Salvar</button>&nbsp;
                    <button type="reset" class="btn btn-default">Limpar</button>
                </div>

            <?php echo form_close() ?>
        </div>
      </div>
  </div>
</div>
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