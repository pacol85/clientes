<?php

class Archivos extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $id;

    /**
     *
     * @var string
     */
    public $cliente;

    /**
     *
     * @var string
     */
    public $nombre;

    /**
     *
     * @var string
     */
    public $url;

    /**
     *
     * @var string
     */
    public $fsubida;

    /**
     *
     * @var string
     */
    public $fdescarga;

    /**
     *
     * @var string
     */
    public $descargas;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('cliente', 'Clientes', 'id', array('alias' => 'Clientes'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'archivos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Archivos[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Archivos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
