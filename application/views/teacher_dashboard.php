<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> <?=$title; ?></li>
        </ol>
        <?php
        if ($message) {
            echo $message;
        }
        ?>
    </div>
</div><!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i> Visão geral</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="<?=base_url('index.php/mocks');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <i class="fa fa-puzzle-piece fa-5x"></i>
                                        </div>
                                        <div class="col-xs-6 text-center">
                                            <p class="dashboard-heading"><?=$total_exam;?></p>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Exames totais</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?=base_url('index.php/exam_control/view_results');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-6 text-center">
                                            <p class="dashboard-heading"><?=$exam_taken_new;?></p>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Novos participantes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?=base_url('index.php/exam_control/view_results');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <i class="fa fa-bookmark-o fa-5x"></i>
                                        </div>
                                        <div class="col-xs-6 text-center">
                                            <p class="dashboard-heading"><?=$exam_taken;?></p>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Participantes totais</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div><!-- /.row -->
            </div>
        </div>
    </div>
</div><!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-cogs"></i> Configurações</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="<?=base_url('index.php/admin_control');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Configurações de perfil</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?=base_url('index.php/create_mock');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <i class="fa fa-puzzle-piece fa-5x"></i>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Criar exame</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?=base_url('index.php/create_category');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <i class="fa fa-sitemap fa-5x"></i>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Criar categoria</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div><!-- /.row -->
            </div>
        </div>
    </div>
</div><!-- /.row -->