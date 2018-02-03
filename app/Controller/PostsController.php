<?php
class PostsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session','RequestHandler');
/*
    public function isAuthorized($user) {
    	die($user);
	    // All registered users can add posts
	    if ($this->action === 'add') {
	        return true;
	    }

	    // The owner of a post can edit and delete it
	    if (in_array($this->action, array('edit', 'delete'))) {
	        $postId = $this->request->params['pass'][0];
	        if ($this->Post->isOwnedBy($postId, $user['id'])) {
	            return true;
	        }
	    }

	    return parent::isAuthorized($user);
	}
	*/
	public function beforeFilter() {
    	parent::beforeFilter();
    	$this->Auth->allow('add');
    	$this->Auth->allow('list');
    	//$this->Auth->allow('view'); // Letting users register themselves
    }

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function list() {
    	$posts = $this->Post->find('all');
        $this->set(array(
            'posts' => $posts,
            '_serialize' => array('posts')
        ));
         
    }

    

    public function my() {
        $this->set('posts', $this->Post->find('all',array('conditions' => array('Post.user_id' => $this->Auth->user('id')))));
    }

    public function view($id) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());

    }

    public function add() {

        if ($this->request->is('post')) {
        	$this->request->data['Post']['user_id'] = $this->Auth->user('id'); //Added this line
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
				if($this->Auth->user('role')=='admin'){
					$this->redirect(array('action' => 'index'));
				}else{
					$this->redirect(array('action' => 'my'));
				}
                
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
    }

    public function edit($id = null) {
	    $this->Post->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Post->read();
	    } else {
	        if ($this->Post->save($this->request->data)) {
	            $this->Session->setFlash('Your post has been updated.');
	            if($this->Auth->user('role')=='admin'){
					$this->redirect(array('action' => 'index'));
				}else{
					$this->redirect(array('action' => 'my'));
				}
	        } else {
	            $this->Session->setFlash('Unable to update your post.');
	        }
	    }
	}

	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Post->delete($id)) {
	        $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
	        if($this->Auth->user('role')=='admin'){
					$this->redirect(array('action' => 'index'));
				}else{
					$this->redirect(array('action' => 'my'));
				}
	    }
	}
}