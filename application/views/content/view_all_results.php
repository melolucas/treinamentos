<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">


<div id="note"> <?php if ($message) echo $message; 
        date_default_timezone_set($this->session->userdata['time_zone']);
?> </div>

<div class="block"> 
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Resultados </p></div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <?php if (isset($results) != NULL) { ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="exames">
                        <thead>
                            <tr>
                                <td class="hidden">1</td>
                                <th>Nome do estudante</th>
                                <th>Exame</th>
                                <th class="hidden-xxs">Avaliação</th>
                                <th class="hidden-xxs">Ponto</th>
                                <th class="hidden-xs">Data</th>
                                <th class="text-center" style=" width: 10%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($results as $result) {
                                ?>
                                <?php if (($result->exam_title_user_id == $this->session->userdata('user_id')) OR ($this->session->userdata('user_role_id') <= 3)) { ?>
                                    <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                        <td class="hidden">1</td>
                                        <td><?= $result->user_name; ?></td>
                                        <td><?= $result->title_name; ?></td>
                                        <td class="hidden-xxs"><?= ($result->result_percent >= $result->pass_mark) ? '<span class="label label-primary">Aprovado</span>' : '<span class="label label-warning">Reprovado</span>' ?></td>
                                        <td class="hidden-xxs"><?php echo $result->result_percent; ?>%</td>
                                        <td class="hidden-xs"><?= date(" d M", strtotime($result->exam_taken_date)); ?></td>
                                        <td class="text-center" style=" width: 17%">
                                            <div class="btn-group">
                                                <a class="btn btn-default btn-xs" href = "<?= base_url('index.php/exam_control/view_exam_detail/' . $result->result_id); ?>"><i class="glyphicon glyphicon-list-alt"></i> Detales</a>
                                                <a class="btn btn-default btn-xs" href = "<?= base_url('index.php/exam_control/view_result_detail/' . $result->result_id); ?>"><i class="glyphicon glyphicon-file"></i> Certificado</a>
                                                <?php if ($this->session->userdata['user_role_id'] < 3) { ?>
                                                <a onclick="return delete_confirmation()" href = "<?= base_url('index.php/exam_control/delete_results/' . $result->result_id); ?>" class="btn btn-xs btn-default" ><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete </span></a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo 'No results!';
                }
                ?>
            </div>
        </div>
    </div>
</div><!--/span-->

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