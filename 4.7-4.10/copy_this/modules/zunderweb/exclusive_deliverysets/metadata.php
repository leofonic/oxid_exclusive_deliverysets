<?php
$sMetadataVersion = '1.0';

$aModule = array(
    'id'           => 'exclusive_deliverysets',
    'title'        => 'Zunderweb Exclusive Deliverysets',
    'description' =>  array(
        'de'=>'Legen Sie fest dass bestimmte Versandarten exclusiv erscheinen. Wenn eine solche Versandart g&uuml;ltig ist, werden alle anderen Versandarten ausgeblendet.',
        'en'=>'Set specific shipping methods exclusive. If such a shipping method is valid, all other shipping methods are hidden.',
    ),
    'url'         => 'http://zunderweb.de',
    'email'       => 'info@zunderweb.de',
    'author'      => 'Zunderweb',
    'thumbnail'    => '',
    'version'      => '1.0',
    'extend' => array(
        'oxdeliverysetlist' => 'zunderweb/exclusive_deliverysets/models/exclusive_deliverysets_oxdeliverysetlist',
        'oxdeliverylist' => 'zunderweb/exclusive_deliverysets/models/exclusive_deliverysets_oxdeliverylist',
    ),
    'files' => array(
    ),
    'templates' => array(
    ),
    'blocks' => array(
    ),
    'settings'    => array(
        array('group' => 'exclusive_deliverysets_main', 'name' => 'aExclusiveDeliverysets', 'type' => 'arr',  'value' => array('')),
        array('group' => 'exclusive_deliverysets_main', 'name' => 'aImportantDeliverysets', 'type' => 'arr',  'value' => array('')),
    )
);
