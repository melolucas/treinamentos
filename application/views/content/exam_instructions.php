<?php $user_info = $this->db->get_where('users', array('user_id' => $this->session->userdata('user_id')))->row();?>
<section id="exam_summery">
    <div class="container">
        <div class="box">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <noscript><div class="alert alert-danger">O seu navegador não suporta JavaScript ou o JavaScript está desabilitado! Use o navegador habilitado para JavaScript para fazer este exame.</div></noscript>
                    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
                    <?=(isset($message)) ? $message : ''; ?>
                </div>
                <div class="col-md-10 col-sm-12 col-md-offset-1 col-sm-offset-0">
                    <ol class="breadcrumb hidden-print">
                        <?php if ($this->session->userdata('log')) { ?>
                            <li><a href="<?= base_url('index.php/dashboard/' . $this->session->userdata('user_id')); ?>"><i class="fa fa-dashboard"></i> Painel</a></li> 
                        <?php } ?>
                        <li><a href="<?= base_url('index.php/exam_control/view_all_mocks') ?>"><i class="fa fa-puzzle-piece"></i> Exames</a></li> 
                        <li><a href="<?=base_url('index.php/exam_control/view_exam_summery/' . $mock->title_id) ?>"><i class="fa fa-tasks"></i> Resumo do exame</a></li> 
                        <li class="active">Instruções de exame</li>
                    </ol>
                    <div class="big-gap"></div>
                    <h3><span class="text-muted">Exame Titulo: </span> <?= $mock->title_name ?></h3>

                    <h3 class="text-muted">Requisitos:</h3>
                    <p class="">
                        <ul>
                            <li>Você precisa do navegador habilitado para javascript para fazer este exame.</li>
                            <li>Use o navegador mais recente para ter a melhor experiência.</li>
                        </ul>
                    </p>
                    <h3 class="text-muted">Instruções:</h3>
                    <p class="">
                        <div class="well well-sm">
                            <ul>
                                <li>Cada pergunta tem entre 2 e 8 opções. Você deve escolher uma ou mais respostas corretas.</li>
                                <li>Não há penalidades para respostas incorretas. Por favor, tente todas as perguntas.</li>
                                <li>Você pode revisar e alterar suas respostas antes do envio final.</li>
                                <li>Não há marcação parcial! Se alguma questão tiver mais de uma resposta correta, você marca todas as respostas corretas </li>
                                <li>As perguntas não respondidas serão contabilizadas como respostas erradas.</li>
                                <li>Você deve responder a todas as perguntas antes da duração indicada no topo.</li>
                                <li>Você não pode retomar o exame.</li>
                            </ul>
                        </div>
                    </p>

                    <div class="big-gap"></div>


                    <?php 
                    if ($this->session->userdata('log')) { 
                        if ($mock->exam_price) {
                            if (($this->session->userdata('log')) && ($user_info->subscription_id != 0) && ($user_info->subscription_end > now())) {
                                $payment_info = 'start_exam';
                            }else{
                                $payment_info = 'payment_process'; 
                            }
                        }else{
                            $payment_info = 'start_exam';
                        }
                    ?>
                        <a href="<?=base_url('index.php/exam_control/'.$payment_info.'/'.$mock->title_id) ?>" class="btn btn-success col-xs-5"> <?php echo ($payment_info == 'payment_process')?'Pay with PayPal':'Iniciar Exame' ?></a>

                    <?php
                    }else{
                    ?>
                        <a href="<?=base_url('index.php/exam_control/view_exam_instructions/'.$mock->title_id);?>" class="btn btn-primary"> Login para Iniciar </a>
                    <?php 
                    } ?>

                    <div class="big-gap"><br/></div>
                    <p class="result-note"><strong>Observação: </strong>O valor deste certificado de exame é válido somente nos termos e condições de <?= $brand_name ?>.</p>

                </div>
            </div>
        </div> 
    </div>
</section><!--/#pricing-->

<script>
$(document).ready(function() {
   $("#start-exam").removeAttr("disabled");
})    
</script>
<script language="JavaScript"><!--
javascript:window.history.forward(1);
//--></script>