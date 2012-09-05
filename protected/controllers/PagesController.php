<?php

class PagesController extends Controller
{
    public $test;
    public $path; 
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionImage(){
            
            echo $this->test;
            
        }
    
        public function actionCreate()
        {
            //echo realpath(Yii::app()->baseUrl);            return;
            $model=new Pages;
            $this->layout= 'layout_user';
            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='pages-create-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */

            if(isset($_POST['Pages']))
            {
                $model->attributes=$_POST['Pages'];
                if($model->validate())
                {
                    $page = Pages::model()->find('id=:p_id',array(':p_id'=>Yii::app()->session['pageId']));
                      $page->company_name =$_POST['Pages']['company_name'];
                      $page->type =$_POST['Pages']['type'];
                      $page->address =$_POST['Pages']['address'];
                      $page->description =$_POST['Pages']['description'];
                      $page->save();
                    // form inputs are valid, do something here
                    return;
                }
            }
            $this->render('create',array('model'=>$model));
        }
        
        
            public function actionUpload()
    {
                //$path = Yii::app()->baseUrl."/uploads";
        
        $model = new XUploadForm;
        if (!isset($this->path))
        {
            $this->path = realpath(Yii::app()->basePath."/../uploads");
        }

        if (!is_dir($this->path))
        {
            throw new CHttpException(500, "{$this->path} does not exists.");
        }
        else if (!is_writable($this->path))
        {
            throw new CHttpException(500, "{$this->path} is not writable.");
        }

        if ($model->validate())
        {

            $model->file = CUploadedFile::getInstance($model, 'file');
            $model->mime_type = $model->file->getType();
            $model->size = $model->file->getSize();
            $model->name = $model->file->getName();
            $path = $this->path . "/" . Yii::app()->session['userId'];

            
            $model->file->saveAs($path.$model->name);
            $pageImage = new  Pages;
            $pageImage->user_id = Yii::app()->user->userId;
            $pageImage->image = $model->name;
            $pageImage->save();
            Yii::app()->session['pageId']=$pageImage->id;
            Yii::app()->session['imageName'] = $model->name;
            echo  json_encode(array("name" => $model->name,"type" => $model->mime_type,"size"=> $model->getReadableFileSize()));
/*            $user_id = Yii::app()->session['userId'];
            if ($model->file->getType() != 'image/jpeg' && $model->file->getType() !='image/png' && $model->file->getType() !='image/bmp' && $model->file->getType() != 'image/jpg')
            {
                echo "Invalid File Type, only jpg allowed";
            }
            else
            {
                $profile = UserProfile::model()->find('user_id=:id', array('id' => Yii::app()->session['userId']));
                $old_pic = $profile['photo'];
                if ((strpos($old_pic, "h")) === 0)
                {
                    $profile->photo = Yii::app()->session['userId'] . '_' . $model->name;
                    $profile->save();
                    $model->file->saveAs($path . '_' . $model->name);
                    //Yii::app()->user->setFlash('success', "Upload Picture Successfully");
                }
                elseif ((strpos($old_pic, $profile['user_id'])) === 0)
                {
                    unlink(realpath(Yii::app()->getBasePath() . "/../images/uploads") . "/" . urldecode($old_pic));
                    $profile->photo = Yii::app()->session['userId'] . '_' . $model->name;
                    $profile->save();
                    $model->file->saveAs($path . '_' . $model->name);
                    //Yii::app()->user->setFlash('success', "Upload Picture Successfully");
                }
                else
                {
                    //unlink(realpath(Yii::app()->getBasePath()."/../images/uploads")."/".urldecode($old_pic));
                    //$profile->photo = Yii::app()->session['userId'] . '_' . $model->name;
                    //$profile->save();
                    //$model->file->saveAs($path . '_' . $model->name);
                    //Yii::app()->user->setFlash('success', "Upload Picture Successfully");
                }
                echo json_encode(array("name" => $model->name,"type" => $model->mime_type,"size"=> $model->getReadableFileSize()));
                //echo "hogya hai ";
                //$this->redirect(Yii::app()->baseUrl.'/index.php/user/userprofile/'.$user_id);
                //echo '<script type="text/javascript">window.top.href = "' . Yii::app()->baseUrl . '/index.php/user/userprofile/' . $user_id . '"; </script>';
            }
        }
        else
        {
            /*echo CVarDumper::dumpAsString($model->getErrors());
              Yii::log("XUploadAction: ".CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "application.extensions.xupload.actions.XUploadAction");
              throw new CHttpException(500, "Could not upload file"); */
            //echo $this->redirect(Yii::app()->baseUrl);
            //echo "<script type='text/javascript'>alert('chage');</script>";
        }
        
      /*  $model=new Image;
        if(isset($_POST['Image']))
        {
            $model->attributes=$_POST['Image'];
            $model->image=CUploadedFile::getInstance($model,'image');
            
            $fileTempName=$model->thumbnail->tempName;
            $fileName=$model->thumbnail->name;
            
            if($model->save())
            {
                $userId=Yii::app()->session['userId'];
                $upload_dir=realpath(getcwd()).'/images/uploads/';                 
                move_uploaded_file($fileTempName, "$upload_dir/$userId".'_'."$fileName");
                // $model->image->saveAs('path/to/localFile');
                // redirect to success page
                return;
            }
            return;
        }*/
        //$this->render('create', array('model'=>$model));
        
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