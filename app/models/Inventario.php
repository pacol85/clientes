<?php

class Inventario extends \Phalcon\Mvc\Model
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
    public $ipdrod;

    /**
     *
     * @var string
     */
    public $producto;

    /**
     *
     * @var string
     */
    public $cliente;

    /**
     *
     * @var string
     */
    public $barco;

    /**
     *
     * @var string
     */
    public $fecha;

    /**
     *
     * @var string
     */
    public $fecha2;

    /**
     *
     * @var string
     */
    public $especificaciones;

    /**
     *
     * @var double
     */
    public $salant;

    /**
     *
     * @var double
     */
    public $entrada;

    /**
     *
     * @var double
     */
    public $traslado;

    /**
     *
     * @var double
     */
    public $saldo;

    /**
     *
     * @var double
     */
    public $salantd;

    /**
     *
     * @var double
     */
    public $disponible;

    /**
     *
     * @var double
     */
    public $despacho;

    /**
     *
     * @var double
     */
    public $liberado;

    /**
     *
     * @var double
     */
    public $saldod;

    /**
     *
     * @var double
     */
    public $impuesto;

    /**
     *
     * @var double
     */
    public $retenido;

    /**
     *
     * @var double
     */
    public $otro;

    /**
     *
     * @var string
     */
    public $concepto;

    /**
     *
     * @var string
     */
    public $ultimaTran;

    /**
     *
     * @var string
     */
    public $numerodm;

    /**
     *
     * @var double
     */
    public $merma;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('cliente', 'Clientes', 'id', array('alias' => 'Clientes'));
        $this->belongsTo('barco', 'Barcos', 'id', array('alias' => 'Barcos'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'inventario';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Inventario[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Inventario
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
