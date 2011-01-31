<?php
 /**
  * ImageSelectBox input control
  *
  * @package   Nette\Extras\ImageSelectBox
  * @example   http://nettephp.com/extras/imagecombobox
  * @version   $Id: ImageSelectBox.php,v 1.0.0 2011/01/30 22:40:14 dostal Exp $
  * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
  * @copyright Copyright (c) 2011 Radek Dostál
  * @license   GNU Lesser General Public License
  * @link      http://www.radekdostal.cz
  */

 class ImageSelectBox extends /*Nette\Forms\*/NSelectBox
 {
   /**
    * Konstruktor
    *
    * @access public
    * @param string $label label
    * @param array $items položky, ze kterých lze vybrat
    * @param int $size počet řádků, které budou viditelné
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
         $imageItems[$key] = NHtml::el('option')->title($item[1])->setText($item[0])->value($key);
     }

     parent::__construct($label, $imageItems, $size);
   }

   /**
    * Generování HTML elementu
    *
    * @access public
    * @return NHtml
    */
   public function getControl()
   {
     $control = parent::getControl();

     $control->class = 'imageselectbox';

     return $control;
   }
 }
?>