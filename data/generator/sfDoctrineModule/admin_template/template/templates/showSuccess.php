<script type="text/javascript">
  $(document).ready(function(){
    $(".contentbox fieldset").each(function(){
      $('.jqTransformInputWrapper', $(this)).width('100%');
      if(!$(".sf_admin_show_row", $(this)).length) {
        $('a[href=#' + $(this).attr('id') + ']').parent().remove();
      }
    });
    $(".contentbox fieldset").each(function(){
      if(!$(".sf_admin_show_row", $(this)).length) {
        $(this).remove();
      }
    });
  });
</script>
[?php use_helper('I18N', 'Date') ?]
[?php $sf_response->addMeta('title', 'Administration | '.<?php echo $this->getI18NString('list.title') ?>.' | '.<?php echo $this->getI18NString('show.title') ?>) ?]
[?php slot('breadcrumb', array(array('url' => '@<?php echo $this->params['route_prefix'] ?>', 'label' => <?php echo $this->getI18NString('list.title') ?>), array('url' => '@<?php echo $this->params['route_prefix'] ?>_show?id='.$sf_request->getParameter('id'), 'label' => <?php echo $this->getI18NString('show.title') ?>))) ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

<div class="contentcontainer">
  <div class="headings">
    <h2>[?php echo <?php echo $this->getI18NString('show.title') ?> ?]</h2>
  </div>

  [?php include_partial('<?php echo $this->getModuleName() ?>/show_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'configuration' => $configuration)) ?]

  <div class="contentbox">
    [?php include_partial('<?php echo $this->getModuleName() ?>/show', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'configuration' => $configuration, 'helper' => $helper)) ?]
  </div>
  
  [?php include_partial('<?php echo $this->getModuleName() ?>/show_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'configuration' => $configuration)) ?]
</div>
