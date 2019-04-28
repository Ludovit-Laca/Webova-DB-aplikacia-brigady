<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Detaily zamestnavatela<a href="<?php
                echo site_url('zamestnavatelia/'); ?>" class="glyphicon glyphicon-arrow-left
pull-right"></a></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Nazov:</label>
                    <p><?php echo
                        !empty($zamestnavatelia['nazov']) ? $zamestnavatelia['nazov']
                            : ''; ?></p>
                </div>
                <div class="form-group">
                    <label>Telefon:</label>
                    <p><?php echo
                        !empty($zamestnavatelia['telefon']) ? $zamestnavatelia['telefon'] : ''; ?> </p>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <p><?php echo
                        !empty($zamestnavatelia['email']) ? $zamestnavatelia['email'] : ''; ?> </p>
                </div>
            </div>
        </div>
    </div>
</div>