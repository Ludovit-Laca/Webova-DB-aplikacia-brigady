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
                <p><?php echo $this->session->userdata('username')  ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Hlavné menu</li>
            <li class="active">
                <a href="#">
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
                    <li><a href="index.php/zamestnavatelia"><i class="fa fa-circle-o"></i>Zamestnávatelia</a></li>
                    <li><a href="index.php/studenti"><i class="fa fa-circle-o"></i>Študenti</a></li>
                    <li><a href="index.php/brigady"><i class="fa fa-circle-o"></i>Brigády</a></li>
                    <li><a href="index.php/studenti_has_brigady"><i class="fa fa-circle-o"></i>Brigády študentov</a>
                    </li>
                    <li><a href="index.php/preferencie"><i class="fa fa-circle-o"></i>Preferencie študentov</a></li>
                    <li><a href="index.php/studenti_has_zrucnosti"><i class="fa fa-circle-o"></i>Zručnosti študentov</a>
                    </li>
                    <li><a href="index.php/typ_brigady"><i class="fa fa-circle-o"></i>Typ brigády</a></li>
                    <li><a href="index.php/zrucnosti"><i class="fa fa-circle-o"></i>Zručnosti</a></li>
                    <li><a href="index.php/kriteria"><i class="fa fa-circle-o"></i>Kritéria</a></li>
                </ul>
            </li>
            <li>
                <a href="index.php/grafy">
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
            Domov
            <small>Úvod</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Domov</a></li>
            <li class="active">Úvod</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $brigady; ?></h3>

                        <p>Počet brigád</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-briefcase"></i>
                    </div>
                    <a href="index.php/brigady" class="small-box-footer">Viac informácií <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $typ_brigady; ?></h3>

                        <p>Rôzne typy brigád</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-star"></i>
                    </div>
                    <a href="index.php/typ_brigady" class="small-box-footer">Viac informácií <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $zamestnavatelia; ?><sup style="font-size: 20px"></sup></h3>

                        <p>Počet zamestnávateľov</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-clipboard"></i>
                    </div>
                    <a href="index.php/zamestnavatelia" class="small-box-footer">Viac informácií <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $studenti; ?></h3>

                        <p>Registrovaní študenti</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="index.php/studenti" class="small-box-footer">Viac informácií <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-md-6">
                <div class="box box-warning">
                    <h3 class="box-title" style="text-align: center">Počet brigád</h3>
                    <div class="box-header">
                        <div id="myfirstchart" style="height: 250px;"></div>
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