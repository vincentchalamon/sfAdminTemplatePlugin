[?php if (count($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit')) > 1): ?]
  [?php use_javascript(public_path('/js/jqueryui/jquery-ui-1.8.4.custom.min.js')) ?]
  <script type="text/javascript">
    $(document).ready(function(){
      $("#tabs").tabs({
        select: function(event, ui){
          $('.jqTransformInputWrapper', ui.panel).each(function(){
            if($('input:text', $(this)).length && $('input:text:first', $(this)).attr('largeur')) {
              $(this).width($('input:text:first', $(this)).attr('largeur'));
            }
          });
        },
        show: function(event, ui){
          $('.formError').remove();
          $('.jqTransformInputWrapper', ui.panel).each(function(){
            if($('input:text', $(this)).length && $('input:text:first', $(this)).attr('largeur')) {
              $(this).animate({width: $('input:text:first', $(this)).attr('largeur')});
            }
          });
        }
      });
    });
  </script>
[?php endif ?]
<script type="text/javascript">
  $(document).ready(function(){
    $(".contentbox fieldset").each(function(){
      $('.jqTransformInputWrapper', $(this)).width('100%');
      if(!$(".sf_admin_form_row", $(this)).length) {
        $('a[href=#' + $(this).attr('id') + ']').parent().remove();
      }
    });
  });
</script>
[?php use_helper('I18N', 'Date') ?]
[?php $sf_response->addMeta('title', 'Administration | '.<?php echo $this->getI18NString('list.title') ?>.' | '.<?php echo $this->getI18NString('new.title') ?>) ?]
[?php slot('breadcrumb', array(array('url' => '@<?php echo $this->params['route_prefix'] ?>', 'label' => <?php echo $this->getI18NString('list.title') ?>), array('url' => '@<?php echo $this->params['route_prefix'] ?>_new', 'label' => <?php echo $this->getI18NString('new.title') ?>))) ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

<div class="contentcontainer" id="tabs">
  <div class="headings">
    <h2>
      [?php echo <?php echo $this->getI18NString('new.title') ?> ?]
      [?php if (count($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit')) > 1): ?]
        <ul class="smltabs">
          [?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
            <li><a href="#sf_fieldset_[?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?]">[?php echo $fieldset ?]</a></li>
          [?php endforeach ?]
        </ul>
      [?php endif ?]
    </h2>
  </div>

  [?php include_partial('<?php echo $this->getModuleName() ?>/form_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]

  <div class="contentbox">
    [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
  </div>

  [?php include_partial('<?php echo $this->getModuleName() ?>/form_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
</div>
