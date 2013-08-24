<?php
App::uses('AppController', 'Controller');
/**
 *
 * @author xiaoyangli
 * @property MediaFile $MediaFile
 */
Class MediaFilesController extends AppController {

    /**
     * list all the media files
     */
    public function index() {

        if ($this->request->is('ajax')) {
            $list = $this->MediaFile->listAll($this->request->query('folderPath'));
            $this->set(compact('list', 'pausedFile'));
        }
    }

    /**
     * play media file
     */
    public function play()
    {
        $this->layout = '';
        $this->MediaFile->open($this->request->query('mediaFilePath'));
        $this->autoRender = false;
    }

    public function quit()
    {
        $this->MediaFile->quit();
        $this->autoRender = false;
    }
}
