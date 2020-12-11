<!--================ Start Home Banner Area =================-->
<section class="home_banner_area">
    <div class="banner_inner">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>
        <?=(isset($message)) ? $message : ''; ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner_content text-center">
                        <p class="text-uppercase">
                            Portal de Educação Corporativa - Maxxi Econômica
                        </p>
                        <h1 class="text-uppercase mt-4 mb-5">
                            Buscamos a excelência através do desenvolvimento do nosso Capital Humano
                        </h1>
                        <p class="text">
                            #JuntosSomosMaxxi
                        </p>
                        <?php if (!$this->session->userdata('log')): ?>
                        <?php if ($student_can_register): ?>
<!--                            <a href="--><?//=base_url('index.php/login_control/register');?><!--" class="primary-btn2 mb-3 mb-sm-0 register_open">Registro</a>-->
                            <a href="<?=base_url('index.php/login_control');?>" class="primary-btn ml-sm-3 ml-0 login_open">Login</a>
                        <?php endif; ?>

                    </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Home Banner Area =================-->

<!--================ Start Feature Area =================-->
<section class="feature_area section_gap_top">

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_feature">
                    <div class="icon"><span class="flaticon-student"></span></div>
                    <div class="desc">
                        <h4 class="mt-3 mb-2">Facilidade de Estudo</h4>
                        <p>
                             Estude de qualquer dispositivo.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single_feature">
                    <div class="icon"><span class="flaticon-book"></span></div>
                    <div class="desc">
                        <h4 class="mt-3 mb-2">Cursos Online</h4>
                        <p>
                        Cursos selecionados para você aprimorar seus conhecimentos.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single_feature">
                    <div class="icon"><span class="flaticon-earth"></span></div>
                    <div class="desc">
                        <h4 class="mt-3 mb-2">Certificação</h4>
                        <p>
                        Ao final de cada curso, para mensurarmos seu conhecimento, realize seu teste e emita seu certificado.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Feature Area =================-->

<!--================ End Feature Area =================-->
<!--================ Start Popular Courses Area =================-->

<div class="popular_courses">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <?php
                    $logado = $this->session->userdata('user_id');
                    if($logado <> '') {

                        $result = $this->db->select('idCargo')
                            ->from('users')
                            ->where('user_id', $logado)
                            ->get()->result();





                       $usuarios =  json_encode($result[0]->idCargo);

                   $cargo = str_replace("", "", $usuarios);
                   $cargo_c =  preg_replace("/[^0-9]/", "", $cargo);

                     //  var_dump($cargo_c);die;






//
//                            $courses = $this->db->select('*')
//                                ->from('courses')
//                                ->where('idCargo', $result[0])
//                                ->get()->result();


                    $sql  =  "SELECT * from courses where idCargo like '%$cargo_c%' order by course_id desc" ;

                   // var_dump($sql);die;

                    $courses =   $this->db->query($sql)->result();

                  //  var_dump($courses);die;
                     ?>
                    <h2 class="mb-3">Cursos Maxxi</h2>
                    <p>
                        Ultimos cursos adicionados para você
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>
            <?=(isset($message)) ? $message : ''; ?>
            <!-- single course -->

            <div class="col-lg-12">

                <div class="owl-carousel active_course">
                    <?php
                    if (isset($courses) AND !empty($courses)) {
                        $i = 1;
                        foreach ($courses as $course) {
                            if ($course->active == 1) {
                                ?>
                    <div class="single_course">

                        <div class="course_head">
                            <a href="<?php echo base_url('index.php/course/course_summary/'.$course->course_id); ?>">
                                <?php if (file_exists("course-images/$course->course_id.png")) { ?>
                                    <img class="img-fluid"" src="<?= base_url("course-images/$course->course_id.png"); ?>" data-src="holder.js/300x300" alt="...">

                                <?php } ?>

                                </div>
                            <div class="course_content">
                            <?php if ($course->course_price) {
                                echo ' <span class="price">'.$currency_symbol.$course->course_price.'</span>';
                            }else{
                                echo '<span class="label label-primary pull-right"></span>';
                            } ?>
                            <a href="<?php echo base_url('index.php/course/course_summary/'.$course->course_id); ?>">


                                <h4 class="mb-3">
                                    <a href="<?php echo base_url('index.php/course/course_summary/'.$course->course_id); ?>"><?=$course->course_title;?></a>
                                </h4>
                                <p>
                                    <?=$this->db->where('course_id', $course->course_id)->from('course_videos')->count_all_results(); ?> Aula
                                </p>
                                <div
                                        class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4"
                                >
                                </div>


                            </a>


                        </div>
                    </div>


                        <?php $i++;
                        }
                        }
                        } else {
                            echo '<h4>Nenhum curso disponivel!</h4>';
                        }

                    }else{

                    }
                        ?>

                    </div>


                </div>

            </div>
        </div>
    </div>





</div>

</div>



<!--================ End Popular Courses Area =================-->


<!--================ Start Events Area =================
<div class="events_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3 text-white">Proximos Treinamentos</h2>
                    <p class="mb-3 text-white">
                        Abaixo os treinamentos agendados para as regiões abaixo
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="single_event position-relative">
                    <div class="event_thumb">
                        <img src="<?php echo base_url('assets/img/event/e1.jpg') ?>" alt="" />
                    </div>
                    <div class="event_details">
                        <div class="d-flex mb-4">
                            <div class="date"><span>15</span> Julho</div>

                            <div class="time-location">
                                <p>
                                    <span class="ti-time mr-2"></span> 08:00 AM - 12:30 AM
                                </p>
                                <p>
                                    <span class="ti-location-pin mr-2"></span> CDL Canoas
                                </p>
                            </div>
                        </div>
                        <p>
                            Treinamento de Vendas para gestores e supervisores
                        </p>
                        <a href="#" class="primary-btn rounded-0 mt-3">Regiao 1</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_event position-relative">
                    <div class="event_thumb">
                        <img src="<?php echo base_url('assets/img/event/e2.jpg') ?>" alt="" />
                    </div>
                    <div class="event_details">
                        <div class="d-flex mb-4">
                            <div class="date"><span>15</span> Julho</div>

                            <div class="time-location">
                                <p>
                                    <span class="ti-time mr-2"></span> 08:00 AM - 12:30 AM
                                </p>
                                <p>
                                    <span class="ti-location-pin mr-2"></span> CDL Novo Hamburgo
                                </p>
                            </div>
                        </div>
                        <p>
                            Treinamento de Vendas para gestores e supervisores
                        </p>
                        <a href="#" class="primary-btn rounded-0 mt-3">Regiao 3</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_event position-relative">
                    <div class="event_thumb">
                        <img src="<?php echo base_url('assets/img/event/e2.jpg') ?>" alt="" />
                    </div>
                    <div class="event_details">
                        <div class="d-flex mb-4">
                            <div class="date"><span>15</span> Julho</div>

                            <div class="time-location">
                                <p>
                                    <span class="ti-time mr-2"></span> 08:00 AM - 12:30 AM
                                </p>
                                <p>
                                    <span class="ti-location-pin mr-2"></span> CDL Novo Hamburgo
                                </p>
                            </div>
                        </div>
                        <p>
                            Treinamento de Vendas para gestores e supervisores
                        </p>
                        <a href="#" class="primary-btn rounded-0 mt-3">Regiao 2</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_event position-relative">
                    <div class="event_thumb">
                        <img src="<?php echo base_url('assets/img/event/e2.jpg') ?>" alt="" />
                    </div>
                    <div class="event_details">
                        <div class="d-flex mb-4">
                            <div class="date"><span>15</span> Julho</div>

                            <div class="time-location">
                                <p>
                                    <span class="ti-time mr-2"></span> 08:00 AM - 12:30 AM
                                </p>
                                <p>
                                    <span class="ti-location-pin mr-2"></span> CDL Novo Hamburgo
                                </p>
                            </div>
                        </div>
                        <p>
                            Treinamento de Vendas para gestores e supervisores
                        </p>
                        <a href="#" class="primary-btn rounded-0 mt-3">Regiao 5</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!--================ End Events Area =================-->
