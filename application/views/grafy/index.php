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
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tabuľky</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="zamestnavatelia"><i class="fa fa-circle-o"></i>Zamestnávatelia</a></li>
                    <li><a href="studenti"><i class="fa fa-circle-o"></i>Študenti</a></li>
                    <li><a href="brigady"><i class="fa fa-circle-o"></i>Brigády</a></li>
                    <li><a href="studenti_has_brigady"><i class="fa fa-circle-o"></i>Brigády študentov</a>
                    </li>
                    <li><a href="preferencie"><i class="fa fa-circle-o"></i>Preferencie študentov</a></li>
                    <li><a href="studenti_has_zrucnosti"><i class="fa fa-circle-o"></i>Zručnosti študentov</a>
                    </li>
                    <li><a href="typ_brigady"><i class="fa fa-circle-o"></i>Typ brigády</a></li>
                    <li><a href="zrucnosti"><i class="fa fa-circle-o"></i>Zručnosti</a></li>
                    <li><a href="kriteria"><i class="fa fa-circle-o"></i>Kritéria</a></li>
                </ul>
            </li>
            <li class="treeview active">
                <a href="index.php/grafy">
                    <i class="fa fa-pie-chart"></i>
                    <span>Grafy</span>
                    <span class="pull-right-container">
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
            Domov
            <small>Grafy</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-pie-chart"></i>Domov</a></li>
            <li class="active">Grafy</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-6">
                <div class="box box-warning">
                    <h3 class="box-title" style="text-align: center">Počet brigád podľa mesiacov</h3>
                    <div class="box-header">
                        <div id="myfirstchart" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-warning">
                    <h3 class="box-title" style="text-align: center">Počet brigád podľa mesiacov</h3>
                    <div class="box-header">
                        <div id="myfirstchartPie" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-warning">
                    <h3 class="box-title" style="text-align: center">Študenti najviac hľadajú</h3>
                    <div class="box-header">
                        <div id="hladajuBar" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-warning">
                    <h3 class="box-title" style="text-align: center">Študenti najviac hľadajú</h3>
                    <div class="box-header">
                        <div id="myfirstdonut" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-warning">
                    <h3 class="box-title" style="text-align: center">Počet brigád od zamestnávateľov</h3>
                    <div class="box-header">
                        <div id="barzamestnavateliaa" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-warning">
                    <h3 class="box-title" style="text-align: center">Priemerná mzda brigádnikov za rok</h3>
                    <div class="box-header">
                        <div id="line-example" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->