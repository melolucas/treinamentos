<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
</div>
<div class="block"> 
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Lista de categorias </p></div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="example">
                    <thead>
                        <tr>
                            <th>Nome da Categoria</th>
                            <th class="hidden-xxs">Criado por</th>
                            <th class="hidden-xxs">Status</th>
                            <th class="col-sm-3" style="width: 27%">Açao</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    foreach ($categories as $category) { ?>
                        <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                            <td>
                                <a href="#" data-name="cat_name" data-type="text" data-url="<?php echo base_url('index.php/admin_control/update_category_name'); ?>" data-pk="<?=$category->category_id; ?>" class="data-modify-<?=$category->category_id; ?> no-style"><?=$category->category_name; ?></a>
                            </td>
                            <td class="hidden-xxs"><?php echo $category->user_name; ?></td>
                            <td class="hidden-xxs"><?php echo $category->category_active == 1 ? 'Ativo':'Inativo'; ?></td>
                            <td class="col-sm-3" style="width: 27%">
                            <div class="btn-group">
                                <a class="btn btn-default btn-sm modify" name="modify-<?=$category->category_id; ?>" href = "#"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Modificar </span></a>

                              <?php if ($category->category_active == 1) {?>  
                                    <a class="btn btn-default btn-sm" href = "<?php echo base_url('index.php/admin_control/mute_category/' . $category->category_id); ?>"><i class="glyphicon glyphicon-off"></i><span class="invisible-on-md">  Desativar </span></a>
                                <?php }else{ ?>
                                    <a class="btn btn-default btn-sm" href = "<?php echo base_url('index.php/admin_control/activate_category/' . $category->category_id); ?>"><i class="glyphicon glyphicon-check"></i><span class="invisible-on-md">  Ativar </span></a>
                                <?php } ?>

                                <a onclick="return delete_confirmation()" href = "<?php echo base_url('index.php/admin_control/delete_category/' . $category->category_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Deletar </span></a>
                            </div>
                            </td>
                        </tr>
                        <?php $i++;
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!--/span-->