<?php
namespace Sidebeep\Service\UI\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\Serializer;
use Sidebeep\Service\UI\Adapter\SampleCommandAdapter;
use Sidebeep\Service\UI\Request\SampleRequest;
use Sidebeep\Service\UI\Response\SampleResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class SampleController extends FOSRestController
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * SampleController constructor.
     * @param Serializer $serializer
     * @param ContainerInterface $container
     */
    public function __construct(Serializer $serializer, ContainerInterface $container)
    {
        $this->serializer = $serializer;
        $this->container = $container;
    }

    /**
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function indexAction(Request $request)
    {
        // Convert Request into command
        $adapter = new SampleCommandAdapter();
        $command = $adapter->createCommandFromRequest(
            new SampleRequest(json_decode($request->getContent(), true))
        );

        // tell command bus to handle command and get the result
        $result = $this->container->get('command_bus')->handle($command);

        // convert the result to serializable Response
        $response = SampleResponse::getSampleResponseFrom($result);

        // tell the controller to handle view with the response
        return $this->view($response);
    }
}
