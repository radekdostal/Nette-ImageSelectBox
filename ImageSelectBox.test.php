<?php
 /**
  * Nette\Extras ImageSelectBox with jQuery 1.4.4 and jQuery msDropDown plugin example
  */

 require_once('lib/Nette/loader.php');
 require_once('lib/Nette/Extras/ImageSelectBox.php');

 NDebug::enable();

 // Budoucí metoda NForm::addImageSelectBox()
 function NForm_addImageSelectBox(NForm $_this, $name, $label = NULL, array $items = NULL, $size = NULL)
 {
   return $_this[$name] = new ImageSelectBox($label, $items, $size);
 }

 NForm::extensionMethod('NForm::addImageSelectBox', 'NForm_addImageSelectBox');  // v PHP 5.2
 //NForm::extensionMethod('addImageSelectBox', 'NForm_addImageSelectBox');  // v PHP 5.3

 $items = array(
   0 => '-- vyberte položku --',
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

 $form = new NForm();

 $form->addImageSelectBox('polozka', 'Položka:', $items)
      ->skipFirst()
      ->addRule(NForm::FILLED, 'Vyberte položku.');

 $form->addSubmit('send', 'Odeslat');

 if ($form->isSubmitted())
 {
   if ($form->isValid())
   {
     echo '<h2>Form was submitted and successfully validated</h2>';

     $values = $form->getValues();

     echo '<pre>';
     print_r($values);
     echo '</pre>';

     exit;
   }
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="cs" />
  <title>Nette\Extras ImageSelectBox with jQuery 1.4.4 and jQuery msDropDown plugin example</title>
  <link rel="stylesheet" type="text/css" href="css/dd.css" />
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.dd.js"></script>
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
  <h1>Nette\Extras ImageSelectBox with jQuery 1.4.4 and jQuery msDropDown plugin example</h1>
<?php
 echo $form;
?>
</body>
</html>