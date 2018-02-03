<!-- File: /app/View/Users/edit.ctp -->

<h1>Edit User</h1>
<?php
    echo $this->Form->create('User', array('action' => 'edit'));
    echo $this->Form->input('name');
    echo $this->Form->input('bio', array('rows' => '3'));
    echo $this->Form->end('Save User');