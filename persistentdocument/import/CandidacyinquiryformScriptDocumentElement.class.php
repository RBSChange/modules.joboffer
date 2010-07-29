<?php
/**
 * joboffer_CandidacyinquiryformScriptDocumentElement
 * @package modules.joboffer.persistentdocument.import
 */
class joboffer_CandidacyinquiryformScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return joboffer_persistentdocument_candidacyinquiryform
     */
    protected function initPersistentDocument()
    {
    	return joboffer_CandidacyinquiryformService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_joboffer/candidacyinquiryform');
	}
}