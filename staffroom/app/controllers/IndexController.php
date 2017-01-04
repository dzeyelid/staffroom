<?php

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->setVar('client_id', getenv('CUSTOMCONNSTR_MS_CLIENTID'));
    }
}
