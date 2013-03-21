<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

Class MediaFile extends AppModel {

    const BASE_FOLDER_PATH = '/Volumes/pool_sparse_bundle/Downloads';
    const BASE_FOLDER_PATH_DEV = '/Users/lixiaoyang/Downloads';

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
            return (preg_match('/.*\.(mp4|mp3|mpg|mpeg|mkv|rmvb|avi)/', $file));
        });
        return compact('files', 'folders');
    }

    /**
     * open file
     * @param string $file
     */
    public function open($file) {
        // close MPlayerX
        $command = "osascript -e 'tell application \"MPlayerX\" to quit'";
        exec($command);
        sleep(1);
        // open MPlayerX with new file
        $command = 'open -a /Applications/MPlayerX.app --args -file ' . escapeshellarg($file) . ' -StartByFullScreen YES';
        exec($command);
    }

    public function quit()
    {
        sleep(0.5);
        $command = "osascript -e 'tell application \"MPlayerX\" to quit'";
        exec($command);
    }
}
