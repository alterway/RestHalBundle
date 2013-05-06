<?php

namespace Alterway\Bundle\RestHalBundle\Controller\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;

class Hal extends Annotation implements ConfigurationInterface
{
    public $code = 200;

    public function allowArray()
    {
        return false;
    }

    public function getAliasName()
    {
        return 'hal_rest';
    }
}
