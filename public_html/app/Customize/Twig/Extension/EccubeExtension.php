<?php
namespace Customize\Twig\Extension;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EccubeExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('instagram', [$this, 'getFeed']),
        ];
    }

    public function getFeed() {
        echo do_shortcode( '[instagram-feed feed=1]' );
    }

    public function chainStore()
    {
        $LoginTypeInfo = $this->getLoginTypeInfo();
        $LoginType = $LoginTypeInfo['LoginType'];
        if ( $LoginType == 3 ) {
          return true;
        } else {
          return false;
        }
    }

    private function getLoginTypeInfo()
    {
        $LoginType = 1;         //Default is guest
        $Customer = $this->getCurrentUser();
        $ChainStore = null;
        $ContractType = null;

        if (is_object($Customer)) {
            $ChainStore = $Customer->getChainStore();

            if(is_object($ChainStore)){
                $LoginType = 3;         //ChainStore member
                $ContractType = $ChainStore->getContractType();
            }else{
                $LoginType = 2;         //Normal member
            }
        }else{
            $Customer = null;
        }

        return [
            'LoginType' => $LoginType,
            'Customer' => $Customer,
            'ChainStore' => $ChainStore,
            'ContractType' => $ContractType,
        ];
    }

    private function getCurrentUser()
    {
        if(!$this->tokenStorage){
            return null;
        }

        if (!$token = $this->tokenStorage->getToken()) {
            return null;
        }

        if (!$token->isAuthenticated()) {
            return null;
        }

        if(!$user = $token->getUser()){
            return null;
        }

        if(is_object($user)){
            return $user;
        }

        return null;
    }
}