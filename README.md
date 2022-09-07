OXID Exclusive Shipping Methods
===============================

OXID eShop: With this module, you can set shipping methods exclusive. If such a shipping method is valid, all other shipping methods are hidden. Additionally, important shipsets can be defined that are not hidden.

Legen Sie fest dass bestimmte Versandarten exclusiv erscheinen. Wenn eine solche Versandart gültig ist, werden alle anderen Versandarten ausgeblendet. Zudem können wichtige Versandarten davon ausgenommen werden.

Suitable for OXID Version 4.x and 6.x

Installation: 
1. Copy the contents of the folder "copy_this" into the root folder of your shop (the folder containing "modules" directory). 
2. OXID Version 6.2 and above: execute "vendor/bin/oe-console oe:module:install-configuration source/modules/zunderweb/exclusive_deliverysets" on the commandline in the root folder of the installation (the folder containing "source" and "vendor").
3. Activate the module in backend
4. Enter the IDs (the oxids, not the names) of the shipping methods that should be exclusive (all other shipping methods are hidden) or important (never hidden by the module) in the settings of the module.
