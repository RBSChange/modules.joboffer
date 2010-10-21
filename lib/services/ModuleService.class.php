<?php
/**
 * @package modules.joboffer.lib.services
 */
class joboffer_ModuleService extends ModuleBaseService
{
	/**
	 * Singleton
	 * @var joboffer_ModuleService
	 */
	private static $instance = null;

	/**
	 * @return joboffer_ModuleService
	 */
	public static function getInstance()
	{
		if (is_null(self::$instance))
		{
			self::$instance = self::getServiceClassInstance(get_class());
		}
		return self::$instance;
	}
	
	/**
	 * @param integer $formId
	 */
	public function generateRequiredFields($formId)
	{
		// Initialize the hidden fields.
		$hs = form_HiddenService::getInstance();
		
		$field = $hs->getNewDocumentInstance();
		$field->setLabel(f_Locale::translate('&modules.joboffer.bo.general.Default-offerid-label;'));
		$field->setFieldName('offerid');
		$field->setIsLocked(true);
		$field->save($formId);
		
		$field = $hs->getNewDocumentInstance();
		$field->setLabel(f_Locale::translate('&modules.joboffer.bo.general.Default-offerref-label;'));
		$field->setFieldName('offerref');
		$field->setIsLocked(true);
		$field->save($formId);
		
		$field = $hs->getNewDocumentInstance();
		$field->setLabel(f_Locale::translate('&modules.joboffer.bo.general.Default-offerlabel-label;'));
		$field->setFieldName('offerlabel');
		$field->setIsLocked(true);
		$field->save($formId);
		
		// Initialize first and last name fields.
		$ts = form_TextService::getInstance();
		
		$field = $ts->getNewDocumentInstance();
		$field->setLabel(f_Locale::translate('&modules.joboffer.bo.general.Default-firstname-label;'));
		$field->setFieldName('firstname');
		$field->setRequired(false);
		$field->setIsLocked(true);
		$field->setMultiline(false);
		$field->setCols(50);
		$field->setInitializeWithCurrentUserFirstname(true);
		$field->save($formId);
		
		$field = $ts->getNewDocumentInstance();
		$field->setLabel(f_Locale::translate('&modules.joboffer.bo.general.Default-lastname-label;'));
		$field->setFieldName('lastname');
		$field->setRequired(false);
		$field->setIsLocked(true);
		$field->setMultiline(false);
		$field->setCols(50);
		$field->setInitializeWithCurrentUserLastname(true);
		$field->save($formId);
	}
	
	/**
	 * @param f_peristentdocument_PersistentDocument $container
	 * @param array $attributes
	 * @param string $script
	 * @return array
	 */
	public function getStructureInitializationAttributes($container, $attributes, $script)
	{
		// Check container.
		if (!$container instanceof website_persistentdocument_topic)
		{
			throw new BaseException('Invalid topic', 'modules.joboffer.bo.actions.Invalid-topic');
		}
		
		$node = TreeService::getInstance()->getInstanceByDocument($container);
		if (count($node->getChildren('modules_website/page')) > 0)
		{
			throw new BaseException('This topic already contains pages', 'modules.joboffer.bo.actions.Topic-already-contains-pages');
		}
		
		// Set atrtibutes.
		$attributes['byDocumentId'] = $container->getId();
		return $attributes;
	}
	
	/**
	 * @param Integer $documentId
	 * @return f_persistentdocument_PersistentTreeNode
	 */
	public function getParentNodeForPermissions($documentId)
	{
		$document = DocumentHelper::getDocumentInstance($documentId);
		if ($document instanceof joboffer_persistentdocument_candidacy)
		{
			$offer = $document->getOffer();
			if ($offer !== null)
			{
				return TreeService::getInstance()->getInstanceByDocumentId($offer->getId());
			}
		}
		return null;
	}
}