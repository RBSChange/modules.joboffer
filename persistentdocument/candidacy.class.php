<?php
/**
 * Class where to put your custom methods for document joboffer_persistentdocument_candidacy
 * @package modules.joboffer.persistentdocument
 */
class joboffer_persistentdocument_candidacy extends joboffer_persistentdocument_candidacybase 
{
	/**
	 * @return from_Response or null
	 */
	public function getResponse()
	{
		if (!$this->getResponseId())
		{
			return null;
		}
		
		try 
		{
			return DocumentHelper::getDocumentInstance($this->getResponseId());
		}
		catch (Exception $e)
		{
			// The response does not exist any more.
			$e; // Avoid Eclipse warning...
		}
		return null;
	}
}