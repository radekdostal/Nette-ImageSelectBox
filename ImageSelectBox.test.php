<?php
 /**
  * Nette\Extras\ImageSelectBox with jQuery 1.6.2 and jQuery msDropDown 2.37.5 plugin example
  *
  * @package   Nette\Extras\ImageSelectBox
  * @example   http://addons.nette.org/imageselectbox
  * @version   $Id: ImageSelectBox.php,v 1.1.0 2011/08/12 11:32:58 dostal Exp $
  * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
  * @copyright Copyright (c) 2011 Radek Dostál
  * @license   GNU Lesser General Public License
  * @link      http://www.radekdostal.cz
  */

 use Nette\Diagnostics\Debugger,
     Nette\Forms,
     Nette\Extras;

 require_once('lib/Nette/loader.php');
 require_once('lib/Nette/Extras/ImageSelectBox.php');

 Debugger::$strictMode = TRUE;
 Debugger::enable();

 function Form_addImageSelectBox(Forms\Form $_this, $name, $label = NULL, array $items = NULL, $size = NULL)
 {
   return $_this[$name] = new Extras\ImageSelectBox($label, $items, $size);
 }

 Forms\Form::extensionMethod('addImageSelectBox', 'Form_addImageSelectBox');

 $items = array(
   'calendar' => array('Calendar', 'img/icon_calendar.gif'),
   'shopping_cart' => array('Shopping Cart', 'img/icon_cart.gif'),
   'cd' => array('CD', 'img/icon_cd.gif'),
   'email' => array('E-mail', 'img/icon_email.gif'),
   'faq' => array('FAQ', 'img/icon_faq.gif'),
   'games' => array('Games', 'img/icon_games.gif'),
   'music' => array('Music', 'img/icon_music.gif'),
   'phone' => array('Phone', 'img/icon_phone.gif'),
   'graph' => array('Graph', 'img/icon_sales.gif'),
   'secured' => array('Secured', 'img/icon_secure.gif'),
   'video' => array('Video', 'img/icon_video.gif'),
 );

 $form = new Forms\Form();

 $form->addImageSelectBox('item', 'Item:', $items)
      ->setPrompt('— select any item —')
      ->addRule($form::FILLED, 'Select any item.');

 $form->addSubmit('send', 'Send');

 if ($form->isSubmitted())
 {
   if ($form->isValid())
   {
     echo '<h2>Form was submitted and successfully validated</h2>';

     Debugger::dump($form->values);

     exit;
   }
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="en" />
  <meta name="author" content="Radek Dostál" />
  <title>Nette\Extras\ImageSelectBox with jQuery 1.6.2 and jQuery msDropDown 2.37.5 plugin example</title>
  <link rel="stylesheet" type="text/css" href="css/dd.css" />
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.dd.js"></script>
  <script type="text/javascript" src="js/netteForms.js"></script>
  <script type="text/javascript">
  <!-- <![CDATA[
    $(document).ready(function()
    {
      try
      {
        $('.imageselectbox').msDropDown();
      }
      catch(e)
      {
        alert('Error: ' + e.message);
      }
    });
  //]]> -->
  </script>
  <style type="text/css">
  <!--
    body
    {
      font-family: 'Tahoma', 'Verdana', 'Arial';
      background-color: #FFFFFF;
      color: #000000;
      font-size: 70%;
    }

    input.button
    {
      font-family: 'Verdana', 'Tahoma', 'Arial';
      font-size: 100%;
    }
  //-->
  </style>
</head>
<body>
  <h1>Nette\Extras\ImageSelectBox with jQuery 1.6.2 and jQuery msDropDown 2.37.5 plugin example</h1>
<?php
 echo $form;
?>
</body>
</html>