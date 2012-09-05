<?php

/**
 * This is the model class for table "user_profiles".
 *
 * The followings are the available columns in table 'user_profiles':
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $contact_number
 * @property string $company_name
 * @property integer $country_id
 * @property string $join_date
 * @property string $image
 */
class UserProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserProfile the static model class
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
		return 'user_profiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, first_name, last_name, contact_number, country_id, join_date, dob, address, city, state, gender', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, contact_number', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, first_name, last_name, contact_number, image,country_id, join_date, city, dob, state, address, gender', 'safe', 'on'=>'search'),
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
                    'user'=>array(self::HAS_ONE, 'User', 'id'),
		);
	}
        
        
        public function scopes()
        {
            return array(
                'Username'=>array(
                    'condition'=>'first_name !="" AND last_name !=""',
                ),
                
            );
        }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'contact_number' => 'Contact Number',
			'company_name' => 'Company Name',
			'country_id' => 'Country',
			'join_date' => 'Join Date',
                        'dob' => 'Date of Birth',
                        'image' => 'Image',
                    
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('join_date',$this->join_date,true);

		return new CActiveDataProvider($this->Username(), array(
		'criteria'=>$criteria,
		'sort'=>array(
			'defaultOrder'=>'first_name DESC',
		),
		'pagination'=>array(
			'pageSize'=>10
		),
	));
	}
}