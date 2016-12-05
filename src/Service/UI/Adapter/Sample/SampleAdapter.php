<?php
namespace Sidebeep\Service\UI\Adapter\Sample;

use SidebeepService\RequestAdapter\RequestAdapter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @package Sidebeep\Service\UI\Adapter\Sample
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleAdapter extends RequestAdapter
{

    /**
     * @return FormInterface
     */
    protected function getForm()
    {
        return $this->formFactory->createBuilder()
            ->add('sample', TextType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->getForm();
    }

    /**
     * @param array $data
     *
     * @return mixed Command
     */
    protected function getCommand($data = [])
    {
        // TODO: Implement getCommand() method.
    }
}