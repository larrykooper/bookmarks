<?php
App::uses('AppController', 'Controller');
/**
 * URLs Controller
 *
 * @property URL $URL
 * @property PaginatorComponent $Paginator
 */
class URLsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->URL->recursive = 0;
		$this->set('uRLs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->URL->exists($id)) {
			throw new NotFoundException(__('Invalid u r l'));
		}
		$options = array('conditions' => array('URL.' . $this->URL->primaryKey => $id));
		$this->set('uRL', $this->URL->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->URL->create();
			if ($this->URL->save($this->request->data)) {
				$this->Session->setFlash(__('The u r l has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The u r l could not be saved. Please, try again.'));
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
		if (!$this->URL->exists($id)) {
			throw new NotFoundException(__('Invalid u r l'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->URL->save($this->request->data)) {
				$this->Session->setFlash(__('The u r l has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The u r l could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('URL.' . $this->URL->primaryKey => $id));
			$this->request->data = $this->URL->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->URL->id = $id;
		if (!$this->URL->exists()) {
			throw new NotFoundException(__('Invalid u r l'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->URL->delete()) {
			$this->Session->setFlash(__('The u r l has been deleted.'));
		} else {
			$this->Session->setFlash(__('The u r l could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}