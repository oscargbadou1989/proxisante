<?php

namespace ATKS\UserBundle\Controller;

use \FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityAdminController extends BaseController {

    protected function renderLogin(array $data) {
        $template = sprintf('ATKSUserBundle:Security:admin_login.html.%s', $this->container->getParameter('fos_user.template.engine'));

        return $this->container->get('templating')->renderResponse($template, $data);
    }

}
