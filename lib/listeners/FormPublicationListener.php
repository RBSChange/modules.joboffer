<?php
class joboffer_FromPublicationListener
{
	/**
	 * @param f_persistentdocument_DocumentService $sender
	 * @param array $params
	 */
	public function onPersistentDocumentActivated($sender, $params)
	{
		$document = $params['document'];
		$this->rePublishRelatedOffers($document);
	}
	
	/**
	 * @param f_persistentdocument_DocumentService $sender
	 * @param array $params
	 */
	public function onPersistentDocumentPublished($sender, $params)
	{
		$document = $params['document'];
		$this->rePublishRelatedOffers($document);
	}
	
	/**
	 * @param f_persistentdocument_DocumentService $sender
	 * @param array $params
	 */
	public function onPersistentDocumentUnPublished($sender, $params)
	{
		$document = $params['document'];
		$this->rePublishRelatedOffers($document);
	}
	
	/**
	 * @param f_persistentdocument_DocumentService $sender
	 * @param array $params
	 */
	public function onPersistentDocumentDeactivated($sender, $params)
	{
		$document = $params['document'];
		$this->rePublishRelatedOffers($document);
	}
	
	/**
	 * @param f_persistentdocument_DocumentService $sender
	 * @param array $params
	 */
	public function onPersistentDocumentFiled($sender, $params)
	{
		$document = $params['document'];
		$this->rePublishRelatedOffers($document);
	}
	
	/**
	 * @param f_persistentdocument_DocumentService $sender
	 * @param array $params
	 */
	public function onPersistentDocumentInTrash ($sender, $params)
	{
		$document = $params['document'];
		$this->rePublishRelatedOffers($document);
	}
	
	/**
	 * @param f_persistentodcument_PersistentDocument $document
	 */
	private function rePublishRelatedOffers($document)
	{
		if ($document instanceof form_persistentdocument_baseform)
		{
			$query = joboffer_OfferService::getInstance()->createQuery()->add(Restrictions::eq('candidacyForm', $document));
			foreach ($query->find() as $offer)
			{
				$offer->getDocumentService()->publishIfPossible($offer->getId());
			}
		}
	}
}