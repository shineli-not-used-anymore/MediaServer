<td>{{this.name}}</td>
<td>
    <a data-bypass href="<?php echo Router::url(array('controller' => 'media_files', 'action' => 'play')); ?>?mediaFilePath={{{this.path}}}" class="btn play"><?php echo __('play'); ?></a>
</td>