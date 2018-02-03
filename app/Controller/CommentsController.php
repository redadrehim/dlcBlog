<?php
class CommentsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
/*
    public function isAuthorized($user) {
	    // All registered users can add Comments
	    if ($this->action === 'add') {
	        return true;
	    }

	    // The owner of a comment can edit and delete it
	    if (in_array($this->action, array('edit', 'delete'))) {
	        $commentId = $this->request->params['pass'][0];
	        if ($this->Comment->isOwnedBy($commentId, $user['id'])) {
	            return true;
	        }
	    }

	    return parent::isAuthorized($user);
	}
*/
	public function beforeFilter() {
    	parent::beforeFilter();
    	$this->Auth->allow('add','index','delete','edit');
    	//$this->Auth->allow('view'); // Letting users register themselves
    }
    public function index($id) {
        //$this->set('comments', $this->Comment->find('all'));
        $this->set('comments', $this->Comment->find('all',array('conditions' => array('Comment.post_id' => $id))));
        $this->set('post_id', $id);
    }

    public function view($id) {
        $this->Comment->id = $id;
        $this->set('comment', $this->Comment->read());

    }

    public function add($post_id = null) {
    	$this->set('post_id', $post_id);
    	if ($this->request->is('Post')) {
        	$this->request->data['Comment']['user_id'] = $this->Auth->user('id'); //Added this line
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash('Your comment has been saved.');
                $this->redirect(array('action' => 'index',$post_id ));
            } else {
                $this->Session->setFlash('Unable to add your Comment.');
            }
        }

	}

    public function edit($id = null) {
	    $this->Comment->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Comment->read();
	    } else {
	    	//print_r($this->request->data);
	        if ($this->Comment->save($this->request->data)) {
	            $this->Session->setFlash('Your comment has been updated.');
	            $this->redirect(array('action' => 'index',$this->request->data['Comment']['post_id']));
	        } else {
	            $this->Session->setFlash('Unable to update your comment.');
	        }
	    }
	}

	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    $this->Comment->id = $id;
	    $comment=$this->Comment->read();
	    if($this->Auth->user('role')=='writer' && $this->Auth->user('id') !=$comment['Comment']['user_id']){
	    	$this->Session->setFlash('You are not the owner of this Post and you are not Admin');
	    	$this->redirect(array('action' => 'index',$comment['Comment']['post_id']));
	    }else{
	    	if ($this->Comment->delete($id)) {
	        	$this->Session->setFlash('The comment with id: ' . $id . ' has been deleted.');
	        	$this->redirect(array('action' => 'index',$comment['Comment']['post_id']));
	    		}
	    	}
	    
	}
}