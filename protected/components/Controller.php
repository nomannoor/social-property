<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
        public function __constructor(){
         
        }
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public function checkTime($date) {
        $tt = strtotime($date);
        $total = (time() - $tt);
        $second = ($total);
        $min = (round($total / 60));
        $hours = (round($min / 60));
        $day = (round($hours / 24));
        $month = (round($day / 28));
        $year = (round($month / 12));

        if ($month > 11) {
            $result = $year . " year ago";
        } elseif ($day > 28) {
            if ($month == 1) {
                $result = $month . " month ago";
            } else {
                $result = $month . " months ago";
            }
        } elseif ($hours > 23) {
            if ($day == 1) {
                $result = $day . " day ago";
            } else {

                $result = $day . " days ago";
            }
        } elseif ($min > 59) {
            if ($hours == 1) {
                $result = $hours . " hour ago";
            } else {
                $result = $hours . " hours ago";
            }
        } elseif ($total > 59) {
            if ($min == 1) {
                $result = $min . " minute ago";
            } else {
                $result = $min . " minutes ago";
            }
        } else {
            if ($second < 25) {
                $result = 'just now';
            } elseif ($second < 30) {
                $result = '15' . " seconds ago";
            } elseif ($second < 35) {
                $result = '25' . " seconds ago";
            } elseif ($second < 45) {
                $result = '35' . " seconds ago";
            } elseif ($second < 50) {
                $result = '45' . " seconds ago";
            } else {
                $result = '55' . " seconds ago";
            }
        }
        return $result;
    }
    public function notification($userId,$sender_id,$message,$date,$type){
      $notification = new Notification;
      $notification->user_id = $sender_id;
      $notification->sender_id = $userId;
      $notification->message = $message;
      $notification->date = $date;
       $notification->type = $type;
      $notification->is_read = 0;
      $notification->save(false);
      
      
      
        
    }
    public function setSession() {
        if (isset(Yii::app()->request->cookies['userId']->value)) {
            $userId = Yii::app()->request->cookies['userId']->value;
            $username = Yii::app()->request->cookies['username']->value;
            $userType = Yii::app()->request->cookies['userType']->value;
            Yii::app()->user->setState('userId', $userId);
            Yii::app()->user->setState('username', $username);
            Yii::app()->user->setState('usertype', $userType);
        }
    }
    
    public function geUserImage($userId) {
        $userprofile = UserProfile::model()->find("user_id = $userId");
        $photo = $userprofile['image'];

        if ($userprofile['image'] == "") {
            $image = Yii::app()->baseUrl . '/images/user.png';
        } elseif ((strpos($photo, "h")) === 0) {
            $image = $userprofile['image'];
        } else {
            $image = Yii::app()->baseUrl."/uploads/user_".$userId."/".$photo;
        }
        return $image;
    }
    
    
    
    public function gePageImage($pageId,$userId) {
        $page = Pages::model()->find("id = $pageId");
        $photo = $page['image'];

        if ($page['image'] == "") {
            $image = Yii::app()->baseUrl . '/images/user.png';
        } elseif ((strpos($photo, "h")) === 0) {
            $image = $page['image'];
        } else {
            $image = Yii::app()->baseUrl."/uploads/business_page_".$userId."/".$photo;
        }
        return $image;
    }
    
    
    
    
    public function checsession() {
           
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $session = Yii::app()->session['isLoggedIn'];
            if(empty($session)){
                $this->redirect(Yii::app()->baseUrl.'/index.php');
            }
    }
    
}