<table class="table media-files">
    <?php foreach ($list as $mediaFilePath): ?>
        <?php
            echo $this->element('media_file', array(
                'mediaFilePath' => $mediaFilePath,
                'playingFile' => $playingFile
            ));
        ?>
    <?php endforeach; ?>
</table>