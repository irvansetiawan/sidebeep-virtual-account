<?php

namespace Sidebeep\Service\UI\Request;

use SidebeepService\RequestAdapter\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SampleRequest extends Request
{
    /**
     * SampleRequest constructor.
     * @param null $options
     */
    public function __construct($options = null)
    {
        $options = null !== $options ? $options : [];

        $resolver = new OptionsResolver();

        $resolver->setDefined([
            'prop_1',
            'prop_2',
        ]);

        $resolver->setRequired([
            'prop_1',
            'prop_2'
        ]);

        $resolver->setAllowedTypes('prop_1', 'string');
        $resolver->setAllowedTypes('prop_2', 'string');

        $this->requestParameters = $resolver->resolve($options);
    }
}
