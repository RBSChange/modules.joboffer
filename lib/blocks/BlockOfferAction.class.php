<?php
/**
 * joboffer_BlockOfferAction
 * @package modules.joboffer.lib.blocks
 */
class joboffer_BlockOfferAction extends website_BlockAction
{
	/**
	 * @param f_mvc_Request $request
	 * @param f_mvc_Response $response
	 * @return String
	 */
	function execute($request, $response)
	{
		$offer = $this->getDocumentParameter();
		if (!($offer instanceof joboffer_persistentdocument_offer) || !$offer->isPublished())
		{
			return website_BlockView::NONE;
		}
		$request->setAttribute('item', $offer);
		$request->setAttribute('spontaneousUrl', joboffer_SpontaneousService::getInstance()->getSpontaneousUrl());
		
		try 
		{
			$listPage = TagService::getInstance()->getDocumentBySiblingTag('functional_joboffer_offer-list', $offer);
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