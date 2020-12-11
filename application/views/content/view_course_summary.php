<?php
if ($this->session->userdata('Time_zone')) {
    date_default_timezone_set ($this->session->userdata('Time_zone'));
}

$user_info = $this->db->get_where('users', array('user_id' => $this->session->userdata('user_id')))->row();?>
<?php $purchased = $this->db->where('user_id', $this->session->userdata('user_id'))->where('pur_ref_id', $course->course_id)->get('puchase_history')->row();?>
<!--================ Start Course Details Area =================-->
<section class="course_details_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 course_details_left">
                <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>
                <?=(isset($message)) ? $message : ''; ?>
                <div class="main_image">
                    <?php if (file_exists("course-images/$course->course_id.png")) { ?>
                        <img class="img-fluid" width="250" src="<?=base_url("course-images/$course->course_id.png"); ?>" alt="...">
                    <?php }else{ ?>
                        <img class="img-fluid" width="250" src="<?=base_url('course-images/placeholder.png'); ?>" alt="...">
                    <?php } ?>
                </div>
                <div class="content_wrapper">
                    <h4 class="title">Objetivos do Curso</h4>
                    <div class="content">
                        <?=$course->what_i_get; ?>
                    </div>

                    <h4 class="title">Publico Alvo</h4>
                    <div class="content">
                        <?=$course->target_audience; ?>
                    </div>

                    <h4 class="title">Aulas do Curso</h4>
                    <div class="content">
                        <ul class="course_list">
                            <?php $i = 1;
                            $sections = $this->db->get_where('course_sections', array('course_id'=>$course->course_id))->result();
                            foreach ($sections as $value) { $j = 1;  ?>
                            <li class="justify-content-between d-flex" >
                                <p><?=$value->section_name?> : <?=' '.$value->section_title;?></p>
                                <?php
                                $videos = $this->db->where('section_id', $value->section_id)->order_by('orderList', 'asc')
                                    ->get('course_videos')
                                    ->result();
                                if ($videos) {
                                foreach ($videos as $video) {
                                $date = @date_create($video->created_at);
                                ?>
                                    <li class="lec">
                                        <div class="lec-left">
                                            <span class="course-no"><?=$i.'.'.$j;?> </span>
                                        </div>
                                        <div class="lec-right">
                                            <div class="lec-url">
                                                <div class="lec-main fxac">
                                                    <div class="lec-title">
                                                        <?php
                                                        if (
                                                            ($video->preview_type == 'free') ||
                                                            (!$course->course_price) ||
                                                            $purchased ||
                                                            (
                                                                ($this->session->userdata('log')) &&
                                                                ($user_info->subscription_id) &&
                                                                ($user_info->subscription_end > now())
                                                            )
                                                        )
                                                        {
                                                            if($video->content_type == 'external_link')
                                                            { ?>

                                                                <i class="glyphicon glyphicon-link"></i> <a href="<?=$video->youtube_link; ?>" target="_blank"><?=$video->video_title; ?></a>

                                                                <?php if (($video->preview_type == 'free') || ($video->preview_type == 'Free') || !$course->course_price) { ?>
                                                                <span class="label label-default pull-right"></span>
                                                            <?php } ?>

                                                                <span class="help-block small"><?='Type: ';?> <?php $splits = explode('.', $video->video_link);?> <?=end($splits)?:str_replace('_', ' ', $video->content_type); ?> <?=' | Added: '.date_format($date, 'M d, Y' ); ?> </span>

                                                            <?php }else if($video->content_type == 'youtube'){ ?>

                                                                <i class="glyphicon glyphicon-expand"></i> <a href="<?=$video->youtube_link; ?>" target="_blank"><?=$video->video_title; ?></a>

                                                                <?php if (($video->preview_type == 'free') || ($video->preview_type == 'Free') || !$course->course_price) { ?>
                                                                    <span class="label label-default pull-right"></span>
                                                                <?php } ?>

                                                                <span class="help-block small"><?='Type: ';?> <?php $splits = explode('.', $video->video_link);?> <?=end($splits)?:str_replace('_', ' ', $video->content_type); ?> <?=' | Added: '.date_format($date, 'M d, Y' ); ?> </span>


                                                            <?php }else if($video->content_type == 'file')
                                                            {
                                                                ?>

                                                                <i class="glyphicon glyphicon-download"></i>
                                                                <a href="<?=base_url('course_videos/'.$video->course_id.'/'.$video->video_link); ?>" download><?=$video->video_title; ?></a>

                                                                <?php if (($video->preview_type == 'free') || ($video->preview_type == 'Free') || !$course->course_price) { ?>
                                                                <span class="label label-default pull-right"></span>
                                                            <?php } ?>

                                                                <span class="help-block small">Size: <?=number_format($video->file_size/1000000, 2) .'MB | Type: ';?> <?php $splits = explode('.', $video->video_link);?> <?=end($splits)?:str_replace('_', ' ', $video->content_type); ?> <?=' | Added: '.date_format($date, 'M d, Y' ); ?> </span>


                                                            <?php }else{ ?>

                                                                <a href="" class="videoplaylink" data-toggle="modal" data-target="#videoModal" data-video-url="<?=base_url('course_videos/'.$video->course_id.'/'.$video->video_link); ?>">
                                                                    <i class="glyphicon glyphicon-expand"></i>

                                                                    <?=$video->video_title; ?>

                                                                    <?php if (($video->preview_type == 'free') || ($video->preview_type == 'Free') || !$course->course_price) { ?>
                                                                        <span class="label label-default pull-right"></span>
                                                                    <?php } ?>

                                                                    <span class="help-block small"><?='Type: ';?> <?php $splits = explode('.', $video->video_link);?> <?=end($splits)?:str_replace('_', ' ', $video->content_type); ?> <?=' | Added: '.date_format($date, 'M d, Y' ); ?> </span>

                                                                </a>
                                                            <?php } ?>

                                                            <?php
                                                        }else{ ?>
                                                            <i class="glyphicon glyphicon-expand"></i>
                                                            <?=$video->video_title; ?>

                                                            <span class="help-block small"><?='Type: ';?> <?php $splits = explode('.', $video->video_link);?> <?=end($splits)?:str_replace('_', ' ', $video->content_type); ?> <?=' | Added: '.date_format($date, 'M d, Y' ); ?> </span>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                            <?php $j++; }
                                    $i++;
                                }else{ ?>
                                    <li class="lec">
                                        <div class="lec-left">
                                            <span class="course-no"></span>
                                        </div>
                                        <div class="lec-right">
                                            <div class="lec-url">
                                                <div class="lec-main fxac">
                                                    <div class="lec-title">
                                                        Nenhum vídeo adicionado ainda!
                                                    </div>
                                                    <div class="lec-includes">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php }
                            }?>
                            <?php
                            $exams = $this->db->where('course_id',$course->course_id)->get('exam_title')->result();
                            if ($exams) { $k = 1; ?>
                            <li class="chap-title"><b> Exames associados </b></li>
                            <?php
                            foreach ($exams as $exam) { ?>
                            <li class="lec">
                                <div class="lec-left">
                                    <span class="course-no"><?=$k;?> </span>
                                </div>
                                <div class="lec-right">
                                    <div class="lec-url">
                                        <div class="lec-main fxac">
                                            <div class="lec-title">
                                                <?php if ($exam->public || $purchased || (($this->session->userdata('log')) && ($user_info->subscription_id) && ($user_info->subscription_end > now()))) { ?>
                                                    <a href="<?=base_url('index.php/exam_control/view_exam_summery/'.$exam->title_id)?>">
                                                        <?=$exam->title_name; ?>
                                                    </a>
                                                <?php }else{
                                                    echo $exam->title_name;
                                                } ?>
                                                <?php if ($exam->exam_price == 0) { ?>
                                                    <span class="label label-default pull-right"></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php $k++;
                            } }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 right-contents">
                <ul>
                    <li>
                        <a class="justify-content-between d-flex" href="#">
                            <p>Trainer’s Nome</p>
                            <span class="or"><?=$course->user_name?></span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="#">
                            <p>Curso </p>
                            <span>Livre</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="#">
                            <p>Available Seats </p>
                            <span>15</span>
                        </a>
                    </li>

                </ul>
                <?php
                if ($this->session->userdata('log')) {
                if ($course->course_price && (!$user_info->subscription_id && ($user_info->subscription_end < now()))){
                ?>
                    <?php
                }
                }else{
                ?>
                <a href="<?=base_url('index.php/course/enroll/'.$course->course_id);?>" class="primary-btn2 text-uppercase enroll rounded-0 text-white">INSCREVER-SE</a>
                <?php

                }?>



                    <div class="feedeback">
                        <h6>Seu Feedback</h6>
                        <textarea name="feedback" class="form-control" cols="10" rows="10"></textarea>
                        <div class="mt-10 text-right">
                            <a href="#" class="primary-btn2 text-right rounded-0 text-white">Enviar</a>
                        </div>
                    </div>
                                    </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Course Details Area =================-->
<script src="<?=base_url('assets/js/video.js') ?>"></script>

<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom: 5px;">
                <button type="button" id="modalClose" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4  class="modal-title" id="myModalLabel">
                    <span id="modalVideotitle"></span>
                </h4>
            </div>
            <div class="modal-body " style="padding: 0px;">
                <div class="embed-responsive embed-responsive-16by9">
                    <video class="videoPlayer embed-responsive-item" height="" controls autoplay src="" type="video/x-flv"/></video>
                </div>
            </div>
            <br/>
            <?php if(false){?>
                <div class="" style=" text-align: center;">
                    <div class="btn-group" role="group">
                        <button type="button" id="prevSec" class="btn btn-default"> <i class="glyphicon glyphicon-fast-backward"  data-toggle="tooltip" data-placement="top" title="Previous Section "></i> </button>
                        <button type="button" id="prevVideo" class="btn btn-default"> <i class="glyphicon glyphicon-step-backward"  data-toggle="tooltip" data-placement="top" title="Previous Video "></i> </button>
                        <button type="button" id="nextVideo" class="btn btn-default"> <i class="glyphicon glyphicon-step-forward"  data-toggle="tooltip" data-placement="top" title="Next Video "></i> </button>
                        <button type="button" id="nextSec" class="btn btn-default"> <i class="glyphicon glyphicon-fast-forward"  data-toggle="tooltip" data-placement="top" title="Next Section "></i> </button>
                    </div>
                </div>
            <?php } ?>
            <br/>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $(this).bind("contextmenu", function(e) {
            e.preventDefault();
        });
    });
</script>