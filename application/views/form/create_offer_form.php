<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>
<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted">Novas Ofertas</p>
        </div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <?php echo form_open(base_url() . 'index.php/membership/save', 'role="form" class="form-horizontal"'); ?>
                <div class="form-group">
                  <label for="membership_type" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Membership Type:*</label>
                  <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                    <?php echo form_input('membership_type', set_value('membership_type'), 'placeholder="Membership title" id="membership_type" class="form-control" required="required"') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="validity_period" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Período de validade:*</label>
                  <div class="col-lg-3 col-sm-4 col-xs-4 col-mb">
                    <?php echo form_input('validity_period', set_value('validity_period'), 'placeholder="Validity period" id="validity_period" class="form-control" required="required"') ?>
                  </div>
                  <div class="col-sm-2 col-xs-2">
                      <?php
                      $option = array(
                        'months' => 'Month',
                        'years' => 'Year',
                        'days' => 'Day');
                      ?>
                      <?php echo form_dropdown('validity_type', $option, '','class="form-control"') ?>
                  </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Preço:*</label>
                    <div class="col-sm-3 col-xs-6 col-mb">
                        <div class="input-group">
                          <?php echo form_input('price', '', 'id="price" placeholder="Price" class="form-control" required="required"') ?>
                          <span class="input-group-addon"> <?=$currency_symbol?> </span>
                        </div>            
                    </div>
                </div>
                <div class="form-group">
                    <label for="feature_1" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Característica 1:*</label>
                    <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                      <?php 
                        $data = array(
                            'name'        => 'feature[]',
                            'placeholder' => 'feature 1',
                            'id'          => 'feature_1',
                            'value'       => '',
                            'rows'        => '2',
                            'class'       => 'form-control textarea-wysihtml5',
                            'required' => 'required',
                        ); ?>
                        <?php echo form_textarea($data) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="feature_2" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Característica 2:</label>
                    <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                      <?php 
                        $data = array(
                            'name'        => 'feature[]',
                            'placeholder' => 'feature 2',
                            'id'          => 'feature_2',
                            'value'       => '',
                            'rows'        => '2',
                            'class'       => 'form-control textarea-wysihtml5',
                        ); ?>
                        <?php echo form_textarea($data) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="feature_3" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Característica 3:</label>
                    <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                      <?php 
                        $data = array(
                            'name'        => 'feature[]',
                            'placeholder' => 'feature 3',
                            'id'          => 'feature_3',
                            'value'       => '',
                            'rows'        => '2',
                            'class'       => 'form-control textarea-wysihtml5',
                        ); ?>
                        <?php echo form_textarea($data) ?>
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

<?php include 'application/views/plugin_scripts/bootstrap-wysihtml5.php';?>
    
