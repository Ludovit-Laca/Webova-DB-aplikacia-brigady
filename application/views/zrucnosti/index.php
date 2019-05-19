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
                    <li><a href="/brigady/index.php/brigady"><i class="fa fa-circle-o"></i>Brigády</a></li>
                    <li><a href="/brigady/index.php/studenti_has_brigady"><i class="fa fa-circle-o"></i>Brigády
                            študentov</a></li>
                    <li><a href="/brigady/index.php/preferencie"><i class="fa fa-circle-o"></i>Preferencie študentov</a>
                    </li>
                    <li><a href="/brigady/index.php/studenti_has_zrucnosti"><i class="fa fa-circle-o"></i>Zručnosti
                            študentov</a></li>
                    <li><a href="/brigady/index.php/typ_brigady"><i class="fa fa-circle-o"></i>Typ brigády</a></li>
                    <li class="active"><a href="/brigady/index.php/zrucnosti"><i
                                    class="fa fa-circle-o"></i>Zručnosti</a></li>
                    <li><a href="/brigady/index.php/kriteria"><i class="fa fa-circle-o"></i>Kritéria</a></li>
                </ul>
            </li>
            <li>
                <a href="grafy">
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
            <small>Zručnosti</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-table"></i>Domov</a></li>
            <li><a href="#">Tabuľky</a></li>
            <li class="active">Zručnosti</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="panel-heading">Zručnosti <a href="<?php echo
                            site_url('zrucnosti/add/'); ?>" class="glyphicon glyphicon-plus pull-right"
                                                               style="color: #f39c12"></a></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="25%">Názov</th>
                                <th width="45%">Popis</th>
                                <th width="20%">Funkcie</th>
                            </tr>
                            </thead>
                            <tbody id="userData">
                            <?php if (!empty($zrucnosti)): foreach ($zrucnosti as $zrucnost): ?>
                                <tr>
                                    <td><?php echo '#' . $zrucnost['id_zrucnosti']; ?></td>
                                    <td><?php echo $zrucnost['nazov']; ?></td>
                                    <td><?php echo $zrucnost['popis']; ?></td>
                                    <td>
                                        <a href="<?php echo
                                        site_url('zrucnosti/view/' . $zrucnost['id_zrucnosti']); ?>"
                                           class="glyphicon glyphicon-eye-open" style="color: #f39c12"></a>
                                        <a href="<?php echo
                                        site_url('zrucnosti/edit/' . $zrucnost['id_zrucnosti']); ?>"
                                           class="glyphicon glyphicon-edit" style="color: #f39c12"></a>
                                        <a href="<?php echo
                                        site_url('zrucnosti/delete/' . $zrucnost['id_zrucnosti']); ?>"
                                           class="glyphicon glyphicon-trash" style="color: #f39c12"
                                           onclick="return confirm('Naozaj chcete vymazať záznam?')"></a>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="4">Nenašiel sa žiadny záznam :(
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
