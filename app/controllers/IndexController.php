<?php

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->setVar('client_id', getenv('MS_CLIENTID'));
    }
}
