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

/**
 * Frameless CMS Page controller
 *
 * @category   N98
 * @package    N98_FramelessCms
 */
class N98_FramelessCms_Test_Controller_PageController extends EcomDev_PHPUnit_Test_Case_Controller
{

    /**
     * @test
     */
    public function viewActionError()
    {
        $this->dispatch('frameless/page/view/page/foobar');
        $this->assertRequestActionName('defaultNoRoute');

        $this->dispatch('frameless/page/view/page_id/999');
        $this->assertRequestActionName('noRoute');
    }

    /**
     * @test
     * @loadFixture ~N98_FramelessCms/default
     */
    public function viewActionById()
    {
        $this->dispatch('frameless/page/view/page_id/1');
        $this->assertRequestRoute('frameless/page/view');
        $this->assertLayoutBlockNotRendered('breadcrumbs');
        $this->assertTrue(strpos($this->getResponse()->getOutputBody(), 'Test Content') !== false);

        $this->dispatch('frameless/page/view/id/1');
        $this->assertRequestRoute('frameless/page/view');
        $this->assertLayoutBlockNotRendered('breadcrumbs');
        $this->assertTrue(strpos($this->getResponse()->getOutputBody(), 'Test Content') !== false);
    }

    /**
     * @test
     * @loadFixture ~N98_FramelessCms/default
     */
    public function viewActionByName()
    {
        $this->dispatch('frameless/page/view/page/test');
        $this->assertRequestRoute('frameless/page/view');
        $this->assertLayoutBlockNotRendered('breadcrumbs');
        $this->assertTrue(strpos($this->getResponse()->getOutputBody(), 'Test Content') !== false);
    }
}