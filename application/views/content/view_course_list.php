</br></br>
</br>
</br>
</br>
</br>


<!--================ End Feature Area =================-->
<!--================ Start Popular Courses Area =================-->
<div class="popular_courses">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3">Cursos Maxxi</h2>
                    <p>
                      
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>
            <?=(isset($message)) ? $message : ''; ?>
            <!-- single course -->
            <div class="">

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
                                    <img class="img-fluid"" src="<?=base_url("course-images/$course->course_id.png"); ?>" data-src="holder.js/300x300" alt="...">
                                <?php }else{ ?>
                                    <img class="img-fluid"" src="<?=base_url('exam-images/placeholder.png'); ?>" data-src="holder.js/300x300" alt="...">
                                <?php } ?>

                        </div>
                        <div class="course_content">
                            <?php if ($course->course_price) {
                                echo ' <span class="price">'.$currency_symbol.$course->course_price.'</span>';
                            }else{
                                echo '<span class="label label-primary pull-right"></span>';
                            } ?>
                            <a href="<?php echo base_url('index.php/course/course_summary/'.$course->course_id); ?>">
                            <span class="tag mb-4 d-inline-block"><?=$course->category_name.'/'.$course->sub_cat_name;?></span>
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
                        ?>

                    </div>


                </div>

        </div>
        </div>
    </div>
</div>

        </div>



<!--================ End Popular Courses Area =================-->