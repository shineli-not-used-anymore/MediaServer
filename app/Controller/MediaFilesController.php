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
        $list = $this->MediaFile->listAll($this->request->query('folderPath'));
        $this->set(compact('list', 'pausedFile'));
    }

    /**
     * play media file
     */
    public function play()
    {
        $this->layout = '';
        $this->MediaFile->open($this->request->query('mediaFilePath'));
        $this->redirect(array('action' => 'index'));
    }

    public function play_or_pause()
    {
        $this->MediaFile->playOrPause();
        $this->redirect($this->request->referer());
    }
}