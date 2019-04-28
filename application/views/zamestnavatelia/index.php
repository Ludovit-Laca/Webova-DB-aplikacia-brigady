<div class="container">
    <?php if (!empty($success_msg)) { ?>
        <div class="col-xs-12">
            <div class="alert alert-success"><?php echo $success_msg;
                ?></div>
        </div>
    <?php } elseif (!empty($error_msg)) { ?>
        <div class="col-xs-12">
            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
        </div>
    <?php } ?>
    <div class="row">
        <h1>Zoznam zamestnavatelov</h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default ">
                <div class="panel-heading">Zamestnavatelia <a href="<?php echo
                    site_url('zamestnavatelia/add/'); ?>" class="glyphicon glyphicon-plus pull-right"></a></div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="25%">Názov</th>
                        <th width="20%">Telefon</th>
                        <th width="30%">Email</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if (!empty($zamestnavatelia)): foreach ($zamestnavatelia as $zamestnavatel): ?>
                        <tr>
                            <td><?php echo '#'.$zamestnavatel['id_zamestnavatela']; ?></td>
                            <td><?php echo $zamestnavatel['nazov']; ?></td>
                            <td><?php echo $zamestnavatel['telefon']; ?></td>
                            <td><?php echo $zamestnavatel['email']; ?></td>
                            <td>
                                <a href="<?php echo
                                site_url('zamestnavatelia/view/'.$zamestnavatel['id_zamestnavatela']); ?>" class="glyphicon glyphicon-eye-open"></a>
                                <a href="<?php echo
                                site_url('zamestnavatelia/edit/'.$zamestnavatel['id_zamestnavatela']); ?>" class="glyphicon glyphicon-edit"></a>
                                <a href="<?php echo
                                site_url('zamestnavatelia/delete/'.$zamestnavatel['id_zamestnavatela']); ?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr>
                            <td colspan="4">Zamestnavatel(ia) not found......
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>