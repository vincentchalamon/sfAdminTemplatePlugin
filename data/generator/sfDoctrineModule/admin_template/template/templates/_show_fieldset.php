[?php if(count($fields)): ?]
  <fieldset id="sf_fieldset_[?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?]">
    [?php if ('NONE' != $fieldset): ?]
      <legend>[?php echo __($fieldset, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</legend>
    [?php endif; ?]
    [?php foreach ($fields->getRawValue() as $name => $options): ?]
      [?php if ($name == "id") continue ?]
      [?php if (preg_match('/^_.*/i', $name)): ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/'.substr($name, 1), array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
      [?php elseif (preg_match('/^~.*/i', $name)): ?]
        [?php include_component('<?php echo $this->getModuleName() ?>', substr($name, 1), array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
      [?php else: ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/show_field', array(
          'name'       => $name,
          'label'      => $options['label'],
          'value'      => $options['value'],
          '<?php echo $this->getSingularName() ?>'      => $<?php echo $this->getSingularName() ?>,
          'class'      => 'sf_admin_show_row sf_admin_'.strtolower($options['type']).' sf_admin_show_field_'.$name,
        )) ?]
      [?php endif ?]
    [?php endforeach; ?]
  </fieldset>
[?php endif ?]