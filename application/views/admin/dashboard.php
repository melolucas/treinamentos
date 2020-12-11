<?php         

    date_default_timezone_set($this->session->userdata['time_zone']);

    $unread_messages = $this->db->where('message_read', 0)->from('messages')->count_all_results();
    $total_exams = $this->db->select('*')->from('exam_title')->count_all_results();
    $total_courses = $this->db->select('*')->from('courses')->count_all_results();
    $total_students = $this->db->where('user_role_id',5)->from('users')->count_all_results();



    $all_categories = $this->db->get('categories')->result();
    $active_category = count($this->db->get_where('categories', array('active' => 1))->result());
    $inactive_category = (count($all_categories) - $active_category);

    // Create the data table for EARNINGS.
    $data_earnings = "['Mês', 'Aprendizado'],";
    for ($i=0; $i < 6; $i++) { 
        $month_name = date('M', strtotime(-$i." month"));
        $month = date('m', strtotime(-$i." month"));

        $earned = $this->db->where("MONTH(pay_date)", $month)
                        ->select_sum('pay_amount')
                        ->get('payment_history')
                        ->row()->pay_amount;

         $earned = ($earned)?$earned:'0';

         $data_earnings .= "['".$month_name."',". $earned."],";
    }
    $data_earnings = substr($data_earnings, 0, -1);

    // Create the data table for EXAM.
    $data_exam = "['Category', 'Ativo', 'Inativo'],";
    
    foreach ($all_categories as $value) {
        $sub_categories = $this->db->where('cat_id', $value->category_id)->get('sub_categories')->result();

        $active_exams = 0;
        $inactive_exams = 0;

        foreach ($sub_categories as $val) {

            $active_exams += $this->db->where('category_id', $val->id)
                            ->where("active", 1)
                            ->from('exam_title')
                            ->count_all_results();

            $inactive_exams += $this->db->where('category_id', $val->id)
                            ->where("active", 0)
                            ->from('exam_title')
                            ->count_all_results();        
        }

        $data_exam .= "['".$value->category_name."',". $active_exams.",". $inactive_exams."],";
    }
    $data_exam = substr($data_exam, 0, -1);


?>
<script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table for USER.
        var data1 = new google.visualization.DataTable();
        data1.addColumn('string', 'Topping');
        data1.addColumn('number', 'Slices');
        data1.addRows([
          ['Admin', <?=$total_admin;?>],
          ['Moderador', <?=$total_moderator;?>],
          ['Professor', <?=$total_teacher;?>],
          ['Estudante', <?=$total_student;?>]
        ]);

        // Create the data table for CATEGORY.
        var data2 = new google.visualization.DataTable();
        data2.addColumn('string', 'Topping');
        data2.addColumn('number', 'Slices');
        data2.addRows([
          ['Ativo', <?=$active_category;?>],
          ['Inativo', <?=$inactive_category;?>]
        ]);

        // Create the data table for EARNING.
        var data3 = google.visualization.arrayToDataTable([
            <?php echo $data_earnings; ?>
          ]);

        // Create the data table for EXAM.
        var data4 = google.visualization.arrayToDataTable([
            <?php echo $data_exam; ?>
          ]);

        // Set chart options USER
        var options1 = {
                       'width':300,
                       'height':200};

        // Set chart options EARNINGS
        var options3 = {
            vAxis: {title: 'Month',  titleTextStyle: {color: 'gray'}}
          };
        // Set chart options EXAM
        var options4 = {
            hAxis: {title: 'Categoria', titleTextStyle: {color: 'red'}}
          };

        // Instantiate and draw our chart, passing in some options.
        var chart1 = new google.visualization.PieChart(document.getElementById('chart_user'));
        chart1.draw(data1, options1);
        var chart2 = new google.visualization.PieChart(document.getElementById('chart_category'));
        chart2.draw(data2, options1);
         var chart3 = new google.visualization.BarChart(document.getElementById('chart_earn'));
         chart3.draw(data3, options3);
        var chart4 = new google.visualization.ColumnChart(document.getElementById('chart_exam'));
        chart4.draw(data4, options4);




      }


</script>

<div class="col-md-12" style="margin-top: 5%;">    
    <div id="note">
        <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
        <?=(isset($message)) ? $message : ''; ?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-3 col-md-6">
                <a href="<?= base_url('index.php/message_control'); ?>">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-envelope-o fa-5x"></i>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <p class="dashboard-heading"><?= $unread_messages; ?></p>
                                </div>
                                <div class="col-xs-12">
                                    <p class="dashboard-text text-center">Mensagens não lidas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?= base_url('index.php/user_control'); ?>">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-group fa-5x"></i>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <p class="dashboard-heading"><?= $total_students; ?></p>
                                </div>
                                <div class="col-xs-12">
                                    <p class="dashboard-text text-center">Total de alunos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?= base_url('index.php/mocks'); ?>">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-puzzle-piece fa-5x"></i>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <p class="dashboard-heading"><?= $total_exams; ?></p>
                                </div>
                                <div class="col-xs-12">
                                    <p class="dashboard-text text-center">Exames totais</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?= base_url('index.php/exam_control/view_results'); ?>">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-bookmark-o fa-5x"></i>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <p class="dashboard-heading"><?= $total_courses; ?></p>
                                </div>
                                <div class="col-xs-12">
                                    <p class="dashboard-text text-center">Cursos totais</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-4">
            <div class="panel panel-primary"><!-- /.panel Start-->
            <div class="panel-heading">Usuários ativos</div>
                <div id="chart_user"></div>
            </div><!-- /.panel End-->
            </div>
            <div class="col-lg-4">
            <div class="panel panel-primary"><!-- /.panel Start-->
            <div class="panel-heading">Total de categorias</div>
            <div id="chart_category"></div>
            </div><!-- /.panel End-->
            </div>
            <div class="col-lg-4">
            <div class="panel panel-primary" style="background-color: black;"><!-- /.panel Start-->
            <div class="panel-heading">Últimos 6 meses </div>
            <div id="chart_earn"></div>
            </div><!-- /.panel End-->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info"><!-- /.panel Start-->
                <div class="panel-heading">Total de exames com base na categoria</div>
                <div id="chart_exam"></div>
            </div><!-- /.panel End-->
        </div>
    </div>
</div>