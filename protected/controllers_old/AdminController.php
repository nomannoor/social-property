<?php

class AdminController extends Controller
{
	public function actionIndex()
	{
                $this->layout = 'layout_user';
                $model =new UserProfile('search');
                $users= UserProfile::model()->findAll();
                if(isset($_GET['UserProfile']))
                { $model->attributes =$_GET['UserProfile'];}
                
                $params =array(
                        'model'=>$model,
                        'user'=>$users,
                       
                );

                if(!isset($_GET['ajax'])) $this->render('index', $params);
                else  $this->renderPartial('index', $params);
            
            
            
            
            
                
		
	}
        function actionChangestatus($id){
                $user= User::model()->findByPk($id);
                
                
                
                if($user->is_active == 0){
                    $user->is_active= 1;
                    $user->save(false);
                    $this->redirect(array('admin/index'));
                }
                else{
                   $user->is_active=0;
                   $user->save(false);
                   $this->redirect(array('admin/index'));
                }
            
            
        }
        function actionDeleteuser($id){
           
            $user= User::model()->findByPk($id);
            $userProfile = UserProfile::model()->find('user_id=:id',array(':id'=>$id));
            $userProfile->delete();
            $user->delete();
            $this->redirect(array('admin/index'));
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