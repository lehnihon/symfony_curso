<?php
namespace SON\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Template()
 */
class LoginController extends Controller
{
    /**
     * @Route("/login")
     */
    public function loginAction(){
        $request = $this->get('request_stack')->getCurrentRequest();
        $session = $request->getSession();

        $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        $session->remove(SecurityContext::AUTHENTICATION_ERROR);

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error
        );
    }

    /**
     * @Route("/login_check")
     */
    public function loginCheckAction(){}

    /**
     * @Route("/logout")
     */
    public function logoutAction(){}
} 