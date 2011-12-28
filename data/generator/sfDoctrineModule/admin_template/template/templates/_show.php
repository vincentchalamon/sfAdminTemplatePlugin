<div class="sf_admin_show">
  [?php foreach ($configuration->getShowFields($<?php echo $this->getSingularName() ?>->getRawValue()) as $fieldset => $fields): ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/show_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'configuration' => $configuration, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
  [?php endforeach; ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/show_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'configuration' => $configuration, 'helper' => $helper)) ?]
</div>
