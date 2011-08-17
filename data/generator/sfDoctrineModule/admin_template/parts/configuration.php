[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorConfiguration extends sfModelGeneratorConfiguration
{
<?php include dirname(__FILE__).'/actionsConfiguration.php' ?>

<?php include dirname(__FILE__).'/fieldsConfiguration.php' ?>

  protected function compile()
  {
    parent::compile();
    $config = $this->getConfig();
    $this->configuration['show'] = array(
      'fields' => array(),
      'display' => $this->getShowDisplay(),
      'actions' => $this->getShowActions(),
      'title' => $this->getShowTitle()
    );
    foreach (array_keys($config['default']) as $name)
    {
      $this->configuration['show']['fields'][$name] = new sfModelGeneratorConfigurationField($name, array_merge(
              array('label' => sfInflector::humanize(sfInflector::underscore($name))),
              $config['default'][$name],
              isset($config['show'][$name]) ? $config['show'][$name] : array()
            ));
    }
    $this->parseVariables('show', 'title');
    foreach ($this->configuration['show']['actions'] as $action => $parameters)
    {
      $this->configuration['show']['actions'][$action] = $this->fixActionParameters($action, $parameters);
    }
    $actions = $this->getActionsDefault();
    $this->configuration['credentials']['show'] = isset($actions['_show']['credentials']) ? $actions['_show']['credentials'] : array();
    $this->configuration['credentials']['batchShow'] = isset($actions['_show']['credentials']) ? $actions['_show']['credentials'] : array();
  }

  protected function getConfig()
  {
    return array_merge(parent::getConfig(), array('show' => $this->getFieldsShow()));
  }

  /**
   * Gets the fields that represents the show.
   *
   * If no show.display parameter is passed in the configuration,
   * all the fields from the object are returned (dynamically).
   *
   */
  public function getShowFields(<?php echo $this->getModelClass() ?> $object)
  {
    $config = $this->getConfig();
    $defaults = $this->getFieldsDefault();
    if ($this->getShowDisplay())
    {
      $fieldsets = $this->getShowDisplay();
      $fields = array();

      // with fieldsets?
      if (!is_array(current($fieldsets)))
      {
        $fieldsets = array('NONE' => $fieldsets);
      }

      foreach ($fieldsets as $fieldset => $names)
      {
        if (!$names)
        {
          continue;
        }

        $fields[$fieldset] = array();
        foreach ($names as $name)
        {
          if (!isset($this->configuration['show']['fields'][$name]))
          {
            $options = $object->getTable()->getColumnDefinition($name);
            list($name, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($name);
            $this->configuration['show']['fields'][$name] = new sfModelGeneratorConfigurationField($name, array_merge(
              array('type' => $options['type'], 'label' => sfInflector::humanize(sfInflector::underscore($name))),
              isset($config['default'][$name]) ? $config['default'][$name] : array(),
              isset($config['show'][$name]) ? $config['show'][$name] : array(),
              array('flag' => $flag)
            ));
          }
          $fields[$fieldset][$name] = $this->configuration['show']['fields'][$name];
        }
        if (!count($fields[$fieldset]))
        {
          unset($fields[$fieldset]);
        }
      }

      return $fields;
    }

    $fields = array();
    foreach ($object->getTable()->getColumns() as $name => $options)
    {
      list($name, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($name);
      $this->configuration['show']['fields'][$name] = new sfModelGeneratorConfigurationField($name, array_merge(
        array('type' => $options['type'], 'label' => sfInflector::humanize(sfInflector::underscore($name))),
        isset($config['default'][$name]) ? $config['default'][$name] : array(),
        isset($config['show'][$name]) ? $config['show'][$name] : array(),
        array('flag' => $flag)
      ));
      $fields[$name] = $this->configuration['show']['fields'][$name];
    }

    return array('NONE' => $fields);
  }

  public function retrieveValue(<?php echo $this->getModelClass() ?> $object, $name)
  {
    $options = $object->getTable()->getColumnDefinition($name);
    // Default value
    $value = $object->{"get".ucfirst(sfInflector::classify($name))}();
    // Field is relation
    /*if (preg_match('/_id$/i', $name) && $this->retrieveRelationName($object, $name))
    {
      $value = $this->retrieveRelationName($object, $name);
    }*/
    // Field is date
    if ($value && $options['type'] == 'date')
    {
      $value = format_date(strtotime($value), "EEEE dd MMMM yyyy");
    }
    // Field is time
    if ($value && $options['type'] == 'time')
    {
      $value = date('H\hi', strtotime($value));
    }
    // Field is timestamp
    if ($value && $options['type'] == 'timestamp')
    {
      $value = format_date(strtotime($value), "EEEE dd MMMM yyyy")." ".date('H\hi', strtotime($value));
    }
    // Field is boolean
    if ($options['type'] == 'boolean')
    {
      $value = $value ? "<img src='/sfAdminTemplatePlugin/images/icon_ticklist.png' />" : "<img src='/sfAdminTemplatePlugin/images/icon_cross_sml.png' />";
    }
    // Convert array to string
    if (is_array($value) || $value instanceof Doctrine_Collection)
    {
      $html = "";
      foreach ($value as $element)
      {
        $html.= "<li>$element</li>";
      }
      $value = "<ul>$html</ul>";
    }
    // Test if relation exists
    if ($object->getTable()->hasRelation($name))
    {
      if ($object->getTable()->getRelation($name)->getType() == Doctrine_Relation::MANY)
      {
        $relationValues = array();
        foreach ($object[$name] as $relationValue)
        {
          $relationValues[] = (string)$relationValue;
        }
        $value = implode(', ', $relationValues);
      }
      else
      {
        $value = $object[$name] && !$object[$name]->isNew() ? $object[$name] : false;
      }
    }
    return $value;
  }

  protected function retrieveRelationName(<?php echo $this->getModelClass() ?> $object, $name)
  {
    foreach ($object->getTable()->getRelations() as $relation)
    {
      if ($relation['local'] == $name)
      {
        return $relation['name'];
      }
    }
    return false;
  }

  /**
   *
   * @see sfModelGeneratorConfiguration
   */
  public function getFormFields(sfForm $form, $context)
  {
    $fieldsets = parent::getFormFields($form, $context);
    foreach ($fieldsets as $name => $fields)
    {
      if (!count($fields))
      {
        unset($fieldsets[$name]);
      }
    }
    return $fieldsets;
  }
  
  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return '<?php echo isset($this->config['form']['class']) ? $this->config['form']['class'] : $this->getModelClass().'Form' ?>';
<?php unset($this->config['form']['class']) ?>
  }

  public function hasFilterForm()
  {
    return <?php echo !isset($this->config['filter']['class']) || false !== $this->config['filter']['class'] ? 'true' : 'false' ?>;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return '<?php echo isset($this->config['filter']['class']) && !in_array($this->config['filter']['class'], array(null, true, false), true) ? $this->config['filter']['class'] : $this->getModelClass().'FormFilter' ?>';
<?php unset($this->config['filter']['class']) ?>
  }

<?php include dirname(__FILE__).'/paginationConfiguration.php' ?>

<?php include dirname(__FILE__).'/sortingConfiguration.php' ?>

  public function getTableMethod()
  {
    return '<?php echo isset($this->config['list']['table_method']) ? $this->config['list']['table_method'] : null ?>';
<?php unset($this->config['list']['table_method']) ?>
  }

  public function getTableCountMethod()
  {
    return '<?php echo isset($this->config['list']['table_count_method']) ? $this->config['list']['table_count_method'] : null ?>';
<?php unset($this->config['list']['table_count_method']) ?>
  }
}
