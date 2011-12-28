[?php if(count($fields)): ?]
  <fieldset id="sf_fieldset_[?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?]">
    [?php if ('NONE' != $fieldset): ?]
      <legend>[?php echo __($fieldset, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</legend>
    [?php endif; ?]
    [?php foreach ($fields->getRawValue() as $name => $field): ?]
      [?php if ($field->getName() == "id") continue ?]
      [?php if ($field->isPartial()): ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
      [?php elseif ($field->isComponent()): ?]
        [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
      [?php else: ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/show_field', array(
          'name'       => $name,
          'label'      => $field->getConfig('label'),
          'value'      => $configuration->retrieveValue($<?php echo $this->getSingularName() ?>->getRawValue(), $field->getName()),
          '<?php echo $this->getSingularName() ?>'      => $<?php echo $this->getSingularName() ?>,
          'class'      => 'sf_admin_show_row sf_admin_'.strtolower($field->getConfig('type')).' sf_admin_show_field_'.$name,
        )) ?]
      [?php endif ?]
    [?php endforeach; ?]
  </fieldset>
[?php endif ?]