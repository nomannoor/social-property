<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $user_type
 * @property integer $is_active
 */
class User extends CActiveRecord {

    public $ConfirmPassword;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, email, user_type', 'required'),
            array('username,email', 'unique'),
            array('email', 'email'),
            
            array('user_type', 'numerical', 'integerOnly' => true),
            array('username, password, email', 'length', 'max' => 255),
            //array('ConfirmPassword', 'compare', 'compareAttribute' => 'password'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, email, user_type, is_active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userProfile'=>array(self::HAS_ONE, 'UserProfile', 'user_id'),
            'posts'=>array(self::HAS_MANY, 'Post', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'user_type' => 'You are',
            'is_active' => 'Is Active',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('user_type', $this->user_type);
        $criteria->compare('is_active', $this->is_active);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    

}