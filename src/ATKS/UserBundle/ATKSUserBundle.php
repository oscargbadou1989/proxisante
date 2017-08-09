<?php

namespace ATKS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ATKSUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
