<?php
class exclusive_deliverysets_oxdeliverysetlist extends exclusive_deliverysets_oxdeliverysetlist_parent 
{
    protected function _getList($oUser = null, $sCountryId = null)
    {
        $aExclusiveDeliverysets = $this->getConfig()->getConfigParam( "aExclusiveDeliverysets" );
        parent::_getList($oUser, $sCountryId);
        if (is_array($aExclusiveDeliverysets)){
            foreach ($this as $sDelSet => $oDelSet){
                if (in_array($sDelSet, $aExclusiveDeliverysets)){
                    $this->assign(array ($sDelSet => $oDelSet));
                }
            }
        }
        return $this;
    }
}
