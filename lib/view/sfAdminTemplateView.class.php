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
      foreach($response->getStylesheets() as $file => $options) {
        $response->removeStylesheet($file);
      }
      $stylesheets = array('/sfAdminTemplatePlugin/css/layout.css', '/sfAdminTemplatePlugin/css/styles.css', '/sfAdminTemplatePlugin/js/jqtransformplugin/jqtransform.css', '/sfAdminTemplatePlugin/js/validationEngine/validationEngine.jquery.css');
      foreach($stylesheets as $css) {
        $response->addStylesheet($css, '', array('media' => 'all'));
      }
      // Javascripts
      foreach($response->getJavascripts() as $file => $options) {
        $response->removeJavascript($file);
      }
      $javascripts = array('/sfAdminTemplatePlugin/js/jquery-1.5.1.min.js', '/sfAdminTemplatePlugin/js/jqtransformplugin/jquery.jqtransform.js', '/sfAdminTemplatePlugin/js/jquery.maskedinput-1.2.2.min.js', '/sfAdminTemplatePlugin/js/validationEngine/jquery.validationEngine-fr.js', '/sfAdminTemplatePlugin/js/validationEngine/jquery.validationEngine.js', '/sfAdminTemplatePlugin/js/admin.js');
      foreach($javascripts as $js) {
        $response->addJavascript($js);
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

 /* protected function decorate($content) {
    if(preg_match('/^admin/i', $this->getDecoratorTemplate())) {
      //sfAdminTemplateRender
      if($response->getStatusCode() != 200) {}
    }
  }*/
}