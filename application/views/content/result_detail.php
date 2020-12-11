<div id="note">
    <?php 
    if ($message) {
        echo $message;    
    }
    ?>
</div>
<ol class="breadcrumb hidden-print">
    <li><a href="<?=base_url('index.php/dashboard/'.$this->session->userdata('user_id')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
    <li><a href="<?=base_url('index.php/exam_control/view_results')?>"><i class="fa fa-puzzle-piece"></i> Resultados</a></li> 
    <li class="active">Detalhe do resultado</li>
</ol>
<div class="container hidden-print">
    <p class="col-sm-1 col-sm-offset-9">    
        <a href="javascript:window.print()" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-print"></i>&nbsp; Impressão </a>
    </p>
</div>
<div class="container visible-print">
    <div class="result-head text-center ">
        <h3><?=$brand_name?></h3>
        <h4>Certificado</h4>
    </div>
</div>
<div class="result-info">
    <div class="row">
        <div class="col-sm-6 col-xs-6">
            <div class="panel panel-default">
                <div class="panel-body result-info-exam">
                    <h4>Detalhe do Exame:</h4>
                    <dl class="dl-horizontal">
                        <dt>Titulo: </dt>
                        <dd><?=$results->title_name?></dd>
                        <dt>Pergunta total: </dt>
                        <dd><?=$results->question_answered?></dd>
                        <dt>Pontuação de aprovação: </dt>
                        <dd><?=$results->pass_mark?>%</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-6">
            <div class="panel panel-default">
                <div class="panel-body result-info-user">
                    <h4>Detalhes do Estudante:</h4>
                    <dl class="dl-horizontal">
                        <dt>Nome: </dt>
                        <dd><?=$results->user_name?></dd>
                        <dt>Email: </dt>
                        <dd><?=$results->user_email?></dd>
                        <dt>Telefone: </dt>
                        <dd><?=$results->user_phone?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
    <h3 class="text-center">*** Resultado ***</h3>
    <div class="container">
        <dl class="dl-horizontal">
            <dt class="assessment">Avaliação: </dt>
            <dd>
                <blockquote>
                    <p class="lead">
                        <?=($results->result_percent >= $results->pass_mark) ? '<span class="label label-primary">Aprovado</span>' : '<span class="label label-warning">Reprovado</span>' ?>
                    </p>
                </blockquote>
            <dd>
        </dl>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="result-score">
                <p><?=$results->user_name?> Pontuação (<?=$results->result_percent?>%)</p>
            </div>
            <div class="progress progress-striped">
                <div class="progress-bar progress-bar-<?=($results->result_percent >= $results->pass_mark)?'success':'danger'?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$results->result_percent?>%">
                    <span class="sr-only"><?=$results->result_percent?>% Completo (sucesso)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="result-score">
                <p>Pontuação necesaria (<?=$results->pass_mark?>%)</p>
            </div>
            <div class="progress progress-striped">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$results->pass_mark?>%">
                    <span class="sr-only"><?=$results->pass_mark?>% Completo (sucesso)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container sign-panel visible-print">
        <div class="col-xs-offset-1 col-xs-5">
            <h4 class="text-center">Assinatura <?=$brand_name?></h4>
        </div>
        <div class="col-xs-push-1 col-xs-5">
            <h4 class="text-center">Estudante de assinatura</h4>
        </div>
    </div>
</div>
<div class="container">
    <p class="result-note"><strong>Observação: </strong>Este certificado é válido somente nos termos e condições de <?=$brand_name?>.</p>
</div>
<link href="<?php echo base_url('assets/css/print-result.css') ?>" rel="stylesheet" media="print">
