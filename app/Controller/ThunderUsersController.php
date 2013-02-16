<?php
App::uses('AppController', 'Controller');
/**
 * ThunderUsers Controller
 *
 * @property ThunderUser $ThunderUser
 */
class ThunderUsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ThunderUser->recursive = 0;
		$this->set('thunderUsers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ThunderUser->exists($id)) {
			throw new NotFoundException(__('Invalid thunder user'));
		}
		$options = array('conditions' => array('ThunderUser.' . $this->ThunderUser->primaryKey => $id));
		$this->set('thunderUser', $this->ThunderUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ThunderUser->create();
			if ($this->ThunderUser->save($this->request->data)) {
				$this->Session->setFlash(__('The thunder user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The thunder user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ThunderUser->exists($id)) {
			throw new NotFoundException(__('Invalid thunder user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ThunderUser->save($this->request->data)) {
				$this->Session->setFlash(__('The thunder user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The thunder user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ThunderUser.' . $this->ThunderUser->primaryKey => $id));
			$this->request->data = $this->ThunderUser->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ThunderUser->id = $id;
		if (!$this->ThunderUser->exists()) {
			throw new NotFoundException(__('Invalid thunder user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ThunderUser->delete()) {
			$this->Session->setFlash(__('Thunder user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Thunder user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
