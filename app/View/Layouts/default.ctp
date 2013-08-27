<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <meta name="viewport" content="width=device-width">
    <?php
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('bootstrap-responsive.min');
        echo $this->Html->css('styles');
    ?>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li class="quit"><?php echo $this->Html->link(__('Stop'), array('controller' => 'media_files', 'action' => 'quit')); ?></li>
                    <li class="shut-down"><?php echo $this->Html->link('Shut down', array('controller' => 'systems', 'action' => 'shut_down')); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="main">
        <div class="container">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>

    <script>
        window.controller = '<?php echo $this->request->controller; ?>';
    </script>

    <?php
        echo $this->Html->script('vendor/require', array(
            'data-main' => '/js/script'
        ));
    ?>
    <?php //echo $this->fetch('script'); ?>
</body>
</html>
