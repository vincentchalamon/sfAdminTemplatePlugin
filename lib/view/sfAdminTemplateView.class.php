<?php

class sfAdminTemplateView extends sfPHPView
{
  public function configure() {
    parent::configure();
    // Use admin theme
    if(preg_match('/^(admin|clean)/i', $this->getDecoratorTemplate(), $matches)) {
      $response = $this->context->getResponse();
      //$response = new sfWebResponse();
      $this->decoratorDirectory = sfConfig::get('sf_plugins_dir').DIRECTORY_SEPARATOR."sfAdminTemplatePlugin".DIRECTORY_SEPARATOR."templates";
      $this->decorator = true;
      // Stylesheets
      $stylesheets = array('/sfAdminTemplatePlugin/css/layout.css', '/sfAdminTemplatePlugin/css/styles.css', '/sfAdminTemplatePlugin/js/jqtransformplugin/jqtransform.css');
      foreach($stylesheets as $css) {
        $response->addStylesheet($css, 'first', array('media' => 'all'));
      }
      // Javascripts
      $javascripts = is_dir(sfConfig::get('sf_plugins_dir').'/sfEPFactoryFormPlugin') ? array('/sfEPFactoryFormPlugin/js/jquery.min.js') : array('/sfAdminTemplatePlugin/js/jquery-1.5.1.min.js');
      $javascripts[] = '/sfAdminTemplatePlugin/js/jqtransformplugin/jquery.jqtransform.js';
      $javascripts[] = '/sfAdminTemplatePlugin/js/admin.js';
      foreach($javascripts as $js) {
        $response->addJavascript($js, preg_match('/(jquery\.min\.js|jquery\-1\.5\.1\.min\.js)/i', $js) ? 'first' : '');
      }
      // Load template
      if($response->getStatusCode() != 200) {
        $this->decoratorTemplate = "clean".$this->getExtension();
        $response->addStylesheet('/sfAdminTemplatePlugin/css/login.css', '', array('media' => 'all'));
      }
      else {
        $this->decoratorTemplate = $this->getDecoratorTemplate();
      }
    }
  }
}