<table class="table media-files">
    <?php foreach ($list['folders'] as $folderPath): ?>
        <tr>
            <td>
                <?php echo substr($folderPath, strrpos($folderPath, '/') + 1); ?>
            </td>
            <td>
                <a href="/media_files/index/?folderPath=<?php echo $folderPath;?>" class="btn"><?php echo __('open');?></a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php foreach ($list['files'] as $mediaFilePath): ?>
        <?php
            echo $this->element('media_file', array(
                'mediaFilePath' => $mediaFilePath
            ));
        ?>
    <?php endforeach; ?>
</table>