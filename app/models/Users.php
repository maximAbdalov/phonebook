<?php

class Users extends \Phalcon\Mvc\Model
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
	 * @Column(type="string", length=255, nullable=false)
	 */
	public $fio;

	/**
	 *
	 * @var string
	 * @Column(type="string", length=255, nullable=false)
	 */
	public $notes;

	/**
	 *
	 * @var string
	 * @Column(type="string", nullable=false)
	 */
	public $created_at;

	/**
	 *
	 * @var string
	 * @Column(type="string", nullable=false)
	 */
	public $updatet_at;

	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSchema("phonebook");
		$this->setSource("users");
		$this->hasMany(
			'id',
			'Phones',
			'user_id'
		);
	}

	/**
	 * Returns table name mapped in the model.
	 *
	 * @return string
	 */
	public function getSource()
	{
		return 'users';
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
