<?php
App::uses('AppController', 'Controller');
/**
 *
 * @author xiaoyangli
 * @property System $System
 */
Class SystemsController extends AppController {

/**
* shut_down system
*/
    public function shut_down() {
        $this->autoRender = false;
        $this->System->shutDown();
    }
}