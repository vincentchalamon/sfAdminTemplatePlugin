[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
  }

  public function linkToNew($params)
  {
    return '<li>'.link_to(image_tag(public_path('/sfAdminTemplatePlugin/images/icon_new.png'), array('alt' => __($params['label'], array(), 'sf_admin'), 'title' => __($params['label'], array(), 'sf_admin')))." ".__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('new'), array('title' => __($params['label'], array(), 'sf_admin'))).'</li>';
  }

  public function linkToEdit($object, $params)
  {
    return '<li>'.link_to(image_tag(public_path('/sfAdminTemplatePlugin/images/icon_edit.png'), array('alt' => __($params['label'], array(), 'sf_admin'), 'title' => __($params['label'], array(), 'sf_admin')))." ".__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('edit'), $object).'</li>';
  }

  public function linkToDelete($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }

    return '<li>'.link_to(image_tag(public_path('/sfAdminTemplatePlugin/images/icon_missing.png'), array('alt' => __($params['label'], array(), 'sf_admin'), 'title' => __($params['label'], array(), 'sf_admin')))." ".__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => "Êtes-vous sûr(e) de vouloir supprimer cet élément ?")).'</li>';
  }

  public function linkToList($params)
  {
    return '<li>'.link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list')).'</li>';
  }

  public function linkToSave($object, $params)
  {
    return '<li><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" class="btn" /></li>';
  }

  public function linkToSaveAndAdd($object, $params)
  {
    if (!$object->isNew())
    {
      return '';
    }

    return '<li><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_save_and_add" class="btnalt" /></li>';
  }
}
