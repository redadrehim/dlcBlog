<!-- app/View/Users/register.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Sign Up'); ?></legend>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('confirm_password',array('type' => 'password'));
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'writer' => 'Writer')
        ));
        echo $this->Form->input('name');
        echo $this->Form->input('bio', array('rows' => '3'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>