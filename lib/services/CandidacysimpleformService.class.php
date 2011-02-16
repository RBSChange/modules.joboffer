<?php
/**
 * joboffer_CandidacysimpleformService
 * @package modules.joboffer
 */
class joboffer_CandidacysimpleformService extends form_FormService
{
	/**
	 * @var joboffer_CandidacysimpleformService
	 */
	private static $instance;

	/**
	 * @return joboffer_CandidacysimpleformService
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = self::getServiceClassInstance(get_class());
		}
		return self::$instance;
	}

	/**
	 * @return joboffer_persistentdocument_candidacysimpleform
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_joboffer/candidacysimpleform');
	}

	/**
	 * Create a query based on 'modules_joboffer/candidacysimpleform' model.
	 * Return document that are instance of modules_joboffer/candidacysimpleform,
	 * including potential children.
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_joboffer/candidacysimpleform');
	}
	
	/**
	 * Create a query based on 'modules_joboffer/candidacysimpleform' model.
	 * Only documents that are strictly instance of modules_joboffer/candidacysimpleform
	 * (not children) will be retrieved
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createStrictQuery()
	{
		return $this->pp->createQuery('modules_joboffer/candidacysimpleform', false);
	}
	
	/**
	 * @param joboffer_persistentdocument_candidacyinquiryform $form
	 * @param form_persistentdocument_field[] $fields
	 * @param form_persistentdocument_response $response
	 * @param block_BlockRequest $request
	 * @param string $replyTo
	 * @return array an associative array contaning at least the key "success" with a boolean value. This array will be accessible during the acknowledgment notification sending.
	 */
	protected function handleData($form, $fields, $response, $request, $replyTo)
	{
		$result = parent::handleData($form, $fields, $response, $request, $replyTo);
		
		$response = $result['response'];
		if ($response instanceof form_persistentdocument_response)
		{
			$candidacy = joboffer_CandidacyService::getInstance()->getNewDocumentInstance();
			$candidacy->setForm($form);
			$candidacy->setOffer(DocumentHelper::getDocumentInstance($response->getResponseFieldValue('offerid'), 'modules_joboffer/offer'));
			$candidacy->setResponseId($response->getId());
			$candidacy->setFirstName($response->getResponseFieldValue('firstname'));
			$candidacy->setLastName($response->getResponseFieldValue('lastname'));
			$candidacy->save();
			$result['candidacy'] = $candidacy;
		}
		else
		{
			Framework::info(__METHOD__ . ' no response to save in candidacy!');
		}
		
		return $result;
	}
	
	/**
	 * @param joboffer_persistentdocument_candidacyinquiryform $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
	protected function postInsert($document, $parentNodeId = null)
	{
		if (!$document->getIsDuplicating())
		{
			joboffer_ModuleService::getInstance()->generateRequiredFields($document->getId());
		}
		
		parent::postInsert($document, $parentNodeId);
	}
}