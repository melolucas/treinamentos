<?php //echo "<pre/>"; print_r($mock); exit(); ?>
<?php  if ($message)  echo $message; ?>
<?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Exame de atualização  </p></div>
    </div>
    <div class="block-content">
    <?=form_open_multipart(base_url('index.php/admin_control/update_exam/'.$mock->title_id), 'role="form" class="form-horizontal"'); ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="mock_title" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Título do Exame:</label>
                <div class=" col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'mock_title',
                        'placeholder' => 'Exam Title',
                        'id'          => 'mock_title',
                        'value'       => $mock->title_name,
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <?php $categories = $this->db->get('categories')->result();
            $option = array();
            foreach ($categories as $category) {
                $option[$category->category_id] = $category->category_name;
            }
            $sub_categories = $this->db->get('sub_categories')->result();
            $option2 = array();
            foreach ($sub_categories as $sub_cat) {
                if($sub_cat->cat_id == $mock->cat_id){
                    $option2[$sub_cat->id] = $sub_cat->sub_cat_name;
                }
            }
            ?>
            <div class="form-group">
                <label for="parent-category" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Selecione a Categoria:</label>
                <div class=" col-sm-4 col-xs-4">
                    <?php echo form_dropdown('parent-category', $option, $mock->cat_id, 'id="parent-category" class="form-control"') ?>
                </div>
                <div class=" col-sm-4 col-xs-4">
                    <?php echo form_dropdown('category', $option2, $mock->id, 'id="category" class="form-control"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_id" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Curso Associado:</label>
                <div class="col-sm-8 col-xs-7 col-mb">
                    <select name="course_id" class="form-control">
                        <option value="">Nenhum</option>
                        <?php $courses = $this->db->get('courses')->result();
                        foreach ($courses as $course) { ?>
                            <option value="<?=$course->course_id;?>" <?=($course->course_id == $mock->course_id)?'selected':'';?>><?=$course->course_title;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="syllabus" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Programa de Estudos:</label>
                <div class=" col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'mock_syllabus',
                        'id'          => 'syllabus',
                        'placeholder' => 'Syllabus ',
                        'value'       => $mock->syllabus,
                        'rows'        => '3',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required'
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="feature_image" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Imagem do recurso: </label>
                <div class=" col-sm-8 col-xs-7 col-mb">
                    <?php if (file_exists("exam-images/$mock->title_id.png")) { ?>
                        <img class="exam-thumbnail" src="<?=base_url("exam-images/$mock->title_id.png"); ?>" data-src="holder.js/300x300" alt="...">
                    <?php } ?>

                    <?=form_upload('feature_image', '', 'id="feature_image" class="form-control"') ?>
                    <p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Suggested types = jpg | png, max_width = 1024px, max_height = 768px.</p>
                </div>
            </div>
            <div class="form-group">
                <label for="passing_score" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Pontuação de aprovação:</label>
                <div class="col-sm-3 col-xs-6 col-mb">
                    <div class="input-group">
                      <?php echo form_input('passing_score', $mock->pass_mark, 'id="passing_score" placeholder="Passing Score" class="form-control" required="required"') ?>
                      <span class="input-group-addon"> % </span>
                    </div>            
                </div>
            </div>
            <div class="form-group">
                <label for="exam_price" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Preço:</label>
                <div class="col-sm-3 col-xs-6 col-mb">
                    <div class="input-group">
                      <?php echo form_input('price', $mock->exam_price, 'id="exam_price" placeholder="Exam Price" class="form-control"') ?>
                      <span class="input-group-addon"> <?=$currency_symbol?> </span>
                    </div>
                    <p class="help-block info"><i class="glyphicon glyphicon-warning-sign"></i> Digite 0 para teste gratuito.</p>
                </div>
            </div>
            <div class="form-group">
                <label for="public" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Público:</label>
                <div class="col-sm-3 col-xs-6 col-mb">
                    <select name="public" class="form-control">
                        <option value="1" <?=(1 == $mock->public)?'selected':'';?> >Sim</option>
                        <option value="0" <?=(0 == $mock->public)?'selected':'';?> >Não</option>
                    </select>
                </div>
                <p class="help-block info"><strong><i class="glyphicon glyphicon-warning-sign"></i> Se não, este exame não estará disponível na página do exame, mas pode ser relacionado com qualquer curso.  </strong></p>
            </div>
            <div class="form-group">
                <label for="timepicker1" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Tempo de duração:</label>
                <div class="col-sm-2 col-md-3 col-xs-6 col-mb">
                    <div class="input-group">
                      <?php echo form_input('duration', $mock->time_duration, 'id="timepicker1" placeholder="hh:mm:ss" class="form-control" required="required"') ?>
                      <span class="input-group-addon"> <i class="glyphicon glyphicon-time"></i> </span>
                    </div>            
                </div>
            </div>
            <div class="form-group">
                <label for="random_ques" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Total de perguntas aleatórias</label>
                <div class="col-sm-2 col-md-3 col-xs-6 col-mb">
                    <?php echo form_input('random_ques', $mock->random_ques_no, 'id="random_ques" placeholder="Numbers only" class="form-control" required="required"') ?>
                </div>
                <p class="help-block info"><i class="glyphicon glyphicon-warning-sign"></i> Número de perguntas para responder. Digite 0 para desativar aleatorização.</p>
                <p class="help-block info"><i class="glyphicon glyphicon-warning-sign"></i> Total de perguntas disponíveis <?=$ques_count;?></p>
            </div>

            <div class="form-group">
              <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                  <p class="text-muted"><i class="glyphicon glyphicon-info-sign"> </i>Todos os campos são necessários.</p>
              </label>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-sm-offset-3">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Atualizar</button>
                    <button type="reset" class="btn btn-warning col-sm-offset-1">Limpar</button>
                </div>
            </div>
            <br/>
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