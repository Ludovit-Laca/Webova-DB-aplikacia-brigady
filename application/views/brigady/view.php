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
                    <li><a href="/brigady/index.php/zamestnavatelia"><i class="fa fa-circle-o"></i>Zamestnávatelia</a></li>
                    <li><a href="/brigady/index.php/studenti"><i class="fa fa-circle-o"></i>Študenti</a></li>
                    <li class="active"><a href="/brigady/index.php/brigady"><i class="fa fa-circle-o"></i>Brigády</a></li>
                    <li><a href="/brigady/index.php/studenti_has_brigady"><i class="fa fa-circle-o"></i>Brigády študentov</a></li>
                    <li><a href="/brigady/index.php/preferencie"><i class="fa fa-circle-o"></i>Preferencie študentov</a></li>
                    <li><a href="/brigady/index.php/studenti_has_zrucnosti"><i class="fa fa-circle-o"></i>Zručnosti študentov</a></li>
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
                <div class="panel panel-default">
                    <div class="panel-heading">Brigády<a href="<?php
                        echo site_url('brigady/'); ?>" class="glyphicon glyphicon-arrow-left
pull-right"></a></div>
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
                            <p><?php echo !empty($brigady['zmeno'])?$brigady['zmeno']:''; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Typ brigády:</label>
                            <p><?php echo !empty($brigady['tmeno']) ? $brigady['tmeno'] : ''; ?> </p>
                        </div>

                    </div>
                </div>
            </div>

    </section>
    <!-- /.content -->
</div>
