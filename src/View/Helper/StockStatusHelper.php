<?php
namespace Stock\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * StockStatus helper
 */
class StockStatusHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public function status($qt,$alert_quantity){
    	$warning_alert_quantity = $alert_quantity *1.5;
    	if($qt < $alert_quantity){
    		return 'danger';
    	}elseif($qt < $warning_alert_quantity){
    		return 'warning';
    	}
    	return '';
    }
}

