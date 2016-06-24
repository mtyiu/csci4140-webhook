<?php
namespace CSCI4140\WebhookBundle\Service;

class WebhookHandler
{
    private $secret;
    private $data;
    private $event;
    private $delivery;

    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getDelivery()
    {
        return $this->delivery;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function handle( $signature, $event, $delivery, $payload )
    {
        if (!$this->validate( $signature, $event, $delivery, $payload )) {
            return false;
        }
        return true;
    }

    public function validate( $signature, $event, $delivery, $payload )
    {
        // $signature = @$_SERVER['HTTP_X_HUB_SIGNATURE'];
        // $event = @$_SERVER['HTTP_X_GITHUB_EVENT'];
        // $delivery = @$_SERVER['HTTP_X_GITHUB_DELIVERY'];
        // $payload = file_get_contents('php://input');
        if (!isset($signature, $event, $delivery)) {
            return false;
        }

        if (!$this->validateSignature($signature, $payload)) {
            return false;
        }

        $this->data = json_decode($payload,true);
        $this->event = $event;
        $this->delivery = $delivery;
        return true;
    }

    protected function validateSignature($gitHubSignatureHeader, $payload)
    {
        list ($algo, $gitHubSignature) = explode("=", $gitHubSignatureHeader);

        if ($algo !== 'sha1') {
            return false;
        }

        $payloadHash = hash_hmac($algo, $payload, $this->secret);
        return ($payloadHash === $gitHubSignature);
    }
}
