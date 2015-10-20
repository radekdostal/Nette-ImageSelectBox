<?php
/**
 * ImageSelectBox Input Control
 *
 * @package   RadekDostal\NetteComponents\ImageSelectBox
 * @example   http://addons.nette.org/radekdostal/nette-imageselectbox
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2011 - 2015 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents;

use Nette\Forms\Container;
use Nette\Forms\Controls\SelectBox;
use Nette\Utils\Arrays;
use Nette\Utils\Html;

/**
 * ImageSelectBox Input Control
 *
 * @package RadekDostal\NetteComponents
 * @author Radek Dostál
 */
class ImageSelectBox extends SelectBox
{
  /**
   * Initialization
   *
   * @param string $label label
   * @param array $items items
   */
  public function __construct($label = NULL, array $items = NULL)
  {
    $imageItems = array();

    if ($items !== NULL)
      $imageItems = $this->getImageItems($items);

    parent::__construct($label, $imageItems);
  }

  /**
   * Sets options
   *
   * @return self
   */
  public function setItems(array $items, $useKeys = TRUE)
  {
    $imageItems = $this->getImageItems($items);

    return parent::setItems(Arrays::flatten($imageItems, TRUE));
  }

  /**
   * Generates control's HTML element
   *
   * @return \Nette\Utils\Html
   */
  public function getControl()
  {
    $control = parent::getControl();

    $control->class = 'imageselectbox';

    return $control;
  }

  /**
   * Registers this control
   *
   * @return self
   */
  public static function register()
  {
    Container::extensionMethod('addImageSelectBox', function($container, $name, $label = NULL, array $items = NULL)
    {
      return $container[$name] = new ImageSelectBox($label, $items);
    });
  }

  /**
   * Gets image items from items
   *
   * @param array $items items
   * @return array
   */
  private function getImageItems(array $items)
  {
    $imageItems = array();

    foreach ($items as $key => $item)
    {
      if (is_array($item) === FALSE)
        $imageItems[$key] = $item;
      else
        $imageItems[$key] = Html::el('option')->title($item[1])->setText($item[0])->value($key);
    }

    return $imageItems;
  }
}