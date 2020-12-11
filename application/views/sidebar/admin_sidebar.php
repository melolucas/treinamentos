<!-- \ css class control -->
<?php
if (isset($class)) {
    $active = floor($class/10); //The numeric value to round
}
?>
<!-- \ Sidebar -->
<ul class="nav sidebar" style="margin-top: -2px;">
    <li>
        <a href="<?=base_url('index.php/dashboard/'.$this->session->userdata('user_id')); ?>">
            <i class="fa fa-dashboard"></i> Painel
        </a>
    </li>
    <?php if ($this->session->userdata['user_role_id'] <= 3) { ?>
    <li><a href="#" class="sub <?=($active==1)?"active":'';?>"><i class="fa fa-user"> </i> Controle de usuário</a>
        <ul>
            <li><a href="<?=base_url('index.php/user_control');?>" class="<?=($class==11)?"current":'';?>">Ver usuários</a></li>
            <li><a href="<?=base_url('index.php/user_control/add_user');?>" class="<?=($class==12)?"current":'';?>">Add Novo usuário</a></li>
            <li><a href="<?=base_url('index.php/user_control/view_banned_users');?>" class="<?=($class==13)?"current":'';?>">Banned / Usuários Inativos</a></li><br>
        </ul>
    </li>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] <= 4) { ?>
    <li><a href="#" class="sub <?=($active==9)?"active":'';?>"><i class="fa fa-book"></i> Controle do Curso</a>
        <!-- Controle do curso -->
        <ul>
            <li><a href="<?=base_url('index.php/course/view_all_courses');?>" class="<?=($class==91)?"current":'';?>">Ver Cursos</a></li>
            <li><a href="<?=base_url('index.php/course/create_course');?>" class="<?=($class==92)?"current":'';?>">Criar Curso</a></li>
        </ul>
        <!-- Relatórios -->
        <a href="#" class="sub <?=($active==10)?"active":'';?>"><i class="fa fa-eye"></i> Relatórios</a>
        <ul>
            <li><a href="<?=base_url('index.php/relatoriosEad');?>" class="<?=($class==101)?"current":'';?>">Por região</a></li>
        </ul>
    </li>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] <= 4) { ?>
    <li><a href="#" class="sub <?=($active==2)?"active":'';?>"><i class="fa fa-bullseye"></i> Controle de exames</a>
        <ul>
            <li><a href="<?=base_url('index.php/mocks');?>" class="<?=($class==21)?"current":'';?>">Visualizar Exames</a></li>
            <li><a href="<?=base_url('index.php/admin_control/create_exam');?>" class="<?=($class==22)?"current":'';?>">Criar exame</a></li>
            <li><a href="<?=base_url('index.php/exam_control/view_results');?>" class="<?=($class==25)?"current":'';?>">Ver resultados</a></li>
        </ul>
    </li>
    <?php } else { ?>
        <li><a href="<?=base_url('index.php/exam_control/view_results');?>" class="<?=($active==2)?"active":'';?>"><i class="fa fa-puzzle-piece"></i>Ver resultados</a></li>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] <= 4) { ?>
    <li><a href="#" class="sub <?=($active==6)?"active":'';?>"><i class="fa fa-code-fork"></i> Categorias</a>
        <ul>
            <li><a href="<?=base_url('index.php/admin_control/view_categories');?>" class="<?=($class==61)?"current":'';?>">Exibir Categorias</a></li>
            <li><a href="<?=base_url('index.php/admin_control/view_subcategories');?>" class="<?=($class==63)?"current":'';?>">Visualizar subcategorias</a></li>
            <li><a href="<?=base_url('index.php/create_category');?>" class="<?=($class==62)?"current":'';?>">Criar Nova Categoria</a></li>
            <li><a href="<?=base_url('index.php/admin_control/subcategory_form');?>" class="<?=($class==64)?"current":'';?>">Criar subcategoria</a></li>
        </ul>
    </li>
    <?php }?>
    <?php if ($commercial) { ?>
    <?php if ($this->session->userdata['user_role_id'] <= 2) { ?>
    <li><a href="#" class="sub <?=($active==8)?"active":'';?>"><i class="fa fa-list"> </i> Associação</a>
        <ul>
            <li><a href="<?=base_url('index.php/membership');?>" class="<?=($class==81)?"current":'';?>">Ver membros</a></li>
            <li><a href="<?=base_url('index.php/membership/add');?>" class="<?=($class==82)?"current":'';?>">Criar oferta</a></li>
            <li><a href="<?=base_url('index.php/membership/add_feature');?>" class="<?=($class==83)?"current":'';?>">Add Novo recurso</a></li>
        </ul>
    </li>
    <?php } ?>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] <= 4) { ?>
    <li><a href="#" class="sub <?=($active==7)?"active":'';?>"><i class="fa fa-comment"> </i> Blog</a>
        <ul>
            <li><a href="<?=base_url('index.php/blog/view_all');?>" class="<?=($class==71)?"current":'';?>">Ver postagens</a></li>
            <li><a href="<?=base_url('index.php/blog/add');?>" class="<?=($class==72)?"current":'';?>">Add Post</a></li>
        </ul>
    </li>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] <= 3) { ?>
    <li><a href="#" class="sub <?=($active==3)?"active":'';?>"><i class="fa fa-cogs"> </i> Admin Area</a>
        <ul>
            <li><a href="<?=base_url('index.php/admin_control');?>" class="<?=($class==31)?"current":'';?>">Perfil Configurações</a></li>
            <?php if ($this->session->userdata['user_role_id'] <= 2) { ?>
            <li><a href="<?=base_url('index.php/admin/system_control/view_settings');?>" class="<?=($class==32)?"current":'';?>">Configurações de sistema</a></li>
            <li><a href="<?=base_url('index.php/noticeboard'); ?>" class="<?=($class==34)?"current":'';?>"> Quadro de notícias</a></li>        
            <li><a href="<?=base_url('index.php/message_control'); ?>" class="<?=($class==36)?"current":'';?>"> Caixa de Entrada</a></li>        
            <li><a href="<?=base_url('index.php/admin_control/view_payment_history'); ?>" class="<?=($class==35)?"current":'';?>"> Histórico de pagamento</a></li>        
            <?php }?>
            <li><a href="<?=base_url('index.php/faq_control');?>" class="<?=($class==33)?"current":'';?>">FAQ</a></li>
        </ul>
    </li>
    <?php } else { ?>
        <li><a href="<?=base_url('index.php/admin_control');?>" class="<?=($active==3)?"active":'';?>"><i class="fa fa-cogs"> </i> Configurações de perfil</a></li>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] > 2) { ?>
        <li><a class="<?=($active==4)?"active":'';?>" href="<?=base_url('index.php/message_control/contact_form');?>" class="<?=($class==42)?"current":'';?>"><i class="fa fa-envelope-o"></i> Entre em contato com o administrador</a></li>
    <?php }?>
    <li><a href="<?=base_url('index.php/login_control/logout'); ?>"><i class="fa fa-power-off"></i> Sair</a></li>
</ul>
<!-- /End Sidebar -->
