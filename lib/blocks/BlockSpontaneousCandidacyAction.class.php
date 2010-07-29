<?php
/**
 * joboffer_BlockSpontaneousCandidacyAction
 * @package modules.joboffer.lib.blocks
 */
class joboffer_BlockSpontaneousCandidacyAction extends website_BlockAction
{
	/**
	 * @param f_mvc_Request $request
	 * @param f_mvc_Response $response
	 * @return String
	 */
	function execute($request, $response)
	{
		$offer = joboffer_SpontaneousService::getInstance()->getSpontaneousInstance();
		if (!($offer instanceof joboffer_persistentdocument_spontaneous) || !$offer->isPublished())
		{
			return website_BlockView::NONE;
		}
		$request->setAttribute('item', $offer);
		
		try 
		{
			$listPage = TagService::getInstance()->getDocumentBySiblingTag('functional_joboffer_offer-list', $this->getPage()->getPersistentPage());
			if ($listPage->isPublished())
			{
				$request->setAttribute('listPage', $listPage);
			}
		}
		catch (Exception $e)
		{
			if (Framework::isDebugEnabled())
			{
				Framework::debug(__METHOD__ . ' ' . $e->getMessage());
			}
		}
		
		return website_BlockView::SUCCESS;
	}
}