<?php
class exclusive_deliverysets_oxdeliverysetlist extends exclusive_deliverysets_oxdeliverysetlist_parent 
{
    public function getDeliverySetData($sShipSet, $oUser, $oBasket){
        $aExclusiveDeliverysets = $this->getConfig()->getConfigParam( "aExclusiveDeliverysets" );
        $aImportantDeliverysets = $this->getConfig()->getConfigParam( "aImportantDeliverysets" );
        if (!is_array($aImportantDeliverysets)) $aImportantDeliverysets = array();
        $aData = parent::getDeliverySetData($sShipSet, $oUser, $oBasket);
        $aSets = $aData[0];
        if (is_array($aSets) && is_array($aExclusiveDeliverysets)){
            foreach ($aSets as $sDelSet => $oDelSet){
                if (in_array($sDelSet, $aExclusiveDeliverysets)){
                    //exclusive Shipset found in possible shipsets
                    //remove all shipsets except exclusive and important shipsets from list and get data again
                    $aNewShipsets = array();
                    foreach ($this as $sShipSetId => $oShipSet){
                        if (in_array($sShipSetId, $aExclusiveDeliverysets) || in_array($sShipSetId, $aImportantDeliverysets)){
                                $aNewShipsets[$sShipSetId] = $oShipSet;
                            }
                    }
                    $this->assign($aNewShipsets);
                    //update basket
                    $oBasket->setShipping(oxRegistry::getSession()->getVariable('sShipSet'));
                    $oBasket->setDeliveryPrice();
                    $oBasket->onUpdate();
                    //get data
                    return parent::getDeliverySetData($sShipSet, $oUser, $oBasket);
                }
            }
        }
        return $aData;
    }
}
