<?php

class Chequeo extends \Phalcon\Mvc\Model
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
    public $placa;

    /**
     *
     * @var string
     */
    public $fecha;

    /**
     *
     * @var string
     */
    public $ruta;

    /**
     *
     * @var string
     */
    public $ok;

    /**
     *
     * @var string
     */
    public $codingenios;

    /**
     *
     * @var string
     */
    public $codunidad;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'chequeo';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Chequeo[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Chequeo
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
