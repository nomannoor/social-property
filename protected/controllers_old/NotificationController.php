<?php

class NotificationController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        
        public function actionViewnotification(){
             $this->layout = 'layout_user';
            $notification = Notification::model()->findAll('user_id=:uid',array(':uid'=>Yii::app()->user->userId));
            
            foreach($notification as $n):
                
                $n->is_read = 1;
                $n->save();
            endforeach;
            $this->render('shownotification',array('notification'=>$notification));
        }
        public function actionGetcount(){
             // un-read notification count
        $type = 'friend';
        $notification_count=array();
        $notification = Notification::model()->findAll("user_id=:uid AND is_read = 0 AND type != '$type'",array(':uid'=>Yii::app()->user->userId));
        $message = Messages::model()->findAll('user_id=:uid AND is_read=0',array(':uid'=>Yii::app()->user->userId));
        $friend = UserFriend::model()->findAll('friend_id=:uid AND is_read=0',array(':uid'=>Yii::app()->user->userId));
        $notification_count['noti'] = count($notification);
        $notification_count['mess']  = count($message);
        $notification_count['friend']  = count($friend);
        print_r(json_encode($notification_count));
        }
        public function actionFriendnotification(){
            $this->layout = 'layout_user';
            $type = 'friend';
            $notification = Notification::model()->findAll("user_id=:uid AND type = '$type'" ,array(':uid'=>Yii::app()->user->userId));
           foreach($notification as $n):
                
                $n->is_read = 1;
                $n->save();
            endforeach;
            $friend = UserFriend::model()->findAll('friend_id=:uid AND is_read=0',array(':uid'=>Yii::app()->user->userId));
            foreach($friend as $n):
                
                $n->is_read = 1;
                $n->save();
            endforeach;
            $this->render('shownotification',array('notification'=>$notification)); 
        }

        // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}