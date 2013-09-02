<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

Class MediaFile extends AppModel {

    const BASE_FOLDER_PATH = '/Volumes/pool/media';
    const BASE_FOLDER_PATH_DEV = '/Users/shineli/Downloads';

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
//        if (APPLICATION_ENV == 'development') {
            return self::BASE_FOLDER_PATH_DEV;
//        }
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
        $path = str_replace('<', DS, $path);
        $hash = Security::hash($path);
//        $results = Cache::read($hash);

//        if ($results) {
//            return $results;
//        }

        $baseFolder = $this->getBaseFolder();

        if ($path) {
            $baseFolder->path = $path;
        }
        $filesAndFolders = $baseFolder->read(true, true, true);
        $folders = array();

        foreach ($filesAndFolders[0] as $index => $folder) {
            $folders[] = array(
                'name' => substr($folder, strrpos($folder, '/') + 1),
                'path' => str_replace(DS, '<', $folder),
                'type' => 'folder'
            );
        }

        $files = array();
        $filesAndFolders[1] = Hash::filter($filesAndFolders[1], function ($file) {
            return (preg_match('/.*\.(mp4|mp3|mpg|mpeg|mkv|rmvb|avi)/', $file));
        });

        foreach ($filesAndFolders[1] as $index => $file) {
            $files[] = array(
                'name' => substr($file, strrpos($file, DS) + 1),
                'path' => $file,
                'type' => 'file'
            );
        }

        $results = array_merge($folders, $files);
        Cache::write($hash, $results);
        return $results;
    }

    /**
     * open file
     * @param string $file
     */
    public function open($file) {
        // close MPlayerX
        $this->quit();
        sleep(0.5);
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
