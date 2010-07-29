<?php
/**
 * joboffer_CandidacysimpleformScriptDocumentElement
 * @package modules.joboffer.persistentdocument.import
 */
class joboffer_CandidacysimpleformScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return joboffer_persistentdocument_candidacysimpleform
     */
    protected function initPersistentDocument()
    {
    	return joboffer_CandidacysimpleformService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_joboffer/candidacysimpleform');
	}
}