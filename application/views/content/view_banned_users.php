<br><br>
<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
</div>
<div class="block" style="margin-top: 1%;">  
    <div class="navbar block-inner block-header" style="margin-right: 1%;">
        <div class="row" >
            <ul class="nav nav-pills">
                <li><p class="text-muted">Lista de usuários </p></li>
                <li class=" pull-right"><a href="#inactive" data-toggle="pill">Inativo</a></li>
                <li class="active pull-right"><a href="#banned" data-toggle="pill"> Banido </a></li>
            </ul>
        </div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="tab-content">
                    <?php 
                    if (isset($users) != NULL) { 
                    ?>
                        <div class="tab-pane fade" id="inactive">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="example">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th class="hidden-xxs">Telefone</th>
                                        <th class="hidden-xxs">Email</th>
                                        <th class="hidden-xxs">Permissão</th>
                                        <th style="width: 22%">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($users as $user) {
                                        if (($user->active == 0) && ($user->user_role_id > $this->session->userdata['user_role_id'])) {
                                            ?>
                                            <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                                <td><?= $user->user_name; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_phone; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_email; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_role_name; ?></td>
                                                <td style=" width: 13%">
                                                    <a onclick="return are_you_sure()" class="btn btn-primary" href = "<?php echo base_url('index.php/user_control/activate_user_account/' . $user->user_id); ?>"><i class="glyphicon glyphicon-check"></i><span class="invisible-on-md">  Ativar </span></a>
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
                        <div class="tab-pane active fade in" id="banned">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="example">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th class="hidden-xxs">Telefone</th>
                                        <th class="hidden-xxs">Email</th>
                                        <th class="hidden-xxs">Permissão</th>
                                        <th style="width: 22%">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                foreach ($users as $user) {
                                    if (($user->banned == 1) && ($user->user_role_id > $this->session->userdata['user_role_id'])) {
                                        ?>
                                            <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                                <td><?= $user->user_name; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_phone; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_email; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_role_name; ?></td>
                                                <td style=" width: 13%">
                                                    <a onclick="return alert('Você tem certeza?')" class="btn btn-primary" href = "<?php echo base_url('index.php/user_control/unban_user_account/' . $user->user_id); ?>"><i class="glyphicon glyphicon-check"></i><span class="invisible-on-md">  Anular </span></a>
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
<?php $this->load->view('plugin_scripts/are_you_sure'); ?>
 