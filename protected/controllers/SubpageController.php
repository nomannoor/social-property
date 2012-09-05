<?php

class SubpageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        
          public function actionCreate($id='')
        {
            if($id=='')
            {
                $model=new SubPage;
            }
            else
            {
                $model=  SubPage::model()->findByPk($id);
            }
            $this->layout = 'layout_user';
            

            // uncomment the following code to enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='sub-page-create-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            

            if(isset($_POST['SubPage']))
            {
                $model->attributes=$_POST['SubPage'];
                if($model->validate())
                {
                    $model->save();
                    // form inputs are valid, do something here
                    //return;
                      Yii::app()->user->setFlash('success', "Your sub-page has been created successfully.");
            $this->redirect(Yii::app()->baseUrl . '/index.php/user/dashboard');
                }
            }
            $this->render('create',array('model'=>$model));
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