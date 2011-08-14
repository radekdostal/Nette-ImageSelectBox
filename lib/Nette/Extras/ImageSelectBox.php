<?php
 /**
  * ImageSelectBox Input Control
  *
  * @package   Nette\Extras\ImageSelectBox
  * @example   http://addons.nette.org/imageselectbox
  * @version   $Id: ImageSelectBox.php,v 1.1.0 2011/08/12 11:33:28 dostal Exp $
  * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
  * @copyright Copyright (c) 2011 Radek Dostál
  * @license   GNU Lesser General Public License
  * @link      http://www.radekdostal.cz
  */

 namespace Nette\Extras;

 use Nette\Forms\Controls,
     Nette\Utils;

 class ImageSelectBox extends Controls\SelectBox
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
         $imageItems[$key] = Utils\Html::el('option')->title($item[1])->setText($item[0])->value($key);
     }

     parent::__construct($label, $imageItems, $size);
   }

   /**
    * Generate HTML element
    *
    * @access public
    * @return Html
    */
   public function getControl()
   {
     $control = parent::getControl();

     $control->class = 'imageselectbox';

     return $control;
   }
 }
?>