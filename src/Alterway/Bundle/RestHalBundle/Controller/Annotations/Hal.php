<?php

namespace Alterway\Bundle\RestHalBundle\Controller\Annotations;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;

/**
 * @Annotation
 */
class Hal implements ConfigurationInterface
{
    public $code = 200;

    public function getAliasName()
    {
        return 'hal_config';
    }

    public function allowArray()
    {
        return false;
    }
}
