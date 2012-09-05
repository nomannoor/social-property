<?php

/**
 * This is the model class for table "sub_page".
 *
 * The followings are the available columns in table 'sub_page':
 * @property integer $id
 * @property integer $bussiness_page_id
 * @property string $name
 * @property string $domain
 * @property string $description
 */
class SubPage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SubPage the static model class
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
		return 'sub_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bussiness_page_id, name, domain, description', 'required'),
			array('bussiness_page_id', 'numerical', 'integerOnly'=>true),
			array('name, domain, description', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, bussiness_page_id, name, domain, description', 'safe', 'on'=>'search'),
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
                    'page'=>array(self::BELONGS_TO, 'Pages', 'bussiness_page_id'),   
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'bussiness_page_id' => 'Bussiness Page',
			'name' => 'Name',
			'domain' => 'Domain',
			'description' => 'Description',
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
		$criteria->compare('bussiness_page_id',$this->bussiness_page_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}