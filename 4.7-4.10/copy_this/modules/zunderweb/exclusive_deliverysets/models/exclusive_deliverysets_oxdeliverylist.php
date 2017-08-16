<?php
class exclusive_deliverysets_oxdeliverylist extends exclusive_deliverysets_oxdeliverylist_parent
{
    public function getDeliveryList($oBasket, $oUser = null, $sDelCountry = null, $sDelSet = null)
    {
        $aCollectedDeliveries = array();
        
        // ids of deliveries that does not fit for us to skip double check
        $aSkipDeliveries = array();
        $aDelSetList = oxRegistry::get("oxDeliverySetList")->getDeliverySetList($oUser, $sDelCountry, $sDelSet);

        // must choose right delivery set to use its delivery list
        foreach ($aDelSetList as $sDeliverySetId => $oDeliverySet) {
            // loading delivery list to check if some of them fits
            $aDeliveries = $this->_getList($oUser, $sDelCountry, $sDeliverySetId);
            $blDelFound = false;
            $aFoundDeliveries = array();

            foreach ($aDeliveries as $sDeliveryId => $oDelivery) {

                // skipping that was checked and didn't fit before
                if (in_array($sDeliveryId, $aSkipDeliveries)) {
                    continue;
                }

                $aSkipDeliveries[] = $sDeliveryId;

                if ($oDelivery->isForBasket($oBasket)) {

                    // delivery fits conditions
                    $aFoundDeliveries[$sDeliveryId] = $aDeliveries[$sDeliveryId];
                    $blDelFound = true;

                    // removing from unfitting list
                    array_pop($aSkipDeliveries);

                    // maybe checked "Stop processing after first match" ?
                    if ($oDelivery->oxdelivery__oxfinalize->value) {
                        break;
                    }
                }
            }

            // found delivery set and deliveries that fits
            if ($blDelFound) {
                if ($this->_blCollectFittingDeliveriesSets) {
                    // collect only deliveries sets that fits deliveries
                    $aFittingDelSets[$sDeliverySetId] = $oDeliverySet;
                } else {
                    // return collected fitting deliveries

                    $aCollectedDeliveries[$sDeliverySetId] = $aFoundDeliveries;
                }
            }
        }

        //return deliveries sets if found
        if ($this->_blCollectFittingDeliveriesSets && count($aFittingDelSets)) {

            //resetting getting delivery sets list instead of deliveries before return
            $this->_blCollectFittingDeliveriesSets = false;

            //reset cache and list
            $this->setUser(null);
            $this->clear();

            return $aFittingDelSets;
        }

        // return collected fitting deliveries
        $aExclusiveDeliverysets = $this->getConfig()->getConfigParam( "aExclusiveDeliverysets" );
        if (count($aCollectedDeliveries)){
            $aIds = array_keys($aCollectedDeliveries);
            foreach ($aCollectedDeliveries as $sDeliverySetId => $aDeliveries){
                if (in_array($sDeliverySetId, $aExclusiveDeliverysets)){
                    oxRegistry::getSession()->setVariable('sShipSet', $sDeliverySetId);
                    return $aDeliveries;
                }
            }
            oxRegistry::getSession()->setVariable('sShipSet', $aIds[0]);
            return array_shift($aCollectedDeliveries);
        }
        
        // nothing what fits was found
        return array();
    }
}