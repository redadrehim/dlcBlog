<?php
class Comment extends AppModel {
    public $validate = array(
        
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
    public function isOwnedBy($comment, $user) {
    	return $this->field('id', array('id' => $comment, 'user_id' => $user)) === $comment;
	}
}