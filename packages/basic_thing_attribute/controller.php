<?php defined('C5_EXECUTE') or die("Access Denied.");

class BasicThingAttributePackage extends Package {

	protected $pkgHandle = 'basic_thing_attribute';
	protected $pkgName = 'Basic Thing Attribute';
	protected $pkgDescription = 'Provides a page attribute for choosing a basic thing.';
	protected $appVersionRequired = '5.3.3';
	protected $pkgVersion = '1.0';

	public function install() {
		$pkg = parent::install();
		$atHandle = 'basic_thing';
		$atName = 'Basic Thing';
		$this->installCollectionAttribute($atHandle, $atName, $pkg);
	}
	
	private function installCollectionAttribute($atHandle, $atName, &$pkg) {
		//Install attribute type (if it doesn't already exist)
		$at = AttributeType::getByHandle($atHandle);
		if(!is_object($at) || !intval($at->getAttributeTypeID()) ) {
			$at = AttributeType::add($atHandle, $atName, $pkg);
		}
		
		//Associate attribute type with collections (if not already associated)
		$akc = AttributeKeyCategory::getByHandle('collection');
		$assocExists = $this->checkAttributeTypeAssociation($at->getAttributeTypeID(), $akc->getAttributeKeyCategoryID());
		if (!$assocExists) {
			$akc->associateAttributeKeyType($at);
		}
	}
	
	private function checkAttributeTypeAssociation($attributeTypeID, $attributeKeyCategoryID) {
		$db = Loader::db();
		$sql = 'SELECT count(*) FROM AttributeTypeCategories WHERE atID = ? AND akCategoryID = ?';
		$vals = array($attributeTypeID, $attributeKeyCategoryID);
		return $db->getOne($sql, $vals);
	}
}