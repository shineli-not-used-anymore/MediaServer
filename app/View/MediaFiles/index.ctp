<table class="table media-files">
    <?php foreach ($list['folders'] as $folderPath): ?>
        <tr>
            <td>
                <?php echo substr($folderPath, strrpos($folderPath, '/') + 1); ?>
            </td>
            <td>
                <?php
                    echo $this->Form->create('MediaFile', array('action' => 'index', 'class' => 'form-inline'));
                    echo $this->Form->hidden('path', array('value' => $folderPath));
                    echo $this->Form->end(array(
                        'label' => __('open'),
                        'class' => 'btn',
                        'div' => false
                    ));
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php foreach ($list['files'] as $mediaFilePath): ?>
        <?php
            echo $this->element('media_file', array(
                'mediaFilePath' => $mediaFilePath,
                'playingFile' => $playingFile
            ));
        ?>
    <?php endforeach; ?>
</table>