<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

Loader::model('attribute/types/default/controller');

class BasicThingAttributeTypeController extends DefaultAttributeTypeController {

	public function form() {
		$this->set('fieldPostName', $this->field('value')); //<--post the user's value to this field name and C5 will automatically save it
		
		$val = is_object($this->attributeValue) ? $this->getAttributeValue()->getValue() : 0; //<--set default for new records
		$this->set('fieldValue', $val);
	}
	
}