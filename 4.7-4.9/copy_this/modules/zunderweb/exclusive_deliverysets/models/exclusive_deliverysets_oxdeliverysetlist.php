<?php
class exclusive_deliverysets_oxdeliverysetlist extends exclusive_deliverysets_oxdeliverysetlist_parent 
{
    public function getDeliverySetData($sShipSet, $oUser, $oBasket){
        $aExclusiveDeliverysets = $this->getConfig()->getConfigParam( "aExclusiveDeliverysets" );
        $aData = parent::getDeliverySetData($sShipSet, $oUser, $oBasket);
        $aSets = $aData[0];
        if (is_array($aSets) && is_array($aExclusiveDeliverysets)){
            foreach ($aSets as $sDelSet => $oDelSet){
                if (in_array($sDelSet, $aExclusiveDeliverysets)){
                    //exclusive Shipset found in possible shipsets
                    //remove all other shipsets from list and get data again
                    $this->assign(array ($sDelSet => $oDelSet));
                    //update basket
                    $oBasket->setShipping($sDelSet);
                    $oBasket->setDeliveryPrice();
                    $oBasket->calculateBasket(true);
                    //get data
                    return parent::getDeliverySetData($sDelSet, $oUser, $oBasket);
                }
            }
        }
        return $aData;
    }
}
