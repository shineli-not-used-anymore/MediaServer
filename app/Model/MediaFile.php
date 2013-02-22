<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

Class MediaFile extends AppModel {

    const BASE_FOLDER_PATH = '/Volumes/pool_sparse_bundle/Downloads/片子/TV/NEW\ Season/';
    const BASE_FOLDER_PATH_DEV = '/Users/xiaoyangli/Downloads';

    /**
     * do not use table
     * @var boolean
     */
    public $useTable = false;

    /**
     * base folder of all media files
     */
    private $BaseFolder;

    private function getBasePath()
    {
        if (APPLICATION_ENV == 'development') {
            return self::BASE_FOLDER_PATH_DEV;
        }
        return self::BASE_FOLDER_PATH;
    }

    /**
     * getter for $this->baseFolder
     *
     * @return Folder
     */
    private function getBaseFolder()
    {
        if (!$this->BaseFolder) {
            $this->BaseFolder = new Folder($this->getBasePath());
        }
        return $this->BaseFolder;
    }

    /**
     * list all files
     * @param string $path
     */
    public function listAll($path = null) {
        $baseFolder = $this->getBaseFolder();

        if ($path) {
            $baseFolder->path = $path;
        }
        $filesAndFolders = $baseFolder->read(true, true, true);
        $folders = $filesAndFolders[0];
        $files = $filesAndFolders[1];
        $files = Hash::filter($files, function ($file) {
            return (preg_match('/.*\.(mp3|mpg|mp4|mkv|rmvb)/', $file));
        });
        return compact('files', 'folders');
    }

    /**
     * get the path of playing file
     */
    public function playingFile() {
        $PlayingMediaFile = new File(dirname(__DIR__) . DS . 'webroot' . DS . 'files' . DS . 'playing_media_file');
        return $PlayingMediaFile->read();
    }

    /**
     * open file
     * @param string $file
     */
    public function open($file) {
        $PlayingMediaFile = new File(dirname(__DIR__) . DS . 'webroot' . DS . 'files' . DS . 'playing_media_file');
        $PausedMediaFile = new File(dirname(__DIR__) . DS . 'webroot' . DS . 'files' . DS . 'paused_media_file');

        if ($PlayingMediaFile->read() == $file) {
            $command = "osascript -e 'tell application \"MPlayerX\" to pause'";
            exec($command);
            $PlayingMediaFile->write('');
            $PausedMediaFile->write($file);
        } else if ($PausedMediaFile->read() == $file) {
            $command = "osascript -e 'tell application \"MPlayerX\" to play'";
            exec($command);
            $PausedMediaFile->write('');
            $PlayingMediaFile->write($file);
        } else {
            // close MPlayerX
            $command = "osascript -e 'tell application \"MPlayerX\" to quit'";
            exec($command);
            sleep(1);
            // open MPlayerX with new file
            $command = 'open -a /Applications/MPlayerX.app --args -file ' . escapeshellarg($file) . ' -StartByFullScreen YES';
            exec($command);
            $PlayingMediaFile->write($file);
        }
    }
}