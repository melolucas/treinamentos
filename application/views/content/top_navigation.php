
    <?php   //   echo "<pre/>"; print_r($this->uri->segment(1)); exit();    ?>
    <header class="header_area">
        <div class="main_menu">
            <div class="search_input" id="search_input_box">
                <div class="container">
                    <form class="d-flex justify-content-between" method="" action="">
                        <input
                                type="text"
                                class="form-control"
                                id="search_input"
                                placeholder="Search Here"
                        />
                        <button type="submit" class="btn"></button>
                        <span
                                class="ti-close"
                                id="close_search"
                                title="Close Search"
                        ></span>
                    </form>
                </div>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="<?=base_url();?><?=($this->session->userdata('log'))?'index.php/dashboard/'.$this->session->userdata('user_id'):''?>">
                        <?php if (file_exists('./logo.png')) { ?>
                            <img src="<?=base_url();?>logo.png" width="200px" height="78px">
                        <?php }else{
                            echo ($brand_name)?$brand_name:'MinorSchool';
                        } ?>
                    </a>
                    <button
                            class="navbar-toggler"
                            type="button"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="icon-bar"></span> <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div
                            class="collapse navbar-collapse offset"
                            id="navbarSupportedContent"
                    >
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?=base_url('index.php');?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('index.php/course');?>">Cursos</a>
                            </li>
                                                               <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('index.php/blog');?>">Blog</a>
                                    </li>


                                    <?php if ($this->session->userdata('log')) { ?>
                                        <li class="nav-item">

                                        <a class="nav-link" href="<?=base_url('index.php/login_control/logout'); ?>">Sair</a>
                                        </li>
                            <?php }else{ ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=base_url('index.php/admin');?>">Admin</a>
                                        </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
