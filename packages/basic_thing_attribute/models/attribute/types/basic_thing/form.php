<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php
$form = Loader::helper('form');
echo $form->label($fieldPostName, 'Basic Thing Value:');
echo $form->text($fieldPostName, $fieldValue);
?>
