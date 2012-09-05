<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $id
 * @property string $company_name
 * @property string $address
 * @property string $domain
 * @property string $type
 * @property string $image
 * @property string $description
 */
class Pages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
        
        public function getPath($all=true){
	
            if (is_null($this->_PhotoPath)) {
	
                 // I hold the image path and system directory separator in the config/main.php
	
                // this is because I develop on a windows server and normally deploy on Linux
	
                 $this->_PhotoPath=Yii::app()->params['imagePATH'];
	
                 $this->_PathSep=Yii::app()->params['pathSep'];
	
            }
	
            $path=$this->_PhotoPath.$this->_PathSep;
	
            if ($all) $path.=$this->filename;
	
            return $path;
	
        }
        
	public function tableName()
	{
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('company_name, address, domain, image, description', 'required'),
			array('company_name','unique')
                        //array('company_name, address, domain, type, image, description', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('id, company_name, address, domain, type, image, description', 'safe', 'on'=>'search'),
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
		
                          
                );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_name' => 'Company Name',
			'address' => 'Address',
			'domain' => 'Domain',
			'type' => 'Type',
			'image' => 'Image',
			'description' => 'Description',
                    
		);
	}
        
        
        public function scopes()
        {
                        $userId = Yii::app()->user->userId;
            return array(
                        'selected'=>array(
                            'condition'=>"user_id= $userId",
                        ),
                            
                        'selectedall'=>array(
                            'condition'=>"user_id!= $userId",
                        ),

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
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);

		/*return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/
                return new CActiveDataProvider($this->selected(), array(
		'criteria'=>$criteria,
		'sort'=>array(
			'defaultOrder'=>'id ASC',
		),
		'pagination'=>array(
			'pageSize'=>5
		),
            ));
	}
        
        
        
        public function searchall()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);

		/*return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/
                return new CActiveDataProvider($this->selectedall(), array(
		'criteria'=>$criteria,
		'sort'=>array(
			'defaultOrder'=>'id ASC',
		),
		'pagination'=>array(
			'pageSize'=>5
		),
            ));
	}
        
        
        
        
        
        
}
