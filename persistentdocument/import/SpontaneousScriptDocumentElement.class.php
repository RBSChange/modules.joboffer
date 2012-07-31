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
    	$doc = joboffer_SpontaneousService::getInstance()->createQuery()->findUnique();
    	if ($doc === null)
    	{
    		$doc = joboffer_SpontaneousService::getInstance()->getNewDocumentInstance();
    	}
    	return $doc;
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_joboffer/spontaneous');
	}
}