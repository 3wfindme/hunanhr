<?php
namespace HR\PositionBundle\Entity;

use FOS\ElasticaBundle\Transformer\HighlightableModelInterface;
use HR\LocationBundle\Entity\City;
use HR\PositionBundle\Model\Position as BasePosition;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 *
 */
class Position extends BasePosition implements HighlightableModelInterface
{
    public function getTypeName()
    {
        $degrees = self::getTypes();

        return $degrees[$this->type];
    }

    public static function getTypes()
    {
        return array(
            1 => '全职',
            2 => '兼职',
            3 => '临时',
            4 => '实习'
        );
    }

    /**
     * Set ElasticSearch highlight data.
     *
     * @param array $highlights array of highlight strings
     */
    public function setElasticHighlights(array $highlights)
    {
        if (isset($highlights['position'])) {
            $this->setPosition(implode('', $highlights['position']));
        }

        if (isset($highlights['description'])) {
            $this->setDescription(implode('', $highlights['description']));
        }

        if (isset($highlights['companyName'])) {
            $this->setCompanyName(implode('', $highlights['companyName']));
        }

        if (isset($highlights['city'])) {
            $city = new City();
            $city->setName(implode('', $highlights['city']));
            $this->setCity($city);
        }

        if (isset($highlights['location'])) {
            $this->setLocation(implode('', $highlights['location']));
        }
    }
}