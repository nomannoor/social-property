<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BusinesspageController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }
    public function actionViewpage($id){
        $this->checsession();
        $this->layout = 'layout_profile';
         $posts = BusinessPagePost::model()->with('page')->findAll(array('select' => '*',
            'condition' => "page_id=$id",
            'order' => 'date DESC'
                ));
         
        
        $this->render('viewpage',array('id'=>$id,'posts'=>$posts));
    }
     public function actionupdatePost($message,$id) {
        $model = new BusinessPagePost;
        $model->user_id = Yii::app()->user->userId;
        $model->message = $message;
        $model->page_id = $id;
        $model->date = date('Y-m-d H:i:s');
        $model->save();
        //Yii::app()->user->setFlash('success', "Your status has been sent posted.");
        //$this->redirect(Yii::app()->baseUrl . '/index.php/user/dashboard');
        
        $Id = Yii::app()->db->getLastInsertId();
        
        $data= BusinessPagePost::model()->findByPk($Id);
           
              
        $user = UserProfile::model()->findByAttributes(array('user_id' => $data['user_id']));
         $array = array();
         $array2 = array();
         $array = $user['attributes'];
         $array2 = $data['attributes'];
         $result = array_merge($array,$array2);
         
        echo json_encode($result);
       
    }
    
    public function actionpostlike($postId) {
        $model = new LikeBusinessPost;
        $model->user_id = Yii::app()->user->userId;
        $model->post_id = $postId;
        $model->date = date('Y-m-d H:i:s');
        $model->save();
    }

    public function actionpostunlike($postId) {
        $model = LikeBusinessPost::model()->find('post_id=:post_id AND user_id=:user_id', array('post_id' => $postId, 'user_id' => Yii::app()->user->userId));
        $model->delete();
    }

    public function actionaddcomment($postId, $comment) {
        $model = new CommentBussinessPage;
        $model->user_id = Yii::app()->user->userId;
        $model->post_id = $postId;
        $model->date = date('Y-m-d H:i:s');
        $model->comment = $comment;
        $model->save();
    }

    public function actionpostshare($postId) {
        $model = Post::model()->find('id=:id', array('id' => $postId));
        $newPost = new Post;
        $newPost->user_id = Yii::app()->user->userId;
        $newPost->message = $model->message;
        $newPost->date = date('Y-m-d H:i:s');
        $newPost->save();
    }

    public function actionpostdelete($postId) {
        $model = BusinessPagePost::model()->find('id=:id', array('id' => $postId));
        $comments = CommentBussinessPage::model()->findAll('post_id=:id', array('id' => $postId));
        $likes = LikeBusinessPost::model()->findAll('post_id=:id', array('id' => $postId));
        foreach ($comments as $c) {
            $c->delete();
        }
        foreach ($likes as $l) {
            $l->delete();
        }
        $model->delete();
        echo "success";
    }
    
    public function actioncommentdelete($commentId) {
        //echo $commentId;
        $comment = CommentBussinessPage::model()->find('id=:id', array('id' => $commentId));
        $comment->delete();        
    }
    
    
    
    
    public function updatePhoto($model, $myfile ) {
	
           if (is_object($myfile) && get_class($myfile)==='CUploadedFile') {
	
                $ext = $model->image->getExtensionName();
	
 
	
		//generate a filename for the uploaded image based on a random number
	
		// but check that the random number has not already been used
	
                if ($model->image=='' or is_null($model->image)) {
	
                    $n=1;
	
                    // loop until random is unqiue - which it probably is first time!
	
                    while ($n>0) {
	
                        $rnd=dechex(rand()%999999999);
	
                        $filename=$model->property->ref . '_' . $rnd . '.' . $ext;
	
                        $n=  Pages::model()->count('image=:image',array('image'=>$image));
	
                    }
	
                $model->image=$image;
	
                }
	
 
	
                $model->save();
	
 
	
                $model->image->saveAs($model->getPath());  //model->getPath see below
	
 
	
                $image = Yii::app()->image->load($model->getPath());
	
		//Crunch the photo to a size set in my System Options Table	
		//I hold the max size as 800 meaning to fit in an 800px x 800px square	
                $size=$this->getOption('PhotoLarge');
	
                $image->resize($size[0], $size[0])->quality(75)->sharpen(20);
	
                $image->save(); 
	
 
	
		// Now create a thumb - again the thumb size is held in System Options Table
	
		$size=$this->getOption('PhotoThumb');
	
                $image->resize($size[0], $size[0])->quality(75)->sharpen(20);
	
                $image->save($model->getThumb()); // or $image->save('images/small.jpg');
	
                return true;
	
             } else return false;
	
        }
        public function actionShowAll(){
            
            $pages = Pages::model()->findAll('user_id=:id',array(':id'=>Yii::app()->user->userId));
            $this->render('allpages',array('pages'=>$pages));
            
        }
        
        

    public function actionCreatePage($id='') {
        
        if($id=='')
        {
            $model=new Pages;
        }
        else
        {
            $model=  Pages::model()->findByPk($id);
        }
        // display the login form
        //$this->layout = 'empty';
        
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'create_page') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        
                if(isset($_POST['Pages']))
	
		{ 
                    //$model->attributes=$_POST['Pages'];
                    $lat=$_POST['Pages']['latitude'];
                    $lon=$_POST['Pages']['longitude'];
                    
                    $model->company_name = $_POST['Pages']['company_name'];
                    $model->address = $_POST['Pages']['address'];
                    $model->domain = $_POST['Pages']['domain'];
                    $model->type = $_POST['Pages']['type'];
                    $model->description = $_POST['Pages']['description'];
                    $model->user_id = Yii::app()->user->userId;
                    $model->image = CUploadedFile::getInstance($model,'image');
                    $model->latitude=$lat;
                    $model->longitude=$lon;
                    
                if ($model->image) {
                $fileTempName = $model->image->tempName;
                $fileName = $model->image->name;
                
                
                
                $upload_dir = realpath(getcwd()) . '/uploads/business_page_' . Yii::app()->user->userId . '/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir);
                    
                }

                if (move_uploaded_file($fileTempName, "$upload_dir" . "$fileName")) {
//                    if ($Image) {
//                        unlink("$upload_dir" . "$Image");
//                    }
                }
            } else {
                $model->image = 'user.png';
            }
            //Image Upload End
            $model->save(false);
            $pageId = Yii::app()->db->getLastInsertID();
            Yii::app()->user->setFlash('success', "Your business page has been created successfully.");
            if(!$id)
            {   
            $this->redirect(Yii::app()->baseUrl . "/index.php/businesspage/viewpage/id/$pageId");
            }
            else{
                $this->redirect(Yii::app()->baseUrl . "/index.php/businesspage/viewpage/id/$id");
            }
                }
        
        $this->layout = 'layout_user';
        $this->render('create_page', array('model'=>$model));
    }
    
    public function actionBusinessPages()
    {
        
        $this->layout = 'layout_user';
        
        $this->render('business_pages');
    }
    
    public function actionViewSubPage($id)
    {
        
         $this->layout = 'layout_profile';
        $this->render('viewsubpage',array('id'=>$id));
    }
    
    public function actionFollowBusinessPage($id,$text){
        
        $userId=Yii::app()->user->userId;
        if($text=='follow')
        {
            $model= new UserpageFollow;
            $model->user_id=$userId;
            $model->business_page_id=$id;
            $model->save();
            echo "unfollow";
        }
        else
        {
            $model=UserpageFollow::model()->find('user_id=:userId AND business_page_id=:pageId',array(':userId'=>$userId,':pageId'=>$id));
            $model->delete();
            echo "follow";
        }    
        
    }
    public function actionDeleteBusinessPages()
    {
        
        $id=$_POST['id'];
        $model=Pages::model()->findByPk($id);
        $model->delete();
        echo "true";
    }

}
?>
