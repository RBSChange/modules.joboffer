<?php
/**
 * joboffer_LoadCandidaciesAction
 * @package modules.joboffer.actions
 */
class joboffer_LoadCandidaciesAction extends f_action_BaseJSONAction
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$result = array();

		$offer = $this->getDocumentInstanceFromRequest($request);
		$pageSize = $request->getParameter('pageSize');
		$startIndex = $request->getParameter('startIndex');
		$result = $offer->getDocumentService()->getCandidaciesInfos($offer, $pageSize, $startIndex);	

		return $this->sendJSON($result);
	}
}