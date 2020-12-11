<?php //echo "<pre/>"; print_r($courses); exit(); ?>
<?php  if ($message)  echo $message; ?>
<?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Criar novo curso </p></div>
    </div>
    <div class="block-content">
    <?=form_open_multipart(base_url('index.php/course/update_course/'.$courses->course_id), 'role="form" class="form-horizontal"'); ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="row">
            <?php $categories = $this->db->get('categories')->result();
            $option = array();
            foreach ($categories as $category) {
                if ($category->active) {
                    $option[$category->category_id] = $category->category_name;
                }
            }
            $sub_categories = $this->db->get('sub_categories')->result();
            $option2 = array();
            foreach ($sub_categories as $sub_cat) {
                if($sub_cat->cat_id == $courses->cat_id){
                    $option2[$sub_cat->id] = $sub_cat->sub_cat_name;
                }
            }
            ?>
            <div class="form-group">
                <label for="parent-category" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Selecione a Categoria:</label>
                <div class="col-lg-3 col-sm-4 col-xs-4">
                    <?php echo form_dropdown('parent-category', $option, $courses->cat_id, 'id="parent-category" class="form-control"') ?>
                </div>
                <div class="col-lg-3 col-sm-4 col-xs-4">
                    <?php echo form_dropdown('category', $option2, $courses->id, 'id="category" class="form-control"') ?>
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
            <div class="form-group">
                <label for="course_title" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Título do curso:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'course_title',
                        'placeholder' => 'Course Title',
                        'id'          => 'course_title',
                        'value'       => $courses->course_title,
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
                        'placeholder' => 'Course Introduction',
                        'id'          => 'course_intro',
                        'value'       => $courses->course_intro,
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
                        'placeholder' => 'Course Description',
                        'id'          => 'course_description',
                        'value'       => $courses->course_description,
                        'rows'        => '3',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_requirement" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Requisito do Curso:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'course_requirement',
                        'placeholder' => 'Course Requirements',
                        'id'          => 'course_requirement',
                        'value'       => $courses->course_requirement,
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_description" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Público-alvo:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'target_audience',
                        'placeholder' => 'Target Audience',
                        'id'          => 'target_audience',
                        'value'       => $courses->target_audience,
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="what_i_get" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">O que eu ganho?:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'what_i_get',
                        'placeholder' => 'What skill user will learn from this course?',
                        'id'          => 'what_i_get',
                        'value'       => $courses->what_i_get,
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="feature_image" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Imagem do recurso: </label>
                <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                    <?php if (file_exists("course-images/$courses->course_id.png")) { ?>
                        <img class="exam-thumbnail" src="<?=base_url("course-images/$courses->course_id.png"); ?>" data-src="holder.js/300x300" alt="...">
                    <?php } ?>

                    <?=form_upload('feature_image', '', 'id="feature_image" class="form-control"') ?>
                    <p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Suggested types = jpg | png, max_width = 1024px, max_height = 768px.</p>

                </div>
            </div>
            <div class="form-group">
                <label for="Course_price" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Preço:</label>
                <div class="col-sm-3 col-xs-6 col-mb">
                    <div class="input-group">
                      <?php echo form_input('price', $courses->course_price, 'id="Course_price" placeholder="Course Price" class="form-control" required="required"') ?>
                      <span class="input-group-addon"> <?=$currency_symbol?> </span>
                    </div>
                    <p class="help-block info"><i class="glyphicon glyphicon-warning-sign"></i> Digite 0 para curso gratuito.</p>
                </div>
            </div>
            <div class="form-group">
              <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                  <p class="text-muted"><i class="glyphicon glyphicon-info-sign"> </i> Todos os campos são necessários.</p>
              </label>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Salvar</button>
                    <button type="reset" class="btn btn-warning col-xs-offset-1">Limpar</button>
                </div>
            </div>
            <?=form_close(); ?>
        </div>
    </div>
    </div>
    </div>
</div>
<?php include('application/views/plugin_scripts/bootstrap-wysihtml5.php');?>

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