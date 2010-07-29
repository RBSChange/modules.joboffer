<?php
/**
 * joboffer_OfferScriptDocumentElement
 * @package modules.joboffer.persistentdocument.import
 */
class joboffer_OfferScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return joboffer_persistentdocument_offer
     */
    protected function initPersistentDocument()
    {
    	return joboffer_OfferService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_joboffer/offer');
	}
}