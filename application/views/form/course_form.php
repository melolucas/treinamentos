<?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
<!-- block -->
<br><br><br>
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Criar novo curso </p></div>
    </div>
    <div class="block-content">
    <?=form_open_multipart(base_url('index.php/course/save_course'), 'role="form" class="form-horizontal"'); ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="row">
            <?php
            $option = array();
            $option[''] = 'Selecione a Categoria';
            foreach ($categories as $category) {
                if ($category->active) {
                    $option[$category->category_id] = $category->category_name;
                }
            }
            ?>
            <div class="form-group">
                <label for="parent-category" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Selecione a Categoria:</label>
                <div class="col-lg-3 col-sm-4 col-xs-4">
                    <?php echo form_dropdown('parent-category', $option,'', 'id="parent-category" class="form-control"') ?>
                </div>
                <div class="col-lg-3 col-sm-4 col-xs-4">
                    <select name="category" id="category" class="form-control">
                        <option>Sub-categoria</option>
                    </select>
                </div>
            </div>
            <div class="form-group">

                <label for="course_title" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Cargos do curso:</label>

                <select name="cargo[]" class="selectpicker" multiple>
                    <?php
                    $option = array();
                    $option[''] = 'Selecione a Categoria';
                    foreach ($cargo as $cargos) {

                        ?>

                    <option value="<?php echo $cargos->idCargo ?>" > <?php echo $cargos->cargo ?> </option>

                    <?php } ?>
                </select>

            </div>
        </div>

            <div class="form-group">
                <label for="course_title" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Título do curso:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'course_title',
                        'placeholder' => 'Titulo do Curso  ',
                        'id'          => 'course_title',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_intro" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Introdução ao curso:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'course_intro',
                        'placeholder' => 'Conteudo do Curso',
                        'id'          => 'course_intro',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_description" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Descrição do Curso:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'course_description',
                        'placeholder' => 'Descrição do Curso',
                        'id'          => 'course_description',
                        'value'       => '',
                        'rows'        => '3',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_requirement" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Quem pode fazer o Curso:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'course_requirement',
                        'placeholder' => 'Para quem é o curso',
                        'id'          => 'course_requirement',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_description" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Publico Alvo:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'target_audience',
                        'placeholder' => 'Publico Alvo',
                        'id'          => 'target_audience',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="what_i_get" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">O que eu Ganho?:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'what_i_get',
                        'placeholder' => 'Que habilidade o usuário aprenderá com este curso?',
                        'id'          => 'what_i_get',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="feature_image" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Imagem do Curso: </label>
                <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                    <?=form_upload('feature_image', '', 'id="feature_image" class="form-control"') ?>
                    <p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Sugestão de tipos = jpg | png, largura maxima= 1024px, altura maxima = 768px.</p>
                </div>
            </div>
<!--            <div class="form-group">-->
<!--                <label for="Course_price" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Price:</label>-->
<!--                <div class="col-sm-3 col-xs-6 col-mb">-->
<!--                    <div class="input-group">-->
<!--                      --><?php //echo form_input('price', '', 'id="Course_price" placeholder="Course Price" class="form-control" required="required"') ?>
<!--                      <span class="input-group-addon"> --><?//=$currency_symbol?><!-- </span>-->
<!--                    </div>-->
<!--                    <p class="help-block info"><i class="glyphicon glyphicon-warning-sign"></i> Digite 0 para curso gratuito.</p>-->
<!--                </div>-->
<!--            </div>-->
            <div class="form-group">
              <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                  <p class="text-muted"><i class="glyphicon glyphicon-info-sign"> </i> Todos os campos são necessários.</p>
              </label>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Proximo</button>
                    <button type="reset" class="btn btn-warning col-xs-offset-1">Restabelecer</button>
                </div>
            </div>
            <?=form_close(); ?>
        </div>
    </div>
    </div>
    </div>
</div>
<?php include 'application/views/plugin_scripts/bootstrap-wysihtml5.php';?>

<script>
$('select#parent-category').change(function() {

    var category = $(this).val();
    var link = '<?php echo base_url()?>'+'index.php/admin_control/get_subcategories_ajax/'+category;
    $.ajax({
        data: category,
        url: link
    }).done(function(subcategories) {

        console.log(subcategories);
        $('#category').html(subcategories);
    });
});
</script>