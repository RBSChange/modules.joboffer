<?php
/**
 * joboffer_SpontaneousService
 * @package modules.joboffer
 */
class joboffer_SpontaneousService extends joboffer_OfferService
{
	/**
	 * @var joboffer_SpontaneousService
	 */
	private static $instance;
	
	/**
	 * @return joboffer_SpontaneousService
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
	 * @return joboffer_persistentdocument_spontaneous
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_joboffer/spontaneous');
	}
	
	/**
	 * Create a query based on 'modules_joboffer/spontaneous' model.
	 * Return document that are instance of modules_joboffer/spontaneous,
	 * including potential children.
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_joboffer/spontaneous');
	}
	
	/**
	 * Create a query based on 'modules_joboffer/spontaneous' model.
	 * Only documents that are strictly instance of modules_joboffer/spontaneous
	 * (not children) will be retrieved
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createStrictQuery()
	{
		return $this->pp->createQuery('modules_joboffer/spontaneous', false);
	}
	
	/**
	 * @return joboffer_persistentdocument_spontaneous
	 */
	public function getSpontaneousInstance()
	{
		return $this->createQuery()->findUnique();
	}
	
	/**
	 * @return joboffer_persistentdocument_spontaneous
	 */
	public function getSpontaneousUrl()
	{
		$doc = $this->createQuery()->add(Restrictions::published())->findUnique();
		return ($doc === null) ? null : $doc->getFormPageUrl();
	}
	
	/**
	 * @param website_UrlRewritingService $urlRewritingService
	 * @param joboffer_persistentdocument_spontaneous $document
	 * @param website_persistentdocument_website $website
	 * @param string $lang
	 * @param array $parameters
	 * @return f_web_Link | null
	 */
	public function getWebLink($urlRewritingService, $document, $website, $lang, $parameters)
	{
		$url = $this->getSpontaneousUrl();
		return ($url) ? LinkHelper::buildLinkFromUrl($url) : null;
	}
	
	/**
	 * @param joboffer_persistentdocument_spontaneous $document
	 * @return string|null
	 */
	public function getNavigationLabel($document)
	{
		return LocaleService::getInstance()->transFO($document->getLabel(), array('ucf'));
	}

}