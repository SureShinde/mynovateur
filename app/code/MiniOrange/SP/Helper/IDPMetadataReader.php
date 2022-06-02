<?php
namespace Miniorange\SP\Helper;
use DOMElement;
use DOMNode;
use DOMDocument;
use Exception;

use Miniorange\Helper\lib\XMLSecLibs\XMLSecurityKey;
use Miniorange\Helper\lib\XMLSecLibs\XMLSecEnc;
use Miniorange\Helper\lib\XMLSecLibs\XMLSecurityDSig;
use Miniorange\Helper\lib\XMLSecLibs\Utils\XPath;
use Miniorange\SP\Helper\Saml2\SAML2Utilities;

class IDPMetadataReader extends IdentityProviders
{

    private $identityProviders;
    private $serviceProviders;

    public function __construct(DOMNode $xml = NULL){

        $this->identityProviders = array();
        $this->serviceProviders = array();

        $entityDescriptors = SAML2Utilities::xpQuery($xml, './saml_metadata:EntityDescriptor');

        foreach ($entityDescriptors as $entityDescriptor) {
            $idpSSODescriptor = SAML2Utilities::xpQuery($entityDescriptor, './saml_metadata:IDPSSODescriptor');
            
            if(isset($idpSSODescriptor) && !empty($idpSSODescriptor)){
                array_push($this->identityProviders,new IdentityProviders($entityDescriptor));
            }
            //TODO: add sp descriptor
        }
    }

    public function getIdentityProviders(){
        return $this->identityProviders;
    }

    public function getServiceProviders(){
        return $this->serviceProviders;
    }

}