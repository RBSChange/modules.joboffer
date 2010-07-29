<?php
/**
 * Class where to put your custom methods for document joboffer_persistentdocument_offer
 * @package modules.joboffer.persistentdocument
 */
class joboffer_persistentdocument_offer extends joboffer_persistentdocument_offerbase implements indexer_IndexableDocument
{
	/**
	 * @return indexer_IndexedDocument
	 */
	public function getIndexedDocument()
	{
		$indexedDoc = new indexer_IndexedDocument();
		$indexedDoc->setId($this->getId());
		$indexedDoc->setDocumentModel('modules_joboffer/offer');
		$indexedDoc->setLabel($this->getLabel());
		$indexedDoc->setLang(RequestContext::getInstance()->getLang());
		$indexedDoc->setText($this->getFullTextForIndexation());
		return $indexedDoc;
	}
	
	/**
	 * @return string
	 */
	private function getFullTextForIndexation()
	{
		$fullText = $this->getDescription();
		$fullText .= ' ' . $this->getLocation();
		$fullText .= ' ' . $this->getBackground();
		$fullText .= ' ' . $this->getProfile();
		return f_util_StringUtils::htmlToText($fullText);
	}
	
	/**
	 * @param integer $maxLength
	 * @return string
	 */
	public function getShortDescription($maxLength = 200)
	{
		return f_util_StringUtils::shortenString(f_util_StringUtils::htmlToText($this->getDescription()), $maxLength);
	}
	
	/**
	 * @return string
	 */
	public function getFormPageUrl()
	{
		$form = $this->getCandidacyForm();
		if ($form === null)
		{
			return null;
		}
		
		if (f_util_ClassUtils::methodExists($form, 'getDetailModuleName'))
		{
			$module = $form->getDetailModuleName();
		}
		else 
		{
			$module = $form->getPersistentModel()->getModuleName();
		}
		
		$params = array();
		$params[$module.'Param'] = array(
			'cmpref' => $form->getId(),
			'offerid' => $this->getId(),
			'offerref' => $this->getReference(),
			'offerlabel' => $this->getLabel(),
		);
		$params['jobofferParam']['offerId'] = $this->getId();
		return LinkHelper::getTagUrl($this->getCandidacyTag(), null, $params);
	}
	
	/**
	 * @return string
	 */
	protected function getCandidacyTag()
	{
		return 'functional_joboffer_candidacy-form';
	}
	
	/**
	 * @return string
	 */
	public function getFormBlockModule()
	{
		$form = $this->getCandidacyForm();
		if ($form === null)
		{
			return null;
		}
		return $form->getPersistentModel()->getModuleName();
	}
	
	/**
	 * @return string
	 */
	public function getFormBlockName()
	{
		$form = $this->getCandidacyForm();
		if ($form === null)
		{
			return null;
		}
		return ucfirst($form->getPersistentModel()->getDocumentName());
	}
}