<?php
/**
 * Model for working with Tasks
 *
 * @author ihor@karas.in.ua
 * Date: 04.05.15
 * Time: 22:57
 */

namespace api\common\models;

class Task extends \api\components\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{task}}';
	}

	public static function find() {
		return new TaskQuery(get_called_class());
	}
}

class TaskQuery extends \api\components\db\ActiveQuery
{
}