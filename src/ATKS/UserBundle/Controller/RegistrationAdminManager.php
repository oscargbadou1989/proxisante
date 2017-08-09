<?php

namespace ATKS\UserBundle\Controller;

use PUGX\MultiUserBundle\Controller\RegistrationManager as BaseManager;

class RegistrationAdminManager extends BaseManager {

    public function register($class) {
        $this->userDiscriminator->setClass($class);

        $this->controller->setContainer($this->container);
        $result = $this->controller->registerAction($this->container->get('request'));
        //die(var_dump($result));
        if ($result instanceof RedirectResponse) {
            return $result;
        }
        
        $template = $this->userDiscriminator->getTemplate('registration');
        if (is_null($template)) {
            $engine = $this->container->getParameter('fos_user.template.engine');
            $template = 'FOSUserBundle:Registration:register.html.' . $engine;
        }
        if (!$this->container->get("security.context")->isGranted("ROLE_ADMIN")) {
            $form = $this->formFactory->createForm();
        }else{
            $form = $this->container->get("form.factory")->create($this->container->get("atks_admin.registration.form.type"));
        }
        
        return $this->container->get('templating')->renderResponse($template, array(
                    'form' => $form->createView(),
        ));
    }

}
