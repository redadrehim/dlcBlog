<!-- File: /app/View/Comments/add.ctp -->

<h1>Add Comment</h1>
<?php
echo $this->Form->create('Comment');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->input('post_id', array('type'=>'hidden','value'=>$post_id));

echo $this->Form->end('Save Comment');
?>