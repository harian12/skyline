<?php

class Artikel extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $user_id;

    /**
     *
     * @var string
     */
    protected $judul;

    /**
     *
     * @var string
     */
    protected $isi;

    /**
     *
     * @var integer
     */
    protected $is_public;

    /**
     *
     * @var string
     */
    protected $created;

    /**
     *
     * @var string
     */
    protected $updated;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field judul
     *
     * @param string $judul
     * @return $this
     */
    public function setJudul($judul)
    {
        $this->judul = $judul;

        return $this;
    }

    /**
     * Method to set the value of field isi
     *
     * @param string $isi
     * @return $this
     */
    public function setIsi($isi)
    {
        $this->isi = $isi;

        return $this;
    }

    /**
     * Method to set the value of field is_public
     *
     * @param integer $is_public
     * @return $this
     */
    public function setIsPublic($is_public)
    {
        $this->is_public = $is_public;

        return $this;
    }

    /**
     * Method to set the value of field created
     *
     * @param string $created
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Method to set the value of field updated
     *
     * @param string $updated
     * @return $this
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field judul
     *
     * @return string
     */
    public function getJudul()
    {
        return $this->judul;
    }

    /**
     * Returns the value of field isi
     *
     * @return string
     */
    public function getIsi()
    {
        return $this->isi;
    }

    /**
     * Returns the value of field is_public
     *
     * @return integer
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * Returns the value of field created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Returns the value of field updated
     *
     * @return string
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("skyline");
        $this->setSource("artikel");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'artikel';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Artikel[]|Artikel|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Artikel|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'user_id' => 'user_id',
            'judul' => 'judul',
            'isi' => 'isi',
            'is_public' => 'is_public',
            'created' => 'created',
            'updated' => 'updated'
        ];
    }

}
