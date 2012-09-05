<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {
        $record = User::model()->findByAttributes(array('username' => $this->username, 'is_active' => 1));
        if (!$record){
        $record = User::model()->findByAttributes(array('email' => $this->username, 'is_active' => 1));
        }
        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($record->password !== md5($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $record->id;
            $this->setState('userId', $record->id);
            $this->setState('username', $record->username);
            $this->setState('usertype', $record->user_type);
            $this->errorCode = self::ERROR_NONE;

            include_once(Yii::app()->basePath . '/../ip2locationlite.class.php');

//Load the class
            $ipLite = new ip2location_lite;
            $ipLite->setKey('6d81a70b31f21d507cdf42cc2d3d9f2f2592821074b0e5191012c1584a68c9cb');

//Get errors and locations
            $locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
            $errors = $ipLite->getError();

//Getting the result
            Yii::app()->session['latitude'] = $locations['latitude'];
            Yii::app()->session['longitude'] = $locations['longitude'];
            
            Yii::app()->session['isLoggedIn'] = true;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}