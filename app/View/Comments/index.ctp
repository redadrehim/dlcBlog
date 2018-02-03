<!-- File: /app/View/Comments/index.ctp -->

<h1>Blog Comments</h1>
<p><?php echo $this->Html->link('Add Comment', array('action' => 'add',$post_id)); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Comment</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $comments array, printing out comment info -->

    <?php foreach ($comments as $comment): ?>
    <tr>
        <td><?php echo $comment['Comment']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($comment['Comment']['body'], array('action' => 'view', $comment['Comment']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $comment['Comment']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $comment['Comment']['id'])); ?>
            <?php echo $this->Html->link('View', array('action' => 'view', $comment['Comment']['id'])); ?>
        </td>
        <td>
            <?php echo $comment['Comment']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>