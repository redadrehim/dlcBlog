<!-- File: /app/View/Users/profile.ctp -->

<h1><?php echo h($user['User']['name']); ?></h1>
<p><?php echo h($user['User']['bio']); ?></p>
<h1><?php echo h($user['User']['name']); ?></h1>

<p><small>Created: <?php echo $user['User']['created']; ?></small></p>




<?php if($user['User']['role']=='admin'){ ?>
<?php echo $this->Html->link('List Posts', array('controller'=>'posts','action' => 'index')); ?><br/>
<?php echo $this->Html->link('List Users', array('controller'=>'users','action' => 'index')); ?><br/>

<?php } ?>
<?php if($user['User']['role']=='writer'){ ?>
<?php echo $this->Html->link('My Posts', array('controller'=>'posts','action' => 'my')); ?><br/>
<?php } ?>

<?php echo $this->Html->link('Edit My Profile', array('controller'=>'users','action' => 'editProfile')); ?><br/>
<?php echo $this->Html->link('Logout', array('controller'=>'users','action' => 'logout')); ?><br/>


