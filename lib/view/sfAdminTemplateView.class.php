<?php

class sfAdminTemplateView extends sfPHPView
{

    public function configure()
    {
        parent::configure();
        // Use admin theme
        if (preg_match(sprintf('/^(%s)/i', implode('|', sfConfig::get('app_sf_admin_template_templates', array('admin', 'clean')))), $this->getDecoratorTemplate(), $matches)) {
            $response = $this->context->getResponse();
            $request = $this->context->getRequest();
            if ($response->getStatusCode() != 200) {
                $this->decoratorTemplate = "clean".$this->getExtension();
            }
            $this->decoratorDirectory = sfConfig::get('sf_app_template_dir');
            if (!is_file($this->decoratorDirectory.DIRECTORY_SEPARATOR.$this->getDecoratorTemplate())) {
                $this->decoratorDirectory = sfConfig::get('sf_plugins_dir').DIRECTORY_SEPARATOR."sfAdminTemplatePlugin".DIRECTORY_SEPARATOR."templates";
            }
            $this->setDecorator(true);
            // Stylesheets
            $stylesheets = array('/sfAdminTemplatePlugin/css/layout.css', '/sfAdminTemplatePlugin/css/styles.css', '/sfAdminTemplatePlugin/js/jqtransformplugin/jqtransform.css', '/sfAdminTemplatePlugin/css/jquery.fancybox-1.3.4.css', '/sfAdminTemplatePlugin/js/validationEngine/validationEngine.jquery.css');
            foreach ($stylesheets as $css) {
                $response->addStylesheet($css, 'first', array('media' => 'all'));
            }
            // Javascripts
            $javascripts = is_dir(sfConfig::get('sf_plugins_dir').'/sfEPFactoryFormPlugin') ? array('/sfEPFactoryFormPlugin/js/jquery.min.js') : array('/sfAdminTemplatePlugin/js/jquery.min.js');
            $javascripts[] = '/sfEPFactoryFormPlugin/js/jquery.browser.min.js';
            $javascripts[] = '/sfAdminTemplatePlugin/js/autoresize.jquery.js';
            $javascripts[] = '/sfAdminTemplatePlugin/js/jqtransformplugin/jquery.jqtransform.js';
            $javascripts[] = '/sfAdminTemplatePlugin/js/jquery.fancybox-1.3.4.pack.js';
            $javascripts[] = '/sfAdminTemplatePlugin/js/admin.js';
            $javascripts[] = '/sfAdminTemplatePlugin/js/validationEngine/jquery.validationEngine-fr.js';
            $javascripts[] = '/sfAdminTemplatePlugin/js/validationEngine/jquery.validationEngine.js';
            foreach ($javascripts as $js) {
                $response->addJavascript($js, preg_match('/(jquery\.min\.js)/i', $js) ? 'first' : '');
            }
            if ($this->decoratorTemplate == "clean".$this->getExtension()) {
                $response->addStylesheet('/sfAdminTemplatePlugin/css/login.css', '', array('media' => 'all'));
            }
            if ($request->isXmlHttpRequest()) {
                $this->setDecorator(false);
            }
        }
    }
}