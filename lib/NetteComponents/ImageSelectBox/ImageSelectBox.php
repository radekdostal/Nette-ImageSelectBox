<?php
/**
 * ImageSelectBox Input Control
 *
 * @package   RadekDostal\NetteComponents\ImageSelectBox
 * @example   http://addons.nette.org/radekdostal/nette-imageselectbox
 * @version   $Id: ImageSelectBox.php,v 1.1.1 2014/04/15 10:49:00 dostal Exp $
 * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2011 - 2014 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents;

use Nette\Forms\Controls\SelectBox;
use Nette\Utils\Html;

class ImageSelectBox extends SelectBox
{
  /**
   * Initialization
   *
   * @access public
   * @param string $label label
   * @param array $items items
   * @param int $size number of rows that will be visible
   * @since 1.0.0
   */
  public function __construct($label = NULL, array $items = NULL, $size = NULL)
  {
    $imageItems = array();

    foreach ($items as $key => $item)
    {
      if (!is_array($item))
        $imageItems[$key] = $item;
      else
        $imageItems[$key] = Html::el('option')->title($item[1])->setText($item[0])->value($key);
    }

    parent::__construct($label, $imageItems, $size);
  }

  /**
   * Generate HTML element
   *
   * @access public
   * @return \Nette\Utils\Html
   * @since 1.0.0
   */
  public function getControl()
  {
    $control = parent::getControl();

    $control->class = 'imageselectbox';

    return $control;
  }
}
