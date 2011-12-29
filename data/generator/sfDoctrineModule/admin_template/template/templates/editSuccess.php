<script type="text/javascript">
  $(document).ready(function(){
    $(".contentbox fieldset").each(function(){
      $('.jqTransformInputWrapper', $(this)).width('100%');
      if(!$(".sf_admin_form_row", $(this)).length) {
        $('a[href=#' + $(this).attr('id') + ']').parent().remove();
      }
    });
    $(".sf_admin_form fieldset").each(function(){
      if(!$(".sf_admin_form_row", $(this)).length) {
        $(this).remove();
      }
    });
  });
</script>
[?php use_helper('I18N', 'Date') ?]
[?php $sf_response->addMeta('title', 'Administration | '.<?php echo $this->getI18NString('list.title') ?>.' | '.<?php echo $this->getI18NString('edit.title') ?>) ?]
[?php slot('breadcrumb', array(array('url' => '@<?php echo $this->params['route_prefix'] ?>', 'label' => <?php echo $this->getI18NString('list.title') ?>), array('url' => '@<?php echo $this->params['route_prefix'] ?>_edit?id='.$sf_request->getParameter('id'), 'label' => <?php echo $this->getI18NString('edit.title') ?>))) ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

<div class="contentcontainer">
  <div class="headings">
    <h2>[?php echo <?php echo $this->getI18NString('edit.title') ?> ?]</h2>
  </div>
  
  [?php include_partial('<?php echo $this->getModuleName() ?>/form_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]

  [?php include_partial('<?php echo $this->getModuleName() ?>/form_'.$configuration->getEditTemplate(), array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
</div>
