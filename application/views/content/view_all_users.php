<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">


<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>
</div>
<?php 
$str = '[';
foreach ($user_role as $value) {
    if ($value->user_role_id != 1) {
        $str .= "{value:".$value->user_role_id.",text:'".$value->user_role_name." '},";
    }
}
$str = substr($str, 0, -1);
$str .= "]";
?>

</br></br>

<div class="block" style="margin-top: 1%;">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <ul class="nav nav-pills">         
                <li class=" pull-right"><a href="#student" data-toggle="pill">Estudante</a></li>
                <li class=" pull-right"><a href="#teacher" data-toggle="pill">Professor</a></li>
                <?php if ($this->session->userdata['user_role_id'] < 3) { ?>
                    <li class=" pull-right"><a href="#moderator" data-toggle="pill">Moderador</a></li>
                <?php } ?>
                <?php if ($this->session->userdata['user_role_id'] < 2) { ?>
                    <li class=" pull-right"><a href="#admin" data-toggle="pill">Admin</a></li>
                <?php } ?>
                <li class="active pull-right"><a href="#all" data-toggle="pill">Todos</a></li>
                <li class=" pull-left"><a data-toggle="modal" href="#" data-target="#modalCargos" style="background-color: #222222; color: white">Lista de cargos</a></li>                
            </ul>
        </div>
    </div>
    <div class="block-content">
    <div class="row">
    <div class="col-sm-12">
        <div class="tab-content">
        <?php if (isset($users) != NULL) { ?>
        <div class="tab-pane fade" id="teacher">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="users1">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hidden-xxs">CPF</th>
                        <th class="hidden-xxs">Telefone</th>
                        <th class="hidden-xxs">Cargo</th>
                        <th class="hidden-xxs">E-mail</th>
                        <th class="hidden-xxs">Região</th>
                        <th class="hidden-xxs">Permissão</th>
                        <th style="width: 30%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $i = 1;
                foreach ($users as $user) { 
                if (($user->active == 1) && ($user->banned == 0) && ($user->user_role_id == 4)) { ?>
                    <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                        <td>
                            <?=$user->user_name; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->cpf; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->user_phone; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->idCargo; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->user_email; ?>
                        </td>
                        <!-- Teste -->
                        <td class="hidden-xxs">
                            <?=$user->regiao; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->user_role_name; ?>
                        </td>
                        <td style="width: 30%">
                        <div class="btn-group">
                            <a class="btn btn-default btn-xs" href = "<?=base_url('index.php/user_control/modify_user/' .$user->user_id);?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-xs">  Modificar</span></a>
                            <a onclick="return ban_confirmation('<?=$user->user_name?>')"  class="btn btn-default btn-xs" href = "<?=base_url('index.php/user_control/ban_user_account/' . $user->user_id); ?>"><i class="glyphicon glyphicon-ban-circle"></i><span class="invisible-on-md">  Ban</span></a>
                            <a onclick="return deactivate_confirmation('<?=$user->user_name?>')" href = "<?php echo base_url('index.php/user_control/deactivate_user_account/' . $user->user_id); ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Desativar</span></a>
                        </div>
                        </td>
                    </tr>
                    <?php $i++;
                    }
                }?>
                </tbody>
            </table>
        </div>

        <?php if ($this->session->userdata['user_role_id'] < 2) { ?>

        <div class="tab-pane fade" id="admin">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="users2">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hidden-xxs">CPF</th>
                        <th class="hidden-xxs">Telefone</th>
                        <th class="hidden-xxs">Cargo</th>
                        <th class="hidden-xxs">Email</th>
                        <th class="hidden-xxs">Região</th> <!-- tESTE -->
                        <th class="hidden-xxs">Permissão</th>
                        <th style="width: 30%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $i = 1;
                    foreach ($users as $user) { 
                    if (($user->active == 1) && ($user->banned == 0) && ($user->user_role_id == 2)) { 
                ?>
                    <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                        <td>
                            <?=$user->user_name; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->user_phone; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->idCargo; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->user_phone; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->user_email; ?>
                        </td>
                        <!-- Teste -->
                        <td class="hidden-xxs">
                            <?=$user->regiao; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->user_role_name; ?>
                        </td>
                        <td style="width: 30%">
                        <div class="btn-group">
                            <a class="btn btn-default btn-xs" href = "<?=base_url('index.php/user_control/modify_user/' .$user->user_id);?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-xs">  Modificar</span></a>
                            <a onclick="return ban_confirmation('<?=$user->user_name?>')"  class="btn btn-default btn-xs" href = "<?=base_url('index.php/user_control/ban_user_account/' . $user->user_id); ?>"><i class="glyphicon glyphicon-ban-circle"></i><span class="invisible-on-md">  Ban</span></a>
                            <a onclick="return deactivate_confirmation('<?=$user->user_name?>')" href = "<?php echo base_url('index.php/user_control/deactivate_user_account/' . $user->user_id); ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Desativar</span></a>
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
        </div>
        <?php } ?>
        <div class="tab-pane fade" id="student">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="users3">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th class="hidden-xxs">CPF</th>
                    <th class="hidden-xxs">Telefone</th>
                    <th class="hidden-xxs">Cargo</th>
                    <th class="hidden-xxs">Email</th>
                    <th class="hidden-xxs">Região</th> <!-- tESTE -->
                    <th class="hidden-xxs">Permissão</th>
                    <th style="width: 30%">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                    foreach ($users as $user) { 
                    if (($user->active == 1) && ($user->banned == 0) && ($user->user_role_id == 5)) { 
                ?>
                <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                    <td>
                        <?=$user->user_name; ?>
                    </td>
                    <td class="hidden-xxs">
                        <?=$user->cpf; ?>
                    </td>
                    <td class="hidden-xxs">
                        <?=$user->user_phone; ?>
                    </td>
                    <td class="hidden-xxs">
                        <?=$user->idCargo; ?>
                    </td>
                    <td class="hidden-xxs">
                        <?=$user->user_email; ?>
                    </td>
                    <!-- Teste -->
                    <td class="hidden-xxs">
                            <?=$user->regiao; ?>
                        </td>
                    <td class="hidden-xxs">
                        <?=$user->user_role_name; ?>
                    </td>
                    <td style="width: 30%">
                    <div class="btn-group">
                        <a class="btn btn-default btn-xs" href = "<?=base_url('index.php/user_control/modify_user/' .$user->user_id);?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-xs">  Modificar</span></a>
                        <a onclick="return ban_confirmation('<?=$user->user_name?>')"  class="btn btn-default btn-xs" href = "<?=base_url('index.php/user_control/ban_user_account/' . $user->user_id); ?>"><i class="glyphicon glyphicon-ban-circle"></i><span class="invisible-on-md">  Ban</span></a>
                        <a onclick="return deactivate_confirmation('<?=$user->user_name?>')" href = "<?php echo base_url('index.php/user_control/deactivate_user_account/' . $user->user_id); ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Desativar</span></a>
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
        </div>
        <?php 
        if ($this->session->userdata['user_role_id'] < 3) { 
        ?>
        <div class="tab-pane fade" id="moderator">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="users4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="hidden-xxs">CPF</th>
                    <th class="hidden-xxs">Telefone</th>
                    <th class="hidden-xxs">Cargo</th>
                    <th class="hidden-xxs">E-mail</th>
                    <th class="hidden-xxs">Região</th> <!-- tESTE -->
                    <th class="hidden-xxs">Permissão</th>
                    <th style="width: 30%">Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            foreach ($users as $user) { 
               if (($user->active == 1) && ($user->banned == 0) && ($user->user_role_id == 3)) { ?>
                <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                    <td>
                        <?=$user->user_name; ?>
                    </td>
                    <td class="hidden-xxs">
                        <?=$user->cpf; ?>
                    </td>
                    <td class="hidden-xxs">
                        <?=$user->user_phone; ?>
                    </td>
                    <td class="hidden-xxs">
                        <?=$user->idCargo; ?>
                    </td>
                    <td class="hidden-xxs">
                        <?=$user->user_email; ?>
                    </td>
                    <!-- Teste -->
                    <td class="hidden-xxs">
                            <?=$user->regiao; ?>
                        </td>
                    <td class="hidden-xxs">
                        <?=$user->user_role_name; ?>
                    </td>
                    <td style="width: 30%">
                    <div class="btn-group">
                        <a class="btn btn-default btn-xs" href = "<?=base_url('index.php/user_control/modify_user/' .$user->user_id);?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-xs">  Modificar</span></a>
                        <a onclick="return ban_confirmation('<?=$user->user_name?>')"  class="btn btn-default btn-xs" href = "<?=base_url('index.php/user_control/ban_user_account/' . $user->user_id); ?>"><i class="glyphicon glyphicon-ban-circle"></i><span class="invisible-on-md">  Ban</span></a>
                        <a onclick="return deactivate_confirmation('<?=$user->user_name?>')" href = "<?php echo base_url('index.php/user_control/deactivate_user_account/' . $user->user_id); ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Desativar</span></a>
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
        </div>
        <?php } ?>
        <div class="tab-pane active fade in" id="all">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="users5">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hidden-xxs">CPF</th>
                        <th class="hidden-xxs">Telefone</th>
                        <th class="hidden-xxs">Cargo</th>
                        <th class="hidden-xxs">Email</th>
                        <th class="hidden-xxs">Região</th> <!-- tESTE -->
                        <th class="hidden-xxs">Permissão</th>
                        <th style="width: 30%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($users as $user) { 
                        if (($user->active == 1) && ($user->banned == 0) && ($user->user_role_id > $this->session->userdata['user_role_id'])) { 
                    ?>
                    <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                        <td>
                            <?=$user->user_name; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->cpf; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->user_phone; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->idCargo; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->user_email; ?>
                        </td>
                        <!-- Teste -->
                        <td class="hidden-xxs">
                            <?=$user->regiao; ?>
                        </td>
                        <td class="hidden-xxs">
                            <?=$user->user_role_name; ?>
                        </td>
                        <td style="width: 30%">
                        <div class="btn-group">
                            <a class="btn btn-default btn-xs" href = "<?=base_url('index.php/user_control/modify_user/' .$user->user_id);?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-xs">  Modificar</span></a>
                            <a onclick="return ban_confirmation('<?=$user->user_name?>')"  class="btn btn-default btn-xs" href = "<?=base_url('index.php/user_control/ban_user_account/' . $user->user_id); ?>"><i class="glyphicon glyphicon-ban-circle"></i><span class="invisible-on-md">  Ban</span></a>
                            <a onclick="return deactivate_confirmation('<?=$user->user_name?>')" href = "<?php echo base_url('index.php/user_control/deactivate_user_account/' . $user->user_id); ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Desativar</span></a>
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
        </div>       
        <?php
        } else {
            echo 'You have no mocks!';
        }
        ?>
        </div>
    </div>
    </div>
    </div>
</div><!--/span-->
<?php $this->load->view('plugin_scripts/user_ban_confirmation'); ?>

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
 