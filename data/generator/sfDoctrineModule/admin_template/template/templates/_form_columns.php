<div class="contentbox sf_admin_form">
  [?php echo form_tag_for($form, '@article') ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
    [?php echo $form->renderHiddenFields(false) ?]
    <div class="left">
      [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
    </div>
    <div class="right">
      [?php foreach ($configuration->getFormFields($form, 'columns') as $fieldset => $fields): ?]
        [?php foreach ($fields as $name => $field): ?]
          [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
          <li>
            [?php include_partial('<?php echo $this->getModuleName() ?>/form_field', array(
              'name'       => $name,
              'attributes' => $field->getConfig('attributes', array()),
              'label'      => $field->getConfig('label'),
              'help'       => $field->getConfig('help'),
              'form'       => $form,
              'field'      => $field,
              'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_form_field_'.$name,
            )) ?]
          </li>
        [?php endforeach; ?]
      [?php endforeach; ?]
    </div>
    <div class="clear"></div>
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
  </form>
</div>