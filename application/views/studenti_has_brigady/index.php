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
                    <li><a href="/brigady/index.php/brigady"><i class="fa fa-circle-o"></i>Brigády</a></li>
                    <li class="active" ><a href="/brigady/index.php/studenti_has_brigady"><i class="fa fa-circle-o"></i>Brigády študentov</a></li>
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
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="panel-heading">Brigády študentov<a href="<?php echo
                            site_url('studenti_has_brigady/add/'); ?>" class="glyphicon glyphicon-plus pull-right" style="color: #f39c12"></a></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Dátum nástupu</th>
                                <th width="15%">Dátum ukončenia</th>
                                <th width="10%">Hodinová sadzba študenta</th>
                                <th width="10%">Odpracované hodiny</th>
                                <th width="15%">Meno študenta</th>
                                <th width="15%">Názov brigády</th>
                                <th width="15%">Funkcie</th>
                            </tr>
                            </thead>
                            <tbody id="userData">
                            <?php if (!empty($studenti_has_brigady)): foreach ($studenti_has_brigady as $sbrigady): ?>
                                <tr>
                                    <td><?php echo '#' . $sbrigady['id_študenti_has_brigady']; ?></td>
                                    <td><?php echo $sbrigady['odkedy']; ?></td>
                                    <td><?php echo $sbrigady['dokedy']; ?></td>
                                    <td><?php echo $sbrigady['hodinova_sadzba_studenta']; ?></td>
                                    <td><?php echo $sbrigady['odpracovane_hodiny']; ?></td>
                                    <td><?php echo $sbrigady['fullname']; ?></td>
                                    <td><?php echo $sbrigady['bnazov']; ?></td>
                                    <td>
                                        <a href="<?php echo
                                        site_url('studenti_has_brigady/view/' . $sbrigady['id_študenti_has_brigady']); ?>"
                                           class="glyphicon glyphicon-eye-open" style="color: #f39c12;"></a>
                                        <a href="<?php echo
                                        site_url('studenti_has_brigady/edit/' . $sbrigady['id_študenti_has_brigady']); ?>"
                                           class="glyphicon glyphicon-edit" style="color: #f39c12"></a>
                                        <a href="<?php echo
                                        site_url('studenti_has_brigady/delete/' . $sbrigady['id_študenti_has_brigady']); ?>"
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