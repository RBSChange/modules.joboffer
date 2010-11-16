<?php
/**
 * joboffer_BlockOfferListAction
 * @package modules.joboffer.lib.blocks
 */
class joboffer_BlockOfferListAction extends website_BlockAction
{
	/**
	 * @param f_mvc_Request $request
	 * @param f_mvc_Response $response
	 * @return String
	 */
	public function execute($request, $response)
	{
		$container = $this->getContainer();
		if ($container === null)
		{
			return website_BlockView::NONE;
		}
		$request->setAttribute('container', $container);
		
		$configuration = $this->getConfiguration();
		$items = joboffer_OfferService::getInstance()->getByContainer($container, $configuration->getOrder());
		if (count($items) > 0)
		{
			$nbItemPerPage = $configuration->getNbItemsPerPage();
			$paginator = new paginator_Paginator('joboffer', $request->getParameter(paginator_Paginator::PAGEINDEX_PARAMETER_NAME, 1), $items, $nbItemPerPage);
			$request->setAttribute('paginator', $paginator);
		}
		
		$request->setAttribute('spontaneousUrl', joboffer_SpontaneousService::getInstance()->getSpontaneousUrl());
		
		return website_BlockView::SUCCESS;
	}
	
	/**
	 * @return website_persistentdocument_topic
	 */
	private function getContainer()
	{
		$container = $this->getConfiguration()->getContainer();
		if ($container instanceof website_persistentdocument_topic)
		{
			return $container;
		}
		$container = $this->getPage()->getParent();
		if ($container instanceof website_persistentdocument_topic)
		{
			return $container;
		}
		return null;
	}
}