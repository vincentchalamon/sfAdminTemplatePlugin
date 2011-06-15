<td colspan="<?php echo count($this->configuration->getValue('list.display')) + ($this->configuration->getValue('list.batch_actions') ? 1 : 0) ?>">
  <a href="#sf_admin_object_actions_[?php echo $i ?]" class="fancybox" title="[?php echo $<?php echo $this->getSingularName() ?> ?]"></a>
  <div id="sf_admin_object_actions_[?php echo $i ?]" class="sf_admin_object_actions_list">
    <ul class="sf_admin_td_actions">
  <?php foreach ($this->configuration->getValue('list.object_actions') as $name => $params): ?>
  <?php if ('_delete' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>

  <?php elseif ('_edit' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>

  <?php else: ?>
      <li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
        <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>

      </li>
  <?php endif; ?>
  <?php endforeach; ?>
    </ul>
  </div>
</td>