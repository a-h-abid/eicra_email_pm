<?php
use Eicra\Jira\StatusCode;
?>
<h1>My Jira Issues Test</h1>

<?php if (isset($errors)) : ?>

<p class="text-danger"><?php echo $errors ?></p>

<?php else : ?>

<ol>
<?php foreach ($issues as $issue) : ?>

<li><strong><?php echo $issue->key ?></strong> -> <?php echo $issue->summary ?> <em>(<?php echo StatusCode::getStatus($issue->status) ?>)</em></li>

<?php endforeach; ?>
</ol>

<?php var_dump($issues); ?>

<?php endif; ?>
