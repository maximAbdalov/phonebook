<?php

class Phones extends \Phalcon\Mvc\Model
{
	/**
	 *
	 * @var integer
	 * @Primary
	 * @Identity
	 * @Column(type="integer", length=11, nullable=false)
	 */
	public $id;

	/**
	 *
	 * @var string
	 * @Column(type="string", length=30, nullable=false)
	 */
	public $phone;

	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSchema("phonebook");
		$this->setSource("phones");
		$this->belongsTo('user_id', 'Users', 'id');
	}

	/**
	 * Returns table name mapped in the model.
	 *
	 * @return string
	 */
	public function getSource()
	{
		return 'phones';
	}

	/**
	 * Allows to query a set of records that match the specified conditions
	 *
	 * @param mixed $parameters
	 * @return Users[]|Users|\Phalcon\Mvc\Model\ResultSetInterface
	 */
	public static function find($parameters = null)
	{
		return parent::find($parameters);
	}

	/**
	 * Allows to query the first record that match the specified conditions
	 *
	 * @param mixed $parameters
	 * @return Users|\Phalcon\Mvc\Model\ResultInterface
	 */
	public static function findFirst($parameters = null)
	{
		return parent::findFirst($parameters);
	}

}
