<?php

/**
 * This is the model class for table "message_chat".
 *
 * The followings are the available columns in table 'message_chat':
 * @property integer $id
 * @property integer $message_id
 * @property integer $user_id
 * @property integer $sender_id
 * @property string $message
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Messages $message0
 * @property Users $user
 * @property Users $sender
 */
class MessageChat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MessageChat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'message_chat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message_id, user_id, sender_id, message', 'required'),
			array('message_id, user_id, sender_id', 'numerical', 'integerOnly'=>true),
			array('message', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, message_id, user_id, sender_id, message, date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'message' => array(self::BELONGS_TO, 'Messages', 'message_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'message_id' => 'Message',
			'user_id' => 'User',
			'sender_id' => 'Sender',
			'message' => 'Message',
			'date' => 'Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('message_id',$this->message_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}