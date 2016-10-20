<?php
namespace Sidebeep\Service\UI\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\Serializer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Sidebeep\Service\App\Handler\AuthHandlerInterface;
use Sidebeep\Service\UI\Adapter\TokenCommandRequestAdapter;
use Sidebeep\Service\UI\Request\TokenRequest;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class TokenController
 * @package Sidebeep\Service\UI\Controller
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class TokenController extends FOSRestController
{
    /**
     * @var AuthHandlerInterface
     */
    private $authHandler;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * AuthController constructor.
     * @param AuthHandlerInterface $authHandler
     * @param Serializer $serializer
     */
    public function __construct(AuthHandlerInterface $authHandler, Serializer $serializer)
    {
        $this->authHandler = $authHandler;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function indexAction(Request $request)
    {
        $httpFoundationFactory = new HttpFoundationFactory();
        $psr7Factory = new DiactorosFactory();

        $request = $psr7Factory->createRequest($request);

        try {
            $response = $this->authHandler->getToken($request);
            return $httpFoundationFactory->createResponse($response);
        } catch (OAuthServerException $e) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (\Exception $e) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }
}
