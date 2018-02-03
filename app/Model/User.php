<?php
// app/Model/User.php
class User extends AppModel {
    public $name = 'User';
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'writer')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
    
    public function beforeSave() {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
            $this->data[$this->alias]['confirm_password'] = AuthComponent::password($this->data[$this->alias]['confirm_password']);
            $this->data[$this->alias]['old_password'] = AuthComponent::password($this->data[$this->alias]['old_password']);
            $this->data[$this->alias]['new_password'] = AuthComponent::password($this->data[$this->alias]['new_password']);
	    }
	    return true;
	}

}