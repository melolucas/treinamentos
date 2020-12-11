<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

<style>

.cardEad{
    background-color: grey;
    color: white;
    border: 1px solid white;
    padding-top: 1%;
}

</style>

<div class="container" style="margin-top: 4%; margin-left: 14%">
    <!-- <div class="row">
        <div class="col-md-12" style="text-align: center; background-color: grey; color: white; border: 1px solid white">
            <h3>Relatório:</h3>
        </div>
    </div>    -->

    <!-- Médias -->
    <?php     
        $mediaAprovados = ($countAprovados->aprovados / $countAvaliados->avaliados) * 100;
        $mediaReprovados = ($countReprovados->reprovados / $countAvaliados->avaliados) * 100;

        $number = $mediaAprovados;
        $mediaAprovados = number_format($number, 2);

        $numberdois = $mediaReprovados;
        $mediaReprovados = number_format($numberdois, 2);
    ?>

    <center>
    <div class="row">
                
        <!-- <div class="col-md-3 cardEad">
            <p class="" style="text-align: right;">Alunos avaliados:<br> <h4 style="text-align: right"><?php echo $countAvaliados->avaliados; ?></h4></p>
        </div> -->
        <div class="col-lg-3 col-md-6">
            <a href="#" onclick="alert('A tabela abaixo mostra todos os alunos avaliados.')">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-book fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo $countAvaliados->avaliados; ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Alunos avaliados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- <div class="col-md-3 cardEad">
        <i class="far fa-thumbs-down"></i>
            <p class="" style="text-align: right;">Alunos aprovados:<br> <h4 style="text-align: right"><a href="#" class="" data-toggle="modal" data-target="#mAprovados" style="text-decoration: none; color: white"><?php echo $countAprovados->aprovados;?> (<?= $mediaAprovados; ?>%)</a></h4></p> 
        </div> -->
        <div class="col-lg-3 col-md-6">
            <a href="#" data-toggle="modal" data-target="#mAprovados">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-thumbs-up fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo $countAprovados->aprovados; ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Alunos aprovados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- <div class="col-md-3 cardEad">
            <p class="" style="text-align: right;">Alunos reprovados:<br> <h4 style="text-align: right"><a href="#" class="" data-toggle="modal" data-target="#mReprovados" style="text-decoration: none; color: white"><?php echo $countReprovados->reprovados ?> (<?= $mediaReprovados; ?>%)</a></h4></p> 
        </div> -->
        <div class="col-lg-3 col-md-6">
            <a href="#" data-toggle="modal" data-target="#mReprovados">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-thumbs-down fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo $countReprovados->reprovados; ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Alunos Reprovados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- <div class="col-md-3 cardEad">
            <p class="" style="text-align: right;">Não fizeram:<br> <h4 style="text-align: right"><a href="#" class="" data-toggle="modal" data-target="#naoFizeram" style="text-decoration: none; color: white"><?php echo $naoFizeram->naoFizeram; ?></a></h4></p> 
        </div> -->
        <div class="col-lg-3 col-md-6">
            <a href="#" data-toggle="modal" data-target="#naoFizeram">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-times-circle fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo $naoFizeram->naoFizeram; ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Não fizeram</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
    </div>
    </center>

   <div class="row">
       <div class="cold-md-12">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="users1">
                <thead>
                    <tr>                        
                        <th style="text-align: center;" >NOME</th>
                        <th style="text-align: center;" class="hidden-xxs">CARGO</th>
                        <th style="text-align: center;" class="hidden-xxs">CURSO</th>
                        <th style="text-align: center;" class="hidden-xxs">NOTA</th>
                        <th style="text-align: center;" class="hidden-xxs">REGIÃO</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($relTotal as $relatorio) {                         
                    ?>
                    <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                        <td >
                            <?=$relatorio->Nome; ?>
                        </td>                        
                        <td class="hidden-xxs">
                            <?=$relatorio->Cargo; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$relatorio->Curso; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$relatorio->nota; ?>
                        </td>
                        <!-- Teste -->
                        <td class="hidden-xxs">
                            <?=$relatorio->Regiao; ?>
                        </td> 
                    </tr>
                    <?php                         
                        }
                    ?>
                </tbody>
            </table>
       </div>
   </div>
</div>

<!-- modal -->
<!-- Não fizeram a prova -->
<div class="modal" id="naoFizeram" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Alunos que não fizeram a prova:</h4>
        
      </div>
      <div class="modal-body">        
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="users1">
            <thead>
                <tr>                        
                    <th style="text-align: center;" >NOME</th>
                    <th style="text-align: center;" class="hidden-xxs">CARGO</th>                      
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($modalNaoFizeram as $relatorio) {                         
                ?>
                <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                    <td >
                        <?=$relatorio->Nome; ?>
                    </td>                        
                    <td class="hidden-xxs">
                        <?=$relatorio->Cargo; ?>
                    </td>
                </tr>
                <?php                         
                    }
                ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Reprovados -->
<div class="modal" id="mReprovados" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Alunos reprovados: <?= $mediaReprovados; ?>%</h4>
        
        </div>
        <div class="modal-body">        
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="users1">
                <thead>
                    <tr>                        
                        <th style="text-align: center;" >NOME</th>
                        <th style="text-align: center;" class="hidden-xxs">CARGO</th>                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($modalReprovados as $relatorios) {                         
                    ?>
                    <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                        <td >
                            <?=$relatorios->Nome; ?>
                        </td>                        
                        <td class="hidden-xxs">
                            <?=$relatorios->Cargo; ?>
                        </td>
                    </tr>
                    <?php                         
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">        
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
    </div>
  </div>
</div>

<!-- Aprovados -->
<div class="modal" id="mAprovados" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Alunos Aprovados: <?= $mediaAprovados; ?>%</h4>
        
        </div>
        <div class="modal-body">        
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="users1">
                <thead>
                    <tr>                        
                        <th style="text-align: center;" >NOME</th>
                        <th style="text-align: center;" class="hidden-xxs">CARGO</th>                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($modalAprovados as $relatorios) {                         
                    ?>
                    <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                        <td >
                            <?=$relatorios->Nome; ?>
                        </td>                        
                        <td class="hidden-xxs">
                            <?=$relatorios->Cargo; ?>
                        </td>
                    </tr>
                    <?php                         
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">        
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
    </div>
  </div>
</div>

<!-- Tradução dataTables -->
<script>
$('.table').DataTable(
    {
        "bJQueryUI": true,
        "oLanguage": {
            "sProcessing":   "Processando...",
            "sLengthMenu":   "Mostrar _MENU_ registros",
            "sZeroRecords":  "Não foram encontrados resultados",
            "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix":  "",
            "sSearch":       "Buscar:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Seguinte",
                "sLast":     "Último"
            }
        }
    }
);
</script>
