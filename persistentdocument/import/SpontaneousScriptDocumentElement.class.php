<?php
/**
 * joboffer_SpontaneousScriptDocumentElement
 * @package modules.joboffer.persistentdocument.import
 */
class joboffer_SpontaneousScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return joboffer_persistentdocument_spontaneous
     */
    protected function initPersistentDocument()
    {
    	return joboffer_SpontaneousService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_joboffer/spontaneous');
	}
}