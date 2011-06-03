[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
  [?php $attributes = $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes ?]
  [?php if($form[$name]->hasError()): ?]
    [?php if(isset($attributes['class'])) $attributes['class'].= ' errorbox'; else $attributes['class'] = 'errorbox' ?]
  [?php endif ?]
  <p class="[?php echo $class ?][?php $form[$name]->hasError() and print ' errors' ?]">
    [?php echo $form[$name]->renderLabel($label, $form[$name]->hasError() ? array('class' => 'red') : array()) ?]
    [?php echo preg_replace('/\<br \/\>/i', '', $form[$name]->render($attributes)) ?]
    [?php if ($help): ?]
      <span class="smltxt">[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</span>
    [?php elseif ($help = $form[$name]->renderHelp()): ?]
      <span class="smltxt">[?php echo $help ?]</span>
    [?php endif; ?]
    [?php if($form[$name]->hasError()): ?]
      <span class="smltxt red">[?php echo $form[$name]->renderError() ?]</span>
    [?php endif ?]
  </p>
[?php endif; ?]
