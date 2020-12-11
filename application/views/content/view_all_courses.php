<?php //echo "<pre/>"; print_r($courses); exit(); ?>
<div id="note">
    <?php if ($message) echo $message; ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
</div>
<br><br>



<div class="block" style="margin-top: 1%;">  
    <div class="navbar block-inner block-header">
        <div class="row">            
            <div>
                <ul class="nav nav-pills" style="margin-right: 1%;">                    
                    <li class=" pull-right"><a data-toggle="modal" href="#" data-target="#modalCargos" style="background-color: #222222; color: white">Lista de cargos</a></li>                
                </ul>
            </div>            
        </div>
    </div>
    <div class="block-content">
    <div class="row">
    <div class="col-sm-12">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead>
                <tr>
                    <th>Título do curso</th>
                    <th>Açao</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($courses as $course) {
         //   var_dump($course);die;

                ?>
                <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                    <td>
                        <p class="lead"><?=$course->course_title?>
                        </p>
                        <span class="text-muted">Categoria: </span> <?=$course->category_name; ?>
                        &nbsp;
                        <span class="text-muted">Sub-categoria: </span> <?=$course->sub_cat_name; ?>
                        &nbsp;
                        <span class="text-muted">Cargos: </span>
                        <?= $cargos = $course->idCargo;


                        ?>

                        <span class="pull-right">
                            <span class="text-muted">Autor: </span>
                            <?php echo $course->user_name; ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-success btn-sm" href = "<?= base_url('index.php/course/course_detail/' . $course->course_id); ?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Ver Seções</span></a>
                            <a class="btn btn-primary btn-sm" href = "<?= base_url('index.php/course/edit_course_detail/' . $course->course_id); ?>"><i class="glyphicon glyphicon-eye-open"></i><span class="invisible-on-md">  Ver detalhes</span></a>
                            <a onclick="return delete_confirmation()" href = "<?php echo base_url('index.php/course/delete_course/' . $course->course_id); ?>" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Excluir</span></a>
                        </div>
                    </td>
                </tr>
                <?php
                $i++;
             //   die;
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
</div><!--/span-->

<!-- Modal -->
<div class="modal fade" id="modalCargos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cargos:</h5>        
      </div>
      <div class="modal-body">         
        <li>1 - Supervisor</li>
        <li>2 - Gerente</li>
        <li>3 - Gerente Farmacêutico</li>
        <li>4 - Subgerente</li>
        <li>5 - Subgerente Farmacêutico</li>
        <li>6 - Assistente de Loja</li>
        <li>7 - Atendente de Farmácia</li>
        <li>8 - Estoquista</li>
        <li>9 - Fiscal de Loja</li>
        <li>10 - Farmacêutico</li>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

