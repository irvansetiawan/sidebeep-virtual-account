<?php
namespace Sidebeep\Service\UI\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use JMS\Serializer\Serializer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Sidebeep\Service\App\Command\AuthorizationCommand;
use Sidebeep\Service\App\Handler\AuthHandlerInterface;
use Sidebeep\Service\UI\Entity\Login;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class AuthorizeController
 * @package Sidebeep\Service\UI\Controller
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AuthorizeController extends FOSRestController
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
     * @param ContainerInterface $container
     */
    public function __construct(
        AuthHandlerInterface $authHandler,
        Serializer $serializer,
        ContainerInterface $container
    ) {
        $this->setContainer($container);
        $this->authHandler = $authHandler;
        $this->serializer = $serializer;
    }

    /**
     * @QueryParam(
     *     name="response_type",
     *     requirements={
     *         "rule" = "(token|code)",
     *         "error_message" = "response_type must be 'token' or 'code'"
     *     },
     *     strict=true,
     *     nullable=false,
     *     description="Response Type"
     * )
     *
     * @QueryParam(
     *     name="client_id",
     *     requirements={
     *         "rule" = "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}",
     *         "error_message" = "client id is not valid"
     *     },
     *     strict=true,
     *     nullable=false,
     *     description="Client ID"
     * )
     *
     * @QueryParam(
     *     name="redirect_uri",
     *     requirements={
     *         "rule" = "(?i)\b((?:https?://|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'"".,<>?«»“”‘’]))",
     *         "error_message" = "redirect_uri is not valid"
     *     },
     *     strict=true,
     *     nullable=false,
     *     description="Redirect URI"
     * )
     *
     * @QueryParam(
     *     name="scope",
     *     nullable=true,
     *     description="Scope"
     * )
     *
     * @QueryParam(
     *     name="state",
     *     nullable=true,
     *     description="State"
     * )
     *
     * @param Request $request
     * @param ParamFetcher $paramFetcher
     * @return array|View
     */
    public function indexAction(Request $request, ParamFetcher $paramFetcher)
    {
        try {
            $responseType = $paramFetcher->get('response_type');
            $clientId = $paramFetcher->get('client_id');
            $redirectUri = $paramFetcher->get('redirect_uri');
            $scope = $paramFetcher->get('scope');
            $state = $paramFetcher->get('state');

            $command = new AuthorizationCommand(
                $responseType,
                $clientId,
                $redirectUri,
                $scope,
                $state
            );

            $authRequest = $this->authHandler->validateAuthorization($command);

            $login = new Login();

            $form = $this->createFormBuilder($login)
                ->add('username', EmailType::class, ['error_bubbling' => true])
                ->add('password', PasswordType::class, ['error_bubbling' => true])
                ->add('login', SubmitType::class, ['label' => 'Login'])
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var Login $login */
                $login = $form->getData();
                $user = $this->authHandler->getUser($login->getUsername(), $login->getPassword());
                if (!is_null($user)) {
                    $response = $this->authHandler->processAuthRequest($authRequest, $user);
                    $httpFoundationFactory = new HttpFoundationFactory();
                    $response = $httpFoundationFactory->createResponse($response);
                    return $this->redirect(urldecode($response->headers->get('Location')));
                }
                $form->addError(new FormError('Invalid user credentials!'));
            }

            $view = View::create([
                'form' => $form->createView()
            ], Response::HTTP_OK);

            $view->setTemplate('@templates/login.html.twig');

            $view->setFormat('html');

            return $this->handleView($view);
        } catch (BadRequestHttpException $e) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->headers->set('Content-Type', 'text/html; charset=utf-8');
            return $this->render('@templates/error.html.twig', [
                'message' => $e->getMessage(),
                'code' => $response->getStatusCode()
            ], $response);
        } catch (OAuthServerException $e) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
            $response->headers->set('Content-Type', 'text/html; charset=utf-8');
            return $this->render('@templates/error.html.twig', [
                'message' => $e->getMessage(),
                'code' => $response->getStatusCode()
            ], $response);
        } catch (\Exception $e) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->headers->set('Content-Type', 'text/html; charset=utf-8');
            return $this->render('@templates/error.html.twig', [
                'message' => $e->getMessage(),
                'code' => $response->getStatusCode()
            ], $response);
        }
    }
}
