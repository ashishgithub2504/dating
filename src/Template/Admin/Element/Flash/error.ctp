<?php
$class = 'alert alert-danger';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="<?= h($class) ?> alert-dismissable" onclick="this.classList.add('hidden');" style="border-radius:0px;margin-bottom:5px;">
<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>
<i class="icon fa fa-ban"></i>
<?= h($message) ?>
</div>
