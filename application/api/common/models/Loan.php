<?php
/**
 * Model for working with Tasks
 *
 * @author ihor@karas.in.ua
 * Date: 04.05.15
 * Time: 22:57
 */

namespace api\common\models;

class Loan extends \api\components\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{loan}}';
	}

	public static function find() {
		return new LoanQuery(get_called_class());
	}
}

class LoanQuery extends \api\components\db\ActiveQuery
{
}