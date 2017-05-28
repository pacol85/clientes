<?php

class Clientes extends \Phalcon\Mvc\Model
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
    public $codigo;

    /**
     *
     * @var string
     */
    public $nombre;

    /**
     *
     * @var string
     */
    public $tipo;

    /**
     *
     * @var string
     */
    public $direccion;

    /**
     *
     * @var string
     */
    public $ciudad;

    /**
     *
     * @var string
     */
    public $pais;

    /**
     *
     * @var string
     */
    public $telefono;

    /**
     *
     * @var double
     */
    public $limiteunidades;

    /**
     *
     * @var double
     */
    public $saldoanterior;

    /**
     *
     * @var double
     */
    public $recepcion;

    /**
     *
     * @var double
     */
    public $despachos;

    /**
     *
     * @var double
     */
    public $factor1;

    /**
     *
     * @var double
     */
    public $factor2;

    /**
     *
     * @var double
     */
    public $factor3;

    /**
     *
     * @var string
     */
    public $usuario;

    /**
     *
     * @var string
     */
    public $clave;

    /**
     *
     * @var string
     */
    public $admin;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Archivos', 'cliente', array('alias' => 'Archivos'));
        $this->hasMany('id', 'Inventario', 'cliente', array('alias' => 'Inventario'));
        $this->hasMany('id', 'Registros', 'cliente', array('alias' => 'Registros'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'clientes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Clientes[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Clientes
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
