<?php $file = new File($mediaFilePath); ?>
        <tr>
            <td><?php echo h($file->name());?></td>
            <td>
                <a href="/media_files/play/?mediaFilePath=<?php echo $mediaFilePath;?>" class="btn"><?php echo __('play');?></a>
                <?php $file = null; ?>
            </td>
        </tr>