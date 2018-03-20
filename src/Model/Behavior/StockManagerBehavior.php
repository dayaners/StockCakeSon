<?php
namespace Stock\Model\Behavior;


use Stock\Model\Entity\Product;
use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * StockManager behavior
 */
class StockManagerBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function stockIn(Product $product,$qt){
        $this->createOrUpdateStock($product,$qt,true);
    }
    public function stockOut(Product $product,$qt){
        $this->createOrUpdateStock($product,$qt,false);
    }
    private function createOrUpdateStock(Product $product,$qt,$in){
        $stockTable = TableRegistry::get('Stock');
        $stock = $stockTable->find()
                ->where(['product_id'=>$product->id])
                ->first();
        if(!$stock and $in){
            $stock = $stockTable->newEntity();
            $stock->product_id = $product->id;
            $stock->quantity = $qt;
            $stock->unit_price = $product->price;
            $stock->unit_cost = $product->cost;
            return $stockTable->save($stock);
        }
        if($in){
            $stock->quantity +=$qt;
        }else{
            $stock->quantity -=$qt;
        }
        return $stockTable->save($stock);
    }
}
