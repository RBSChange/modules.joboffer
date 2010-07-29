<?php
/**
 * joboffer_CandidacyScriptDocumentElement
 * @package modules.joboffer.persistentdocument.import
 */
class joboffer_CandidacyScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return joboffer_persistentdocument_candidacy
     */
    protected function initPersistentDocument()
    {
    	return joboffer_CandidacyService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_joboffer/candidacy');
	}
}