<?php
/**
 * @package modules.joboffer.setup
 */
class joboffer_Setup extends object_InitDataSetup
{
	public function install()
	{
		$this->executeModuleScript('init.xml');
		
		$mbs = uixul_ModuleBindingService::getInstance();
		$mbs->addImportInPerspective('form', 'joboffer', 'form.perspective');
		$mbs->addImportInActions('form', 'joboffer', 'form.actions');
		$result1 = $mbs->addImportForm('form', 'modules_joboffer/candidacysimpleform');
		$result2 = $mbs->addImportForm('form', 'modules_joboffer/candidacyinquiryform');
		if ($result1['action'] == 'create' || $result2['action'] == 'create')
		{
			uixul_DocumentEditorService::getInstance()->compileEditorsConfig();
		}
		f_permission_PermissionService::getInstance()->addImportInRight('form', 'joboffer', 'form.rights');
	}

	/**
	 * @return String[]
	 */
	public function getRequiredPackages()
	{
		// Return an array of packages name if the data you are inserting in
		// this file depend on the data of other packages.
		// Example:
		// return array('modules_website', 'modules_users');
		return array('modules_zone');
	}
}