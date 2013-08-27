<?php
App::uses('AppController', 'Controller');

class TemplatesController extends AppController {

    public function view($template)
    {
        $this->autoLayout = false;
        $this->set(compact('template'));
    }
}
