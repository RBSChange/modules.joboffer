<?php
/**
 * joboffer_OfferService
 * @package modules.joboffer
 */
class joboffer_OfferService extends f_persistentdocument_DocumentService
{
	/**
	 * @var joboffer_OfferService
	 */
	private static $instance;

	/**
	 * @return joboffer_OfferService
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * @return joboffer_persistentdocument_offer
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_joboffer/offer');
	}

	/**
	 * Create a query based on 'modules_joboffer/offer' model.
	 * Return document that are instance of modules_joboffer/offer,
	 * including potential children.
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_joboffer/offer');
	}
	
	/**
	 * Create a query based on 'modules_joboffer/offer' model.
	 * Only documents that are strictly instance of modules_joboffer/offer
	 * (not children) will be retrieved
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createStrictQuery()
	{
		return $this->pp->createQuery('modules_joboffer/offer', false);
	}
	
	/**
	 * @param website_persistentdocument_topic $container
	 * @param string $order alpha|manual
	 * @return unknown
	 */
	public function getByContainer($container, $order)
	{
		$query = $this->createQuery()->add(Restrictions::published())->add(Restrictions::childOf($container->getId()));
		if ($order == 'alpha')
		{
			$query->addOrder(Order::asc('document_label'));
		}
		return $query->find();
	}
	
	/**
	 * @param joboffer_persistentdocument_offer $offer
	 * @param integer $pageSize
	 * @param integer $startIndex
	 * @return array
	 */
	public function getCandidaciesInfos($offer, $pageSize, $startIndex)
	{
		$row = joboffer_CandidacyService::getInstance()->createQuery()->add(Restrictions::eq('offer', $offer))->addOrder(Order::desc('document_creationdate'))->setProjection(Projections::rowCount('count'))->findUnique();
		$count = $row['count'];
		$infos = array('count' => $row['count'], 'pageSize' => $pageSize, 'startIndex' => $startIndex, 'candidacies' => array());
		
		if ($startIndex >= $count)
		{
			$startIndex = 0;
			$infos['startIndex'] = $startIndex;
		}
		
		if ($count == 0)
		{
			return $infos;
		}
		
		$query = joboffer_CandidacyService::getInstance()->createQuery()->add(Restrictions::eq('offer', $offer))->addOrder(Order::desc('document_creationdate'))->setFirstResult($startIndex)->setMaxResults($pageSize);
		foreach ($query->find() as $candidacy)
		{
			$response = $candidacy->getResponse();
			$row = array(
				'id' => $candidacy->getId(),
				'date' => date_Formatter::toDefaultDateTimeBO($candidacy->getCreationdate()),
				'offerId' => $offer->getId(),
				'offerEditorModel' => $offer->getPersistentModel()->getBackofficeName(),
				'responseId' => $response->getId(),
				'firstname' => $candidacy->getFirstName(),
				'lastname' => $candidacy->getLastName(),
				'editorModule' => $response->getBoEditorModule(),
				'editorModel' => $response->getPersistentModel()->getBackofficeName()
			);
			$infos['candidacies'][] = $row; 
		}
		$infos['candidaciesJSON'] = JsonService::getInstance()->encode($infos['candidacies']);
		
		return $infos;
	}

	/**
	 * @param joboffer_persistentdocument_offer $document
	 * @return boolean true if the document is publishable, false if it is not.
	 */
	public function isPublishable($document)
	{
		$form = $document->getCandidacyForm();
		if ($form === null || !$form->isPublished())
		{
			$this->setActivePublicationStatusInfo($document, '&modules.joboffer.document.offer.publication.no-published-form;');
			return false;
		}
		
		return parent::isPublishable($document);
	}

	/**
	 * @param joboffer_persistentdocument_offer $document
	 * @param string $forModuleName
	 * @param array $allowedSections
	 * @return array
	 */
	public function getResume($document, $forModuleName, $allowedSections = null)
	{
		$resume = parent::getResume($document, $forModuleName, $allowedSections);
		
		$resume['properties']['reference'] = $document->getReference();
		
		$form = $document->getCandidacyForm();
		if ($form !== null)
		{
			$backUri = join(',', array('joboffer', 'openDocument', 'modules_joboffer_offer', $document->getId(), 'resume'));
			$formUri = join(',' , array('form', 'openDocument', $form->getPersistentModel()->getBackofficeName(), $form->getId(), 'resume'));
			$resume['properties']['candidacyForm'] = array("uri" => $formUri, "label" => $form->getLabel(), "backuri" => $backUri);
		}
		
		return $resume;
	}
}