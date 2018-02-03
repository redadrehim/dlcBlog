<?php
// app/Controller/UsersController.php
class UsersController extends AppController {

    public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('register'); // Letting users register themselves
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }

    public function testLogin() {

        $this->Users = $this->generate('Users', array(
            'components' => array(
                'Security' => array('_validatePost'),
            )
        ));
        $this->Users->Security->expects($this->any())
             ->method('_validatePost')
             ->will($this->returnValue(true));

        $user = array();
        $user['User']['username'] = 'admin1';
        $user['User']['password'] = 'admin1';

        $result = $this->testAction('/users/login',
            array('data' => $user, 'method' => 'post', 'return' => 'contents')
        );

        debug( $this->contents); 
        //OUTPUTS: I get "Invalid username or password, try again"
        //EXPECTED: A successful login message since I provided the correct credentials

    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function profile() {
        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function editProfile() {
        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['User']['id']=$this->Auth->user('id');
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Your Data Has Been Updated'));
                $this->redirect(array('action' => 'profile'));
            } else {
                $this->Session->setFlash(__('Error Occured. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }


    public function reset() {
        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if($this->request->data['User']['password']==$this->request->data['User']['confirm_password']){
                $this->request->data['User']['id']=$this->Auth->user('id');
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('Password Reset'));
                    $this->redirect(array('action' => 'profile'));
                } else {
                    $this->Session->setFlash(__('Error Occured. Please, try again.'));
                }
            }else{

            }
            
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function register() {
        if ($this->request->is('post')) {
            if($this->request->data['User']['password']==$this->request->data['User']['confirm_password']){
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('Thank you for Registration'));
                    $this->redirect(array('action' => 'view','id'=>1));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            }
            }else{
                $this->Session->setFlash(__('Password Not Match.'));
            }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}