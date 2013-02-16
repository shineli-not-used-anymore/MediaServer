<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

Class MediaFile extends AppModel {

    /**
     * do not use table
     * @var boolean
     */
    public $useTable = false;

    /**
     * base folder of all media files
     */
    private $baseFolder;

    /**
     * getter for $this->baseFolder
     *
     * @return Folder
     */
    private function getBaseFolder($path)
    {
        if (!$this->baseFolder) {
            $this->baseFolder = new Folder($path);
        }
        return $this->baseFolder;
    }

    /**
     * list all files
     * @param unknown $path
     */
    public function listAll($path = '/Users/xiaoyangli/Downloads') {
        $baseFolder = $this->getBaseFolder($path);
        return $baseFolder->findRecursive();
    }

    public function open($file) {
        shell_exec(
            'open -a /Applications/MPlayerX.app --args -file ' . $file . ' -StartByFullScreen YES'
        );
    }
}