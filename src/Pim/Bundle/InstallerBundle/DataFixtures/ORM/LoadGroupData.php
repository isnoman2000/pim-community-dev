<?php
namespace Pim\Bundle\InstallerBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Pim\Bundle\ProductBundle\Entity\ProductAttribute;
use Oro\Bundle\FlexibleEntityBundle\Manager\FlexibleManager;
use Pim\Bundle\ProductBundle\Entity\AttributeGroupTranslation;
use Pim\Bundle\ProductBundle\Entity\AttributeGroup;
use Symfony\Component\Yaml\Yaml;

/**
 * Load fixtures for attribute groups
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2012 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 */
class LoadGroupData extends AbstractInstallerFixture
{
    /**
     * count groups created to order them
     * @staticvar integer
     */
    static protected $order = 0;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $configuration = Yaml::parse(realpath($this->getFilePath()));

        if (isset($configuration['groups'])) {
            foreach ($configuration['groups'] as $code => $data) {
                $group = $this->createGroup($code, $data['labels']);
                $manager->persist($group);
                $this->addReference('attribute-group.'.$group->getCode(), $group);
            }
        }

        $manager->flush();
    }

    /**
     * Create a group
     *
     * @param string $code
     * @param array  $translations
     *
     * @return \Pim\Bundle\ProductBundle\Entity\AttributeGroup
     */
    protected function createGroup($code, $translations)
    {
        $group = new AttributeGroup();
        $group->setCode($code);
        $group->setName($translations['default']);
        $group->setSortOrder(++self::$order);

        foreach ($translations as $locale => $label) {
            $translation = $this->createTranslation($group, $locale, $label);
            $group->addTranslation($translation);
        }

        return $group;
    }

    /**
     * Create a translation entity
     *
     * @param AttributeGroup $entity AttributeGroup entity
     * @param string         $locale Locale used
     * @param string         $name   Name translated in locale value linked
     *
     * @return \Pim\Bundle\ProductBundle\Entity\AttributeGroupTranslation
     */
    protected function createTranslation($entity, $locale, $name)
    {
        $translation = new AttributeGroupTranslation();
        $translation->setContent($name);
        $translation->setField('name');
        $translation->setForeignKey($entity);
        $translation->setLocale($locale);
        $translation->setObjectClass('Pim\Bundle\ProductBundle\Entity\AttributeGroup');

        return $translation;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 5;
    }
}