<?php

class sfAdminTemplateGenerator extends sfDoctrineGenerator
{
  /**
   * Returns HTML code for a field.
   *
   * @see sfModelGenerator
   * @param sfModelGeneratorConfigurationField $field The field
   * @return string HTML code
   */
  public function renderField($field)
  {
    $html = $this->getColumnGetter($field->getName(), true);
    switch($field->getType()) {
      case "Timestamp":
        return sprintf("false !== strtotime($html) ? format_date(%s, \"%s\") : '&nbsp;'", $html, $field->getConfig('date_format', 'f'));
      case "Date":
        return sprintf("false !== strtotime($html) ? format_date(%s, \"%s\") : '&nbsp;'", $html, $field->getConfig('date_format', 'D'));
      default:
        return parent::renderField($field);
    }
  }
  
  /**
   * Returns the type of a column.
   *
   * @see sfDoctrineGenerator
   * @param  object $column A column object
   * @return string The column type
   */
  public function getType($column)
  {
    if($column->isForeignKey())
    {
      return 'ForeignKey';
    }
    switch($column->getDoctrineType())
    {
      case 'enum':
        return 'Enum';
      case 'boolean':
        return 'Boolean';
      case 'date':
        return 'Date';
      case 'timestamp':
        return 'Timestamp';
      case 'time':
        return 'Time';
      default:
        return 'Text';
    }
  }
}