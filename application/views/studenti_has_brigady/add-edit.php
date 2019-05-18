<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Hlavné menu</li>
            <li>
                <a href="/brigady">
                    <i class="fa fa-dashboard"></i> <span>Úvod</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tabuľky</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/brigady/index.php/zamestnavatelia"><i class="fa fa-circle-o"></i>Zamestnávatelia</a>
                    </li>
                    <li><a href="/brigady/index.php/studenti"><i class="fa fa-circle-o"></i>Študenti</a></li>
                    <li><a href="/brigady/index.php/brigady"><i class="fa fa-circle-o"></i>Brigády</a></li>
                    <li class="active"><a href="/brigady/index.php/studenti_has_brigady"><i class="fa fa-circle-o"></i>Brigády
                            študentov</a></li>
                    <li><a href="/brigady/index.php/preferencie"><i class="fa fa-circle-o"></i>Preferencie študentov</a>
                    </li>
                    <li><a href="/brigady/index.php/studenti_has_zrucnosti"><i class="fa fa-circle-o"></i>Zručnosti
                            študentov</a></li>
                    <li><a href="/brigady/index.php/typ_brigady"><i class="fa fa-circle-o"></i>Typ brigády</a></li>
                    <li><a href="/brigady/index.php/zrucnosti"><i class="fa fa-circle-o"></i>Zručnosti</a></li>
                    <li><a href="/brigady/index.php/kriteria"><i class="fa fa-circle-o"></i>Kritéria</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Grafy</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                    <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                    <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                    <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                </ul>
            </li>
            <li>
                <a href="../calendar.html">
                    <i class="fa fa-calendar"></i> <span>Kalendár</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tabuľka
            <small>Brigády študentov</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-table"></i>Domov</a></li>
            <li><a href="#">Tabuľky</a></li>
            <li class="active">Brigády študentov</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box-header">

            <div class="col-xs-12">
                <?php
                if (!empty($success_msg)) {
                    echo '<div class="alert alert-success">' . $success_msg . '</div>';
                } elseif (!empty($error_msg)) {
                    echo '<div class="alert alert-danger">' . $error_msg . '</div>';
                }
                ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-warning">
                        <div class="panel-heading"><?php echo $action; ?>
                            <a href="<?php echo site_url('studenti_has_brigady/'); ?>"
                                                class="glyphicon glyphicon-arrow-left pull-right" style="color: #f39c12"></a></div>
                        <div class="panel-body">
                            <form method="post" action="" class="form">
                                <div class="form-group">
                                    <label for="title">Dátum nástupu</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" name="odkedy"
                                               value="<?php echo
                                               !empty($post['odkedy']) ? $post['odkedy'] : ''; ?>">
                                        <?php echo form_error('odkedy', '<p
class="text-danger">', '</p>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Dátum ukončenia</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker2"
                                               name="dokedy" value="<?php echo
                                        !empty($post['dokedy']) ? $post['dokedy'] : ''; ?>">
                                        <?php echo form_error('dokedy', '<p
class="text-danger">', '</p>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Hodinová sadzba študenta</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <input type="number" step="0.01" class="form-control"
                                               name="hodinova_sadzba_studenta" placeholder="Hodinová sadzba študenta"
                                               value="<?php echo
                                               !empty($post['hodinova_sadzba_studenta']) ? $post['hodinova_sadzba_studenta'] : ''; ?>">
                                        <?php echo form_error('hodinova_sadzba_studenta', '<p
class="text-danger">', '</p>'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Odpracované hodiny</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    <input type="number" class="form-control"
                                           name="odpracovane_hodiny" placeholder="Odpracované hodiny" value="<?php echo
                                    !empty($post['odpracovane_hodiny']) ? $post['odpracovane_hodiny'] : ''; ?>">
                                    <?php echo form_error('odpracovane_hodiny', '<p
class="text-danger">', '</p>'); ?></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Meno študenta'); ?>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    <?php echo form_dropdown('studenti_id_studenta', $users, $users_selected, 'class="form-control"'); ?>
                                    </div></div>
                                <div class="form-group">
                                    <?php echo form_label('Názov brigády'); ?>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-briefcase"></i>
                                        </div>
                                    <?php echo form_dropdown('brigady_id_brigady', $brigady, $brigady_selected, 'class="form-control"'); ?>
                                    </div></div>
                                <input type="submit" name="postSubmit" class="btn btn-warning" value="Odoslať"/>
                            </form>
                        </div>
                    </div>

                </div>
            </div>


        </div>

    </section>
    <!-- /.content -->
</div>