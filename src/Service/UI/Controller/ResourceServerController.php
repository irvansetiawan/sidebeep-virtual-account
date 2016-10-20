<?php
namespace Sidebeep\Service\UI\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use League\OAuth2\Server\Exception\OAuthServerException;
use Sidebeep\Service\App\Handler\AuthHandlerInterface;
use Sidebeep\Service\UI\Response\AuthIdentity;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class ResourceServerController
 * @package Sidebeep\Service\UI\Controller
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ResourceServerController extends FOSRestController
{
    /**
     * @var AuthHandlerInterface
     */
    private $authHandler;

    /**
     * ResourceServer constructor.
     * @param AuthHandlerInterface $authHandler
     */
    public function __construct(AuthHandlerInterface $authHandler)
    {
        $this->authHandler = $authHandler;
    }

    /**
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function indexAction(Request $request)
    {
        $factory = new DiactorosFactory();
        $request = $factory->createRequest($request);
        try {
            $authIdentity = AuthIdentity::fromRequest($this->authHandler->validateAccessToken($request));
        } catch (OAuthServerException $e) {
            throw new HttpException(Response::HTTP_UNAUTHORIZED, 'Invalid access token');
        } catch (\Exception $e) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->view($authIdentity);
    }
}
