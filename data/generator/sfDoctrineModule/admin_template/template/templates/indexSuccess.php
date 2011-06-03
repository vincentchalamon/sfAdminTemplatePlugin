<script type="text/javascript">
  $(document).ready(function(){
    if($('.contentbox tfoot select[name=batch_action] option').length <= 1) {
      $('.contentbox tfoot select[name=batch_action]').remove().next('input:submit').remove();
      $('.contentbox tfoot input:submit, .contentbox tfoot input:hidden').remove();
    }
  });
</script>
[?php use_helper('I18N', 'Date') ?]
[?php $sf_response->addMeta('title', 'Administration | '.<?php echo $this->getI18NString('list.title') ?>) ?]
[?php slot('breadcrumb', array(array('url' => '@<?php echo $this->params['route_prefix'] ?>', 'label' => <?php echo $this->getI18NString('list.title') ?>))) ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

<?php if ($this->configuration->hasFilterForm()): ?>
<div class="contentcontainer sml right">
  [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration)) ?]
</div>
<div class="contentcontainer med left">
<?php else: ?>
<div class="contentcontainer">
<?php endif ?>
  <div class="headings">
    <h2>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</h2>
  </div>

  [?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager)) ?]
  
  <div class="contentbox">
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
    <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'batch')) ?]" method="post">
<?php endif; ?>
    [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?]
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
    </form>
<?php endif; ?>
  </div>

  [?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager)) ?]
</div>
<div style="clear: both;"></div>
