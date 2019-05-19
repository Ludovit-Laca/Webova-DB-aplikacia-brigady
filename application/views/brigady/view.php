<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>/assets/icons/adminIcon.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('username') ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
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
                    <li class="active"><a href="/brigady/index.php/brigady"><i class="fa fa-circle-o"></i>Brigády</a>
                    </li>
                    <li><a href="/brigady/index.php/studenti_has_brigady"><i class="fa fa-circle-o"></i>Brigády
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
            <li>
                <a href="/brigady/index.php/grafy">
                    <i class="fa fa-pie-chart"></i>
                    <span>Grafy</span>
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
            <small>Brigády</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-table"></i>Domov</a></li>
            <li><a href="#">Tabuľky</a></li>
            <li class="active">Brigády</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-warning">
                        <div class="panel-heading">Detaily brigády<a href="<?php
                            echo site_url('brigady/'); ?>" class="glyphicon glyphicon-arrow-left
pull-right" style="color: #f39c12"></a></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Dátum platosti</label>
                                <p><?php echo
                                    !empty($brigady['datum']) ? $brigady['datum'] : ''; ?> </p>
                            </div>
                            <div class="form-group">
                                <label>Názov brigády:</label>
                                <p><?php echo
                                    !empty($brigady['nazov']) ? $brigady['nazov'] : ''; ?> </p>
                            </div>
                            <div class="form-group">
                                <label>Hodinová sadzba:</label>
                                <p><?php echo
                                    !empty($brigady['hodinova_sadzba_brigada']) ? $brigady['hodinova_sadzba_brigada'] : ''; ?> </p>
                            </div>
                            <div class="form-group">
                                <label>Provízia agentúry:</label>
                                <p><?php echo
                                    !empty($brigady['provizia_agentury']) ? $brigady['provizia_agentury'] : ''; ?> </p>
                            </div>
                            <div class="form-group">
                                <label>Aktuálnosť:</label>
                                <p><?php echo
                                    !empty($brigady['ak']) ? $brigady['ak'] : ''; ?> </p>
                            </div>
                            <div class="form-group">
                                <label>Popis:</label>
                                <p><?php echo
                                    !empty($brigady['popis']) ? $brigady['popis'] : ''; ?> </p>
                            </div>
                            <div class="form-group">
                                <label>Meno zamestnávateľa:</label>
                                <p><?php echo !empty($brigady['zmeno']) ? $brigady['zmeno'] : ''; ?></p>
                            </div>
                            <div class="form-group">
                                <label>Typ brigády:</label>
                                <p><?php echo !empty($brigady['tmeno']) ? $brigady['tmeno'] : ''; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-warning">
                        <div class="panel-heading">
                            Počet brigád podľa mesiacov
                        </div>
                        <div class="box-header">
                            <div id="myfirstchart" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- /.content -->
</div>
