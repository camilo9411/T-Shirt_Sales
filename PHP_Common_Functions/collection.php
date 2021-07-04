<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-22      Creation of the class collection with the generic methods of a collection.

class collection {
    
    public $items = array();
    
    public function add($primary_key, $item)
    {
        
        $this->items[$primary_key] = $item;
    }
    
    public function remove($primary_key)
    {
        
        if(isset($this->items[$primary_key]))
        {
            unset($this->items[$primary_key]);
        }
    }
    
    public function get($primary_key)
    {
        
        if(isset($this->items[$primary_key]))
        {
            return $this->items[$primary_key];
        }else{
            return null;
        }
    }
    
    public function count()
    {
        return count($this->items);
    }
}
