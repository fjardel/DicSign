<?php
App::uses('AppController', 'Controller');

class AdministratorsController extends AppController {
    public $helpers = array('Html', 'Form');
    public $name = "Administrators";
	
     public function beforeFilter() {
        parent::beforeFilter();
        
        if ($this->request->is('mobile')) {
            $this->redirect("/");
        }
        // Allow users to register and logout.
        $this->Auth->allow('add','login', 'logout');
        $this->Auth->deny('index');
    }
    
    public function index() {
        
    }
    public function login() {
        if(isset($this->Auth->authError)): 
            $this->set('nome',$this->Auth->user('nome'));
        endif;
        
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Administrator->create();
            if ($this->Administrator->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }
    
    public function edit($id = null) {
        $this->layout = "admdefault"; 
        
        $this->set("");
    }
    
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}
