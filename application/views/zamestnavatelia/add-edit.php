<div class="container">
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
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $action; ?>
                    Zamestnavatelia <a href="<?php echo site_url('zamestnavatelia/'); ?>"
                                       class="glyphicon glyphicon-arrow-left pull-right"></a></div>
                <div class="panel-body">
                    <form method="post" action="" class="form">
                        <div class="form-group">
                            <label for="title">Nazov</label>
                            <input type="text" class="form-control"
                                   name="nazov" placeholder="Zadajte nazov" value="<?php echo
                            !empty($post['nazov']) ? $post['nazov'] : ''; ?>">
                            <?php echo form_error('nazov', '<p
class="help-block text-danger">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="title">Telefon</label>
                            <input type="text" class="form-control"
                                   name="telefon" placeholder="Zadajte telefon" value="<?php echo
                            !empty($post['telefon']) ? $post['telefon'] : ''; ?>">
                            <?php echo form_error('telefon', '<p
class="help-block text-danger">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="text" class="form-control"
                                   name="email" placeholder="Zadajte email" value="<?php echo
                            !empty($post['email']) ? $post['email'] : ''; ?>">
                            <?php echo form_error('email', '<p class="helpblock
text-danger">', '</p>'); ?>
                        </div>
                        <input type="submit" name="postSubmit" class="btn
btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>