<?php

namespace Christian\HolaMundo\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallData implements InstallDataInterface{
    
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getTable('christian_holamundo');
        
        $data = [
            array('value'=>'value01','option'=>'option01'),
            array('value'=>'value02','option'=>'option02'),
        ];

        $setup->getConnection()->insertMultiple($table,$data);

        $setup->endSetup();
    }
}