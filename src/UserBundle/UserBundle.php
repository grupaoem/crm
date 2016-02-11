<?php

namespace UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
    

    
}
