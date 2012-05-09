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
	public function getLabel()
	{
		return f_Locale::translateUI('&modules.joboffer.document.spontaneous.document-name;');
	}

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
}