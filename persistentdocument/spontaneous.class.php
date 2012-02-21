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
		return LocaleService::getInstance()->transBO('m.joboffer.document.spontaneous.document-name');
	}

	/**
	 * @return string
	 */
	protected function getCandidacyTag()
	{
		return 'functional_joboffer_spontaneous-candidacy';
	}
}