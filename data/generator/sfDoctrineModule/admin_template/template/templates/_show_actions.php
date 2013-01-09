<ul class="sf_admin_actions">
<?php foreach ($this->configuration->getValue('show.actions') as $name => $params): ?>
<?php if ('_delete' == $name): ?>
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>

<?php elseif ('_list' == $name): ?>
  <?php echo $this->addCredentialCondition('[?php echo !$sf_request->isXmlHttpRequest() ? $helper->linkToList('.$this->asPhp($params).') : null ?]', $params) ?>

<?php elseif ('_edit' == $name): ?>
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>

<?php elseif ('_new' == $name): ?>
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkToNew('.$this->asPhp($params).') ?]', $params)."\n" ?>

<?php else: ?>
  <li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
[?php if (is_callable(array($helper, 'linkTo<?php echo $method = ucfirst(sfInflector::classify(preg_replace('/^_(.*)/i', '$1', $name))) ?>'))): ?]
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkTo'.$method.'($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>

[?php else: ?]
  <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>

[?php endif; ?]
  </li>
<?php endif; ?>
<?php endforeach; ?>
</ul>
<div class="clear"></div>