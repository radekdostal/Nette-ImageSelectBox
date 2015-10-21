<?php
/**
 * Test: ImageSelectBox Input Control
 * Inspired by https://github.com/nette/forms/blob/v2.3/tests/Forms/Controls.SelectBox.loadData.phpt
 *
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2015 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

use Nette\Forms\Form;
use RadekDostal\NetteComponents\ImageSelectBox;
use Tester\Assert;

require __DIR__.'/../bootstrap.php';

ImageSelectBox::register();

$items = [
  'calendar' => ['Calendar', 'img/icon_calendar.gif'],
  'email' => ['E-mail', 'img/icon_email.gif'],
  0 => ['Secured', 'img/icon_secure.gif'],
  '' => ['Video', 'img/icon_video.gif']
];

before(function()
{
  $_SERVER['REQUEST_METHOD'] = 'POST';
  $_POST = [];
});

// Select
test(function() use ($items)
{
  $_POST = ['item' => 'calendar'];

  $form = new Form();
  $input = $form->addImageSelectBox('item', NULL, $items);

  Assert::true($form->isValid());
  Assert::same('calendar', $input->getValue());
  Assert::type('Nette\Utils\Html', $input->getSelectedItem());
  Assert::true($input->isFilled());
});

// Empty select
test(function()
{
  $_POST = ['item' => 'calendar'];

  $form = new Form();
  $input = $form->addImageSelectBox('item');

  Assert::true($form->isValid());
  Assert::same(NULL, $input->getValue());
  Assert::same(NULL, $input->getSelectedItem());
  Assert::false($input->isFilled());
});

// Select with prompt
test(function() use ($items)
{
  $_POST = ['item' => 'calendar'];

  $form = new Form();

  $input = $form->addImageSelectBox('item', NULL, $items)
    ->setPrompt('Select item');

  Assert::true($form->isValid());
  Assert::same('calendar', $input->getValue());
  Assert::type('Nette\Utils\Html', $input->getSelectedItem());
  Assert::true($input->isFilled());
});

// Select with optgroups (optgroups are not allowed)
test(function()
{
  $_POST = ['item' => 'calendar'];

  $form = new Form();

  Assert::error(function() use ($form)
  {
    $form->addImageSelectBox('item', NULL, [
      'first' => [
        'calendar' => ['Calendar', 'img/icon_calendar.gif'],
      ],
      'second' => [
        'email' => ['E-mail', 'img/icon_email.gif']
      ]
    ]);
  },
    [
      [E_NOTICE, 'Undefined offset: 1'],
      [E_NOTICE, 'Undefined offset: 0'],
      [E_NOTICE, 'Undefined offset: 1'],
      [E_NOTICE, 'Undefined offset: 0']
    ]
  );
});

// Select with invalid input
test(function() use ($items)
{
  $_POST = ['item' => 'non-existing'];

  $form = new Form();
  $input = $form->addImageSelectBox('item', NULL, $items);

  Assert::false($form->isValid());
  Assert::null($input->getValue());
  Assert::null($input->getSelectedItem());
  Assert::false($input->isFilled());
});

// Select with prompt and invalid input
test(function() use ($items)
{
  $form = new Form();

  $input = $form->addImageSelectBox('item', NULL, $items)
    ->setPrompt('Select item');

  Assert::true($form->isValid());
  Assert::null($input->getValue());
  Assert::null($input->getSelectedItem());
  Assert::false($input->isFilled());
});

// Indexed arrays
test(function() use ($items)
{
  $_POST = ['zero' => 0];

  $form = new Form();
  $input = $form->addImageSelectBox('zero', NULL, $items);

  Assert::true($form->isValid());
  Assert::same(0, $input->getValue());
  Assert::same(0, $input->getRawValue());
  Assert::type('Nette\Utils\Html', $input->getSelectedItem());
  Assert::true($input->isFilled());
});

// Empty key
test(function() use ($items)
{
  $_POST = ['empty' => ''];

  $form = new Form();
  $input = $form->addImageSelectBox('empty', NULL, $items);

  Assert::true($form->isValid());
  Assert::same('', $input->getValue());
  Assert::type('Nette\Utils\Html', $input->getSelectedItem());
  Assert::true($input->isFilled());
});

// Missing key
test(function() use ($items)
{
  $form = new Form();
  $input = $form->addImageSelectBox('missing', NULL, $items);

  Assert::false($form->isValid());
  Assert::null($input->getValue());
  Assert::null($input->getSelectedItem());
  Assert::false($input->isFilled());
});

// Disabled key
test(function() use ($items)
{
  $_POST = ['disabled' => 'calendar'];

  $form = new Form();
  $input = $form->addImageSelectBox('disabled', NULL, $items)
    ->setDisabled();

  Assert::true($form->isValid());
  Assert::null($input->getValue());
});

// Malformed data
test(function() use ($items)
{
  $_POST = ['malformed' => [NULL]];

  $form = new Form();
  $input = $form->addImageSelectBox('malformed', NULL, $items);

  Assert::false($form->isValid());
  Assert::null($input->getValue());
  Assert::null($input->getSelectedItem());
  Assert::false($input->isFilled());
});

// setValue() and invalid argument
test(function() use ($items)
{
  $form = new Form();

  $input = $form->addImageSelectBox('item', NULL, $items);
  $input->setValue(NULL);

  Assert::exception(function() use ($input)
  {
    $input->setValue('unknown');
  }, Nette\InvalidArgumentException::class, "Value 'unknown' is out of allowed set ['calendar', 'email', 0, ''] in field 'item'.");
});

// Disabled one
test(function() use ($items)
{
  $_POST = ['item' => 'calendar'];

  $form = new Form();

  $input = $form->addImageSelectBox('item', NULL, $items)
    ->setDisabled(['calendar']);

  Assert::null($input->getValue());

  unset($form['item']);
  $input = new ImageSelectBox(NULL, $items);
  $input->setDisabled(['calendar']);
  $form['item'] = $input;

  Assert::null($input->getValue());
});