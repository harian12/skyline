<?php

class Products extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $typeId;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $price;
 
    /**
     *
     * @var integer
     */
    public $quantity;

    /**
     *
     * @var string
     */
    public $status;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTypesId($typesId)
    {
        $this->typesId = $typesId;
    }
    
    public function getName($name)
    {
        $this->name = $name;
    }

    public function getPrice($price)
    {
        $this->price = $price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getStatus()
    {
        return $this->status; 
    }
    

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("skyline");
        $this->setSource("products");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'products';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products[]|Products|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
