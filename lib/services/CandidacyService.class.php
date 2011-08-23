<?php
/**
 * joboffer_CandidacyService
 * @package modules.joboffer
 */
class joboffer_CandidacyService extends f_persistentdocument_DocumentService
{
	/**
	 * @var joboffer_CandidacyService
	 */
	private static $instance;

	/**
	 * @return joboffer_CandidacyService
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
	 * @return joboffer_persistentdocument_candidacy
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_joboffer/candidacy');
	}

	/**
	 * Create a query based on 'modules_joboffer/candidacy' model.
	 * Return document that are instance of modules_joboffer/candidacy,
	 * including potential children.
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_joboffer/candidacy');
	}
	
	/**
	 * Create a query based on 'modules_joboffer/candidacy' model.
	 * Only documents that are strictly instance of modules_joboffer/candidacy
	 * (not children) will be retrieved
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createStrictQuery()
	{
		return $this->pp->createQuery('modules_joboffer/candidacy', false);
	}
}