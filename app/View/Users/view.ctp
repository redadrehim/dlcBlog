<!-- File: /app/View/Users/view.ctp -->

<h1><?php echo h($user['User']['name']); ?></h1>
<p><?php echo h($user['User']['bio']); ?></p>

<p><small>Created: <?php echo $user['User']['created']; ?></small></p>
