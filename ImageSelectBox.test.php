<?php
/**
 * RadekDostal\NetteComponents\ImageSelectBox with jQuery and jQuery msDropDown plugin example
 *
 * @package   RadekDostal\NetteComponents\ImageSelectBox
 * @example   http://addons.nette.org/radekdostal/nette-imageselectbox
 * @version   $Id: ImageSelectBox.php,v 1.1.1 2014/04/15 10:51:00 dostal Exp $
 * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2011 - 2014 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

use Nette\Diagnostics\Debugger;
use Nette\Forms\Form;

require_once('vendor/autoload.php');
require_once('lib/NetteComponents/ImageSelectBox/ImageSelectBox.php');

Debugger::$strictMode = TRUE;
Debugger::enable();

Form::extensionMethod('addImageSelectBox', function(Form $_this, $name, $label = NULL, array $items = NULL, $size = NULL)
{
  return $_this[$name] = new RadekDostal\NetteComponents\ImageSelectBox($label, $items, $size);
});

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

$form = new Form();

$form->addImageSelectBox('item', 'Item:', $items)
  ->setPrompt('— select any item —')
  ->addRule($form::FILLED, 'Please select any item.');

$form->addSubmit('submit', 'Send');

if ($form->isSuccess())
{
  echo '<h2>Form was submitted and successfully validated</h2>';

  dump($form->values);
  exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Radek Dostál">
  <title>RadekDostal\NetteComponents\ImageSelectBox with jQuery and jQuery msDropDown plugin example</title>
  <link rel="stylesheet" type="text/css" href="js/jquery/plugins/msdropdown/css/dd.css">
  <script type="text/javascript" src="js/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery/plugins/msdropdown/js/jquery.dd.min.js"></script>
  <script type="text/javascript" src="js/nette/netteForms.js"></script>
  <script type="text/javascript">
    <!-- <![CDATA[
    $(document).ready(function()
    {
      try
      {
        $('.imageselectbox').msDropDown(
        {
          visibleRows: 5
        });
      }
      catch (e)
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
      font-family: Tahoma, Verdana, Arial, sans-serif;
      background-color: #FFFFFF;
      color: #000000;
    }

    select.imageselectbox
    {
      width: 250px;
    }
    -->
  </style>
</head>
<body>
  <h1>RadekDostal\NetteComponents\ImageSelectBox with jQuery and jQuery msDropDown plugin example</h1>
<?php
  echo $form;
?>
</body>
</html>