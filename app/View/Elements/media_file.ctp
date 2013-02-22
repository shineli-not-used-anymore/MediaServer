<?php $file = new File($mediaFilePath); ?>
        <tr>
            <td><?php echo h($file->name());?></td>
            <td>
                <?php
                    echo $this->Form->create('MediaFile', array('action' => 'play', 'class' => 'form-inline'));
                    echo $this->Form->hidden('path', array('value' => $mediaFilePath));
                    echo $this->Form->end(array(
                        'label' => __('play'),
                        'class' => 'btn',
                        'div' => false
                    ));
                    $file = null;
                ?>
            </td>
        </tr>