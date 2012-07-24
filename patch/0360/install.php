<?php
/**
 * joboffer_patch_0360
 * @package modules.joboffer
 */
class joboffer_patch_0360 extends patch_BasePatch
{
	/**
	 * Entry point of the patch execution.
	 */
	public function execute()
	{
		$rc = RequestContext::getInstance();
		foreach (joboffer_SpontaneousService::getInstance()->createQuery()->find() as $doc)
		{
			/* @var $doc joboffer_persistentdocument_spontaneous */
			$rc->setLang($doc->getLang());
			$doc->setLabel('m.joboffer.document.spontaneous.document-name');
			if ($doc->getDescription() == '-')
			{
				$doc->setDescription(null);
			}
			$doc->setLocation(null);
			$doc->setBackground(null);
			$doc->setProfile(null);
			$doc->save();
		}
	}
}