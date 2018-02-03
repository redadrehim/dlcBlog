<!-- File: /app/View/Users/edit.ctp -->

<h1>Edit User</h1>
<?php
    echo $this->Form->create('User', array('action' => 'reset'));
    echo $this->Form->input('old_password',array('type' => 'password'));
    echo $this->Form->input('password',array('type' => 'password'));
    echo $this->Form->input('confirm_password',array('type' => 'password'));
    echo $this->Form->end('Reset Password');