<?php if ($actions = $this->configuration->getValue('list.actions')): ?>
<ul class="sf_admin_list_actions">
<?php foreach ($actions as $name => $params): ?>
<?php if ('_new' == $name): ?>
<?php echo $this->addCredentialCondition('[?php echo $helper->linkToNew('.$this->asPhp($params).') ?]', $params)."\n" ?>
<?php else: ?>
<li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
[?php if (method_exists($helper, 'linkTo<?php echo $method = ucfirst(sfInflector::classify(preg_replace('/^_(.*)/i', '$1', $name))) ?>')): ?]
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkTo'.$method.'('.$this->asPhp($params).') ?]', $params) ?>

[?php else: ?]
  <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, false), $params)."\n" ?>

[?php endif; ?]
</li>
<?php endif; ?>
<?php endforeach; ?>
</ul>
<div style="clear: both"></div>
<?php endif; ?>
