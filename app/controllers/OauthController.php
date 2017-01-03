<?php

use \League\OAuth2\Client\Provider\GenericProvider;

class OauthController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->disable();

        $provider = new GenericProvider([
            'clientId'          => getenv('CUSTOMCONNSTR_MS_CLIENTID'),
            'clientSecret'      => getenv('CUSTOMCONNSTR_MS_CLIENTSECRET'),
            'redirectUri'       => $this->config->oauth->callback,
            'urlAuthorize'      => 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize',
            'urlAccessToken'    => 'https://login.microsoftonline.com/common/oauth2/v2.0/token',
            'urlResourceOwnerDetails'   => '',
            'scopes'            => 'openid mail.send'
        ]);

        $code = $this->request->has('code') | $this->request->hasGet('code') | $this->request->hasPost('code');
        if (! $code) {
            return $this->response->redirect($provider->getAuthorizationUrl(), true);
        }
        else {
            $accessToken = $provider->getAccessToken('authorization_code', [
                'code'  => $this->request->getQuery('code')
            ]);
            $this->view->setVar('token', $accessToken->getToken());
        }
    }
}

