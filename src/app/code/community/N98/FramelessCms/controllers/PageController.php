<?php
/**
 * Magento Module
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    N98
 * @package     N98_FramelessCms
 * @copyright   Copyright (c) 2013 netz98 new media GmbH. (http://www.netz98.de)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

require_once 'Mage/Cms/controllers/PageController.php';

/**
 * Frameless CMS Page controller
 *
 * @category   N98
 * @package    N98_FramelessCms
 */
class N98_FramelessCms_PageController extends Mage_Cms_PageController
{
    /**
     * View CMS page action
     *
     */
    public function viewAction()
    {
        $pageId = $this->getRequest()
            ->getParam('page_id', $this->getRequest()->getParam('id', false));

        /* @var $page Mage_Cms_Model_Page */
        $page = Mage::getSingleton('cms/page');
        $page->setStoreId(Mage::app()->getStore()->getId());

        if (!$pageId) {
            $urlKey = $this->getRequest()
                ->getParam('page', false);
            if ($urlKey) {
                $pageId = $page->checkIdentifier($urlKey, Mage::app()->getStore()->getId());
            }
        }

        $page->load($pageId);
        if(!$page->getId()) {
            return $this->_forward('noRoute');
        }

        $page->setCustomRootTemplate(null);
        $page->setRootTemplate(null);
        parent::viewAction();
    }

}