<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div id="container">
<div class="<?= h($class) ?>"><p><?= h($message) ?></p></div>
</div>