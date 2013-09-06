<?php
App::uses('AppController', 'Controller');
/**
 *
 * @author xiaoyangli
 * @property MediaFile $MediaFile
 */
Class MediaFilesController extends AppController {

    public function beforeFilter()
    {
        $this->set('rootUrl', '/media_files/index');
    }

    /**
     * list all the media files
     */
    public function index($path = null) {
        $list = $this->MediaFile->listAll($path);
        $this->set(compact('list', 'pausedFile'));
//        $this->response->cache('-1 minute', '+999 days');
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
