<?php
/**
 * Class where to put your custom methods for document joboffer_persistentdocument_spontaneous
 * @package modules.joboffer.persistentdocument
 */
class joboffer_persistentdocument_spontaneous extends joboffer_persistentdocument_spontaneousbase
{
	/**
	 * @return string
	 */
	protected function getCandidacyTag()
	{
		return 'functional_joboffer_spontaneous-candidacy';
	}

	/**
	 * @return string
	 */
	protected function getDefaultCandidacyTag()
	{
		return 'contextual_website_website_joboffer_spontaneous-candidacy';
	}
	
	/**
	 * @return boolean
	 */
	public function hasDescription()
	{
		return strip_tags($this->getDescription());
	}
}