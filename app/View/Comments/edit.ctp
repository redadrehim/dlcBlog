<!-- File: /app/View/Comment/edit.ctp -->

<h1>Edit Comment</h1>
<?php
    echo $this->Form->create('Comment', array('action' => 'edit'));
    echo $this->Form->input('body', array('rows' => '3'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->input('post_id', array('type' => 'hidden'));
    echo $this->Form->end('Save Comment');