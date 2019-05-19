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
                            <a href="<?php echo site_url('brigady/'); ?>"
                               class="glyphicon glyphicon-arrow-left pull-right" style="color: #f39c12"></a></div>
                        <div class="panel-body">
                            <form method="post" action="" class="form">
                                <div class="form-group">
                                    <label for="title">Dátum platnosti</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" name="datum"
                                               value="<?php echo
                                               !empty($post['datum']) ? $post['datum'] : ''; ?>">
                                        <?php echo form_error('datum', '<p
class="text-danger">', '</p>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Názov brigády</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-briefcase"></i>
                                        </div>
                                        <input type="text" class="form-control"
                                               name="nazov" placeholder="Zadajte názov" value="<?php echo
                                        !empty($post['nazov']) ? $post['nazov'] : ''; ?>">
                                        <?php echo form_error('nazov', '<p
class="text-danger">', '</p>'); ?> </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Hodinová sadzba</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <input type="number" step="0.01" class="form-control"
                                               name="hodinova_sadzba_brigada" placeholder="Hodinová sadzba"
                                               value="<?php echo
                                               !empty($post['hodinova_sadzba_brigada']) ? $post['hodinova_sadzba_brigada'] : ''; ?>">
                                        <?php echo form_error('hodinova_sadzba_brigada', '<p
class="text-danger">', '</p>'); ?> </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Provízia agentúry</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <input type="number" step="0.01" class="form-control"
                                               name="provizia_agentury" placeholder="Hodinová sadzba" value="<?php echo
                                        !empty($post['provizia_agentury']) ? $post['provizia_agentury'] : ''; ?>">
                                        <?php echo form_error('provizia_agentury', '<p
class="text-danger">', '</p>'); ?> </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Aktuálnosť</label><br/>
                                    <input type="hidden" class="flat-red" name="aktualnost" value="0">
                                    <input type="checkbox" class="flat-red" name="aktualnost" value="<?php echo
                                    !empty($post['aktualnost']) ? $post['aktualnost'] : '1'; ?>">
                                    <?php echo form_error('aktualnost', '<p
class="text-danger">', '</p>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="title">Popis</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-comment"></i>
                                        </div>
                                        <input type="text" class="form-control"
                                               name="popis" placeholder="Popis" value="<?php echo
                                        !empty($post['popis']) ? $post['popis'] : ''; ?>">
                                        <?php echo form_error('popis', '<p
class="text-danger">', '</p>'); ?> </div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Názov zamestnávateľa'); ?>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clipboard"></i>
                                        </div>
                                        <?php echo form_dropdown('zamestnavatelia_id_zamestnavatela', $users, $users_selected, 'class="form-control"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Typ brigády'); ?>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <?php echo form_dropdown('typ_brigady_id_typu', $brigady, $brigady_selected, 'class="form-control"'); ?>
                                    </div>
                                </div>
                                <input type="submit" name="postSubmit" class="btn btn-warning" value="Odoslať"/>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-warning">
                        <div class="panel-heading">
                            Počet brigád
                        </div>
                        <div class="box-header">
                            <div id="myfirstchart" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>