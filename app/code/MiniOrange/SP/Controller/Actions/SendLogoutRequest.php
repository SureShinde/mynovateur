<?php

namespace MiniOrange\SP\Controller\Actions;

use MiniOrange\SP\Helper\Saml2\LogoutRequest;
use MiniOrange\SP\Helper\SPConstants;

/**
 * Handles generation and sending of LogoutRequest to the IDP
 * for processing. LogoutRequest is generated based on the ID
 * set in the observer. NameId is fetched and sent in the logout
 * request based on if the user is admin or customer.
 */
class SendLogoutRequest extends BaseAction
{
    private $isAdmin;
    private $userId;
    private $nameId;
    private $sessionIndex;

	/**
	 * Execute function to execute the classes function.
	 * @throws NotRegisteredException
	 * @throws \Exception
	 */

	public function execute()
	{
        $this->spUtility->log_debug("In SendLogoutRequest.php");

        if(!$this->spUtility->isSPConfigured() || !$this->spUtility->isSLOConfigured())
            return;
        //get required values from the database
        $destination = $this->spUtility->getStoreConfig(SPConstants::SAML_SLO_URL);
        $bindingType = $this->spUtility->getStoreConfig(SPConstants::LOGOUT_BINDING);
        $nameId=$this->nameId;
       // $nameId = $this->isAdmin ? $this->spUtility->getAdminStoreConfig(SPConstants::NAME_ID,$this->userId)
        //    : $this->spUtility->getCustomerStoreConfig(SPConstants::NAME_ID,$this->userId);
        $sessionIndex =  $this->isAdmin ? $this->spUtility->getAdminStoreConfig(SPConstants::SESSION_INDEX,$this->userId)
            : $this->spUtility->getCustomerStoreConfig(SPConstants::SESSION_INDEX,$this->userId);
        $sendRelayState = $this->isAdmin ? $this->spUtility->getAdminBaseUrl() : $this->spUtility->getBaseUrl();
        $issuer = $this->spUtility->getIssuerUrl();

        //remove nameid and session index for user
        $this->spUtility->saveConfig(SPConstants::NAME_ID,'',$this->userId,$this->isAdmin);
        $this->spUtility->saveConfig(SPConstants::SESSION_INDEX,'',$this->userId,$this->isAdmin);
        //generate the logout request
        $logoutRequest = (new LogoutRequest())->setIssuer($issuer)->setDestination($destination)
            ->setNameId($nameId)->setSessionIndexes($sessionIndex)
            ->setBindingType($bindingType)->build();
        $this->spUtility->log_debug("In SendLogoutRequest: logoutRequest: ",$logoutRequest);
        // send saml request over
        if(empty($bindingType) || $bindingType == SPConstants::HTTP_REDIRECT){
            $this->spUtility->log_debug("In SendLogoutRequest: logoutRequest: HTTP_REDIRECT");
            return $this->sendHTTPRedirectRequest($logoutRequest,$sendRelayState,$destination);
        }
        else{
            $this->spUtility->log_debug("In SendLogoutRequest: logoutRequest: POST_REDIRECT");
            $this->sendHTTPPostRequest($logoutRequest,$sendRelayState,$destination);
        }

    }


    /** The setter function for the isAdmin Parameter */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }


    /** The setter function for the userId Parameter */
    public function setuserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
    public function setNameId($nameId){
        $this->nameId=$nameId;
        return $this;
    }





}
