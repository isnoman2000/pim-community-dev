<?php
namespace Pim\Bundle\ConfigBundle\Tests\Unit\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Pim\Bundle\ConfigBundle\DependencyInjection\PimConfigExtension;

/**
 * Test related class
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2012 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 */
class PimConfigExtensionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected $container;

    /**
     * @var \Pim\Bundle\ConfigBundle\DependencyInjection\PimConfigExtension
     */
    protected $extension;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->extension = new PimConfigExtension();
    }

    /**
     * Test related method
     */
    public function testLoad()
    {
        $configs = array();
        $res = $this->extension->load($configs, $this->container);

        // assert currency configuration
        $configCurrencies = $this->container->getParameter('pim_config.currencies');
        $this->assertCount(1, $configCurrencies);
        $this->assertArrayHasKey('currencies', $configCurrencies);
        $this->assertTrue(is_array($configCurrencies['currencies']));

        // assert language configuration
        $configLanguages = $this->container->getParameter('pim_config.languages');
        $this->assertCount(1, $configLanguages);
        $this->assertArrayHasKey('languages', $configLanguages);
        $this->assertTrue(is_array($configLanguages['languages']));
    }
}