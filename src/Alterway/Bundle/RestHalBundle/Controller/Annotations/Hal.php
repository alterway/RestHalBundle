<?php

namespace Alterway\Bundle\RestHalBundle\Controller\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Hal extends Annotation implements ConfigurationInterface
{

    public $type = 'application/hal+json';
    public $code = 'code';

    public function allowArray()
    {
        return false;
    }

    public function getAliasName()
    {
        return 'hal_rest';
    }

}
