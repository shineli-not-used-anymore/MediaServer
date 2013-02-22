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
        $list = $this->MediaFile->listAll($this->request->data('MediaFile.path'));
        $playingFile = $this->MediaFile->playingFile();
        $this->set(compact('list', 'pausedFile', 'playingFile'));
    }

    /**
     * play media file
     */
    public function play()
    {
        $this->layout = '';
        $mediaFilePath = $this->request->data('MediaFile.path');
        $this->MediaFile->open($mediaFilePath);
        $this->redirect($this->referer());
    }
}