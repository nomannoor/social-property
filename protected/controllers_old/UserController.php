<?php

class UserController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }
    public function actionIndexLocation()
    {
        $model=  Pages::model()->findAll();
        $i=0;
        $result=array();
        foreach($model as $m):
            $result[$i]['lat']=$m['latitude'];
            $result[$i]['lon']=$m['longitude'];
            $i++;
        endforeach;
        echo json_encode($result);
    }
    public function actionFinduser(){
        $result = array();
        $result1 = array();
        $data = $_POST['searchword'];
        $user = UserProfile::model()->findAll(
                'first_name LIKE :name',
                array(':name' => "%$data%")
                
            );
        $page = Pages::model()->findAll(
                'company_name LIKE :name',
                array(':name' => "%$data%")
                
            );
        $result = array_merge($user,$page);
        shuffle($result);
       
//       foreach($result as $r):
//           print_r($r['attributes']);
//       endforeach;
//       return;
      foreach($result as $u):
       $html =  '<div class="display_box" align="left" style="position:relative; z-index:3;">';
          if(isset($u['first_name'])){
              $id = $u['user_id'];
              $img  = $u['image'];
              
            $html.= '<a  href = "'.Yii::app()->baseUrl.'/index.php/user/viewprofile/userId/'.$id.'"><img src="'.Yii::app()->baseUrl.'/uploads/user_'.$id.'/'.$img.'"style=float:left; margin-right:6px; width=40 height = 40 />&nbsp&nbsp<span style = "font-size:15px">'.$u['first_name'].'&nbsp;'.$u['last_name'].'<br/>';    
            $html.='&nbsp;<span style="font-size:9px; color:#999999">'."USER".'</span></div></a><br/>';
            echo $html;
          }
          elseif(isset($u['company_name'])){
              $id = $u['user_id'];
              $img  = $u['image'];
              
              $html.= '<a href = "'.Yii::app()->baseUrl.'/index.php/businesspage/viewpage/'.$u->id.'"><img src="'.Yii::app()->baseUrl.'/uploads/business_page_'.$id.'/'.$img.'"style="float:left; margin-right:6px" width="40px"; height ="40px"; />&nbsp<span style = "font-size:15px">'.$u['company_name'].'&nbsp;</span>('.$u['domain'].')<br/>';    
              $html.='<span style="font-size:9px; color:#999999">'."PAGE".'</span></div><br/>';
              echo $html;
          }
          
    endforeach;
    }
    

    public function actionNewPost() {
        
        $this->layout='empty';
        $this->render('newpost');
    }
    public function actionSearctag($searchword)
    {
       
        $q=str_replace("@","",$searchword);
        
        //when query only for frnd
        //$result=UserFriend::model()->with('user')->findAll('user_id=:userId AND status=1',array(':userId'=>Yii::app()->user->userId));
        //query for All User
        
        $result=User::model()->with('userProfile')->findAll('first_name LIKE :name AND user_type !=:userType',array(':name'=>"%$q%",'userType'=>3));
        
        foreach($result as $r):
            
            $Ufrnd=UserFriend::model()->find('(user_id=:userId AND friend_id=:frndId) OR (user_id=:frndId AND friend_id=:userId)',array(':userId'=>Yii::app()->user->userId,':frndId'=>$r->id));
            if(!empty($Ufrnd)){
                $image=$r['userProfile']['image'];
                $name=$r['userProfile']['first_name'].' '.$r['userProfile']['last_name'];
                echo "<div class='display_box' align='left'><img src='".Yii::app()->baseUrl.'/uploads/user_'.$r->id.'/'.$image."' class='image'/><a style='font-weight:bold' href='javascript:void(o)' class='addname' name='".$r->id."' title='".$name."'>".$name."</a></div>";
            }
            else
            {
                echo "<div class='display_box' align='center' style='font-weight:bold'>No Suggestion</div>";
            }    
        endforeach;
        
    }
    public function actionNewPic() {
        
        
        
       $path = realpath(getcwd()) . '/uploads/';

 $valid_formats = array("jpg", "png", "gif", "bmp","jpeg",'mp4');
 if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
  {
   $name = $_FILES['photoimg']['name'];
   $size = $_FILES['photoimg']['size'];
                        $tag=$_POST['tag'];
                        $tagging=explode(',',$tag);
                        if($name!='')
    {
     $name= explode(".", $name);
     if(in_array($name[1],$valid_formats))
     {
     if($size<(1024*1024*1024))
      {
       
       $tmp = $_FILES['photoimg']['tmp_name'];
       
                                                                    
                                                                    foreach($tagging as $t):
                                                                           if($t==Yii::app()->user->userId)
                                                                           {
                                                                                $model = new Post;
                                                                                $model->user_id = Yii::app()->user->userId;
                                                                                $model->message = $_POST['image_message'];;
                                                                                $model->date = date('Y-m-d H:i(worry)');
                                                                                $model->image = $name[0].'.'.$name[1];
                                                                                $model->save(false);
                                                                                $Id = Yii::app()->db->getLastInsertId();
                                                                           }


                                                                           $pt=new PostTagging;
                                                                           $pt->user_id=$t;
                                                                           $pt->sender_id=Yii::app()->user->userId;
                                                                           $pt->post_id=$Id;
                                                                           $pt->save();

                                                                        endforeach;
                                                                    move_uploaded_file($tmp, $path.$Id.'_'.$name[0].'.'.$name[1]);
                                                                    $Newpost=Post::model()->findByPk($Id);
                                                                    $user = UserProfile::model()->findByAttributes(array('user_id' => $Newpost->user_id));
                                                                    $table = '<table id ="row_'.$Newpost['id'].'" '; 
                                                                   $table.='class="well-for-table">';
                                                                    $table .= '<tr>';
                                                                    $table .='<td><img width="50" height="50" src="'.Yii::app()->baseUrl.'/uploads/user_'.$user->user_id.'/'.$user->image.'" /></td>';
                                                                    $table .= '<td>&nbsp;&nbsp;&nbsp</td>';
                                                                    $table .= '<td style="width:100%">';
                                                                    $table .= '<p><b><a href="'.Yii::app()->baseUrl.'/index.php/user/viewprofile/userId/'.$user->id.'">'.$user->first_name." ".$user->last_name.'</a></b><span style="float:right; font-size: 10px;margin-right:3px;"></span><br />';
                                                                    $table .= $Newpost['message'].'<br/>';
                                                                    if($name[1]=='mp4')
                                                                    {                                                                        
                                                                        
                                                                       $table.="<div id='mediaplayer_".$Id."'></div><script type='text/javascript'>jwplayer('mediaplayer_".$Id."').setup({'flashplayer': '".Yii::app()->baseUrl."/js/jwplayer/player.swf','skin':'".Yii::app()->baseUrl."/js/jwplayer/bekle.zip','id': 'playerID','width': '400','height': '300','file': '".Yii::app()->baseUrl."/uploads/".$Id."_".$name[0].".".$name[1]."', 'controlbar.position':'over'});</script>";
                                                                    }
                                                                    else
                                                                    {
                                                                        $table .= '<img style="height:150px;width:150px" src="'.Yii::app()->baseUrl.'/uploads/'.$Id.'_'.$name[0].'.'.$name[1].'"';
                                                                    }    
                                                                    
                                                                    $table .='</td>';
                                                                    $table .='</tr>';
                                                                    $table .= '<tr><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>';
                                                                    $table .='<span id = "like_'.$Newpost['id'].'"><i class="icon-eye-open"></i><a href="javascript:void(o)" onclick="postrecentLike('.$Newpost['id'].')">LIKE</a></i></span>';
                                                                    $table .='&nbsp;&nbsp;<span id="comment_'.$Newpost['id'].'"><i class="icon-comment"></i><a href="javascript:void(o)" onclick="showCMBox('.$Newpost['id'].')">COMMENT</a></i></span>&nbsp;&nbsp;<i class="icon-share"></i>';
                                                                    $table .= '<a href="javascript:void(o)" onclick="postShare('.$Newpost['id'].')">SHARE</a>&nbsp;&nbsp;<i class="icon-eye-open"></i><a href="#">WATCH</a>&nbsp;&nbsp';
                                                                    $table .='<span id = "del_'.$Newpost['id'].'"><i class="icon-eye-open"></i><a href="javascript:void(o)" onclick="deletePost('.$Newpost['id'].')">DELETE</a></span></td></tr>';
                                                                    echo $table;
          
        
       
      }
      else
      echo "Image file size max 1 MB";     
      }
      else
      echo "Invalid file format.."; 
    }
    
   else
    echo "Please select image..!";
    
   exit;
  }
    }
    
    public function actionLogin() {
        $model = new LoginForm;
        if(isset($_POST['login']) || isset($_POST['LoginForm'])){
       if(isset($_POST['login'])){
       $username = $_POST['username'];
       $password = $_POST['password'];
       
       
       $att = array();
       $attr['username']= $username;
       $attr['password'] = $password;
       $model->attributes = $attr;
      }
      else{
            $model->attributes = $_POST['LoginForm'];
      }
        if($model->validate() && $model->login()){
           if(Yii::app()->user->usertype==3){
               $this->redirect(Yii::app()->baseUrl.'/index.php/admin');
           }
           
            $this->redirect(Yii::app()->baseUrl.'/index.php');
        }
        else{
            $this->render('login', array('model' => $model));
        }
        }
        
        /*
        $model = new LoginForm;
        
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                if( Yii::app()->user->usertype!=3){
            //if (Yii::app()->user->usertype==1)
            //{
            //$this->redirect(Yii::app()->baseUrl.'/index.php/tester');
            //                          echo '<script type="text/javascript">window.top.location.href = "' . Yii::app()->baseUrl . '/index.php/user/dashboard"; </script>';   
            //}
            //else
            //{
            //$this->redirect(Yii::app()->baseUrl.'/index.php/company');
            //                      echo '<script type="text/javascript">window.top.location.href = "' . Yii::app()->baseUrl . '/index.php/company"; </script>';
            //}
            //$this->redirect(Yii::app()->baseUrl.'/index.php/dashboard');
                echo '<script type="text/javascript">window.top.location.href = "' . Yii::app()->baseUrl . '/index.php/user/dashboard"; </script>';
                }
                else{
                        echo '<script type="text/javascript">window.top.location.href = "' . Yii::app()->baseUrl . '/index.php/admin"; </script>';
                }
        }
        // display the login form
        $this->layout = 'empty';
        $this->render('login', array('model' => $model));*/
    }

    public function actionDashboard() {
        $this->setSession();  
        $posts = array();
        $allposts = array();
        $i = 0;
        //$posts = Post::model()->findAll(array('select' => '*','condition' => 'user_id=:userId','params' => array(':userId' => Yii::app()->user->userId),'order'=>'date DESC'));
        $friends = UserFriend::model()->findAll('user_id=:uid',array(':uid'=>Yii::app()->user->userId));
        if(empty($friends)){
        $post = Post::model()->findAll(array('select' => '*','condition' => 'user_id=:userId','params' => array(':userId' => Yii::app()->user->userId),'order'=>'date DESC'));
        
        }
        else{
        $post = Post::model()->findAll(array('select' => '*','condition' => 'user_id=:userId','params' => array(':userId' => Yii::app()->user->userId),'order'=>'date DESC')); 
        
        }
       // $posts = Post::model()->findAll(array('select' => '*','order'=>'date DESC'));
        
        //$pages = Pages::model()->findAll('user_id=:userId',array(':userId'=>Yii::app()->user->userId));
        $pages = BusinessPagePost::model()->with('page','user')->findAll('t.user_id=:userId',array(':userId'=>Yii::app()->user->userId));
        $result=array_merge($post,$pages);
        
        
         //return;
        //shuffle($result);
        /*
        foreach($result as $r):
         
          if(isset($r['page_id']))
          {
              echo 'company message    '.$r->user->userProfile->first_name.'<br/>';
          }
          else
          {
              echo 'post message    '.$r->message.'<br/>';
          }
         
        endforeach;
        */
        $this->layout = 'layout_user';
        $this->render('dashboard', array('posts' => $result));
    }
    
    
    public function actionSearch($term)
    {
        if(Yii::app()->request->isAjaxRequest && !empty($term))
        {
              $variants = array();
              //$criteria = new CDbCriteria;
              //$criteria->select='display_name';
              //$criteria->addSearchCondition('display_name',$term.'%',false);
              $q = new CDbCriteria( array(
                'condition' => "username LIKE :name",         // no quotes around :match
                'params'    => array(':name' => "%$term%")  // Aha! Wildcards go here
            ) );
              $tags = User::model()->findAll($q);
              if(!empty($tags))
              {
                foreach($tags as $tag)
                {
                    
                    $variants[] = $tag->attributes['username'].'('.$tag->attributes['email'].')';                                          
                    
                }
              }
              
              echo CJSON::encode($variants);
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    public function actionInbux(){
        $this->layout = "layout_user";
        $criteria=new CDbCriteria;
        $criteria->condition='user_id=:id OR sender_id=:id';
        $criteria->params=array(
            ':id'=>Yii::app()->user->userId,
            
        );
       $criteria->order='t.date DESC';
        $criteria->with=array(
            'user',
            'sender'
        );
        $messages = Messages::model()->findAll($criteria);
        //$messages2 = MessageChat::model()->with('user','sender','message')->findAll('t.message_id=:messgId',array(':messgId'=>$messageId,'order'=>'t.date DESC'));
        
        //$messages = Messages::model()->with('user')->findAll('t.user_id=:id',array(':id'=>Yii::app()->user->userId),array('order'=>'id DESC'));
//        foreach($messages as $m):
//            echo $m['user']['userProfile']['first_name'];
//        endforeach;
        //return;
       $this->render('viewmessages',array('messages'=>$messages)); 
    }
    public function actionSendMessages(){
        $this->layout = "layout_user";
        $criteria=new CDbCriteria;
        $criteria->condition='sender_id=:id';
        $criteria->params=array(
            ':id'=>Yii::app()->user->userId,
            
        );
       $criteria->order='t.id DESC';
        $criteria->with=array(
            'user'
        );
        $messages = Messages::model()->findAll($criteria);
        
        //$messages = Messages::model()->with('user')->findAll('t.user_id=:id',array(':id'=>Yii::app()->user->userId),array('order'=>'id DESC'));
//        foreach($messages as $m):
//            echo $m['user']['userProfile']['first_name'];
//        endforeach;
        //return;
       $this->render('sendmessages',array('messages'=>$messages)); 
    }
    public function actionDeleteMessage($messageId){
        $chatMess=MessageChat::model()->findAll('message_id=:messId',array(':messId'=>$messageId));
        if($chatMess)
        {
            foreach($chatMess as $ch):
                $ch->delete();
            endforeach;
        }
        $deleteMessage = Messages::model()->find('id=:messId',array(':messId'=>$messageId));
        $deleteMessage->delete();
        return;
    }

    public function actionSignup() {
        $model = new User;

        //uncomment the following code to enable ajax-based validation
                    if(isset($_POST['ajax']) && $_POST['ajax']==='user-signup-form')
                    {
                        echo CActiveForm::validate($model);
                        Yii::app()->end();
                    }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            //print_r($model->attributes); return;
            if ($model->validate()) {
                $model->password = md5($_POST['User']['password']);
                $model->is_active = 1;
                if ($model->save()) {
                    $userId = Yii::app()->db->getLastInsertID();
                    $userprofile = new UserProfile;
                    $userprofile->user_id = $userId;
                    $userprofile->join_date = date('Y-m-d');
                    $userprofile->save(false);
                    /*$email = Yii::app()->email;
                    $email->from = 'admin@social-property.com';
                    $email->to = $model->email;
                    $email->subject = "Welcome";
                    $email->message = "Welcome in Social Property";
                    $email->send();*/
                    
                    echo '<script type="text/javascript">window.top.location.href = "' . Yii::app()->baseUrl . '"; </script>';
                }
            }
        }
        $this->layout = 'empty';
        $this->render('signup', array('model' => $model));
    }

    

//        public function actionSignup() {
//                $model = new User;
//
//                if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-signup-form') {
//                    echo CActiveForm::validate($model);
//                    Yii::app()->end();
//                }
//
//                // collect user input data
//                if (isset($_POST['User'])) {
//                    $model->attributes = $_POST['User'];                    
//                    if ($model->validate()) {
//                        
//                        
//                        $pass = md5($_POST['User']['password']); 
//                        $model->password = $pass;
//                        $model->save();
//                        
//                        if ($model->save()){                            
//                            $user_id = Yii::app()->db->getLastInsertID();
//                            $model1 = new TesterProfile;
//                            $model1->user_id = $user_id;
//                            $model1->join_date = date('Y-m-d');
//                            $model1->save();
//                        }
//                        $this->redirect(Yii::app()->baseUrl);
//                    }
//                }
//                $this->layout = 'empty';
//                $this->render('signup', array('model' => $model));
//
//
//        }
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        Yii::app()->session['isLoggedIn'] = NULL;
        Yii::app()->session['latitude'] = NULL;
        Yii::app()->session['longitude'] = NULL;
        $this->redirect(Yii::app()->homeUrl);
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

    public function actionProfile() {
        $userId = Yii::app()->user->userId;
        $user = UserProfile::model()->findByAttributes(array('user_id' => $userId));
        $userImage = $user->image;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'project-projects-form') {
            echo CActiveForm::validate($user);
            Yii::app()->end();
        }
        if (isset($_POST['UserProfile'])) {
            $user = UserProfile::model()->findByAttributes(array('user_id' => $userId));
            $user->attributes = $_POST['UserProfile'];
            $user->first_name = $_POST['UserProfile']['first_name'];
            $user->last_name = $_POST['UserProfile']['last_name'];
            $user->contact_number = $_POST['UserProfile']['contact_number'];
            $user->city = $_POST['UserProfile']['city'];
            $user->country_id = $_POST['UserProfile']['country_id'];
            $user->dob = $_POST['UserProfile']['dob'];
            $user->state = $_POST['UserProfile']['state'];
            $user->gender = $_POST['UserProfile']['gender'];
            $user->address = $_POST['UserProfile']['address'];
            //Image Upload
            $user->image = CUploadedFile::getInstance($user, 'image');
            if ($user->image) {
                $fileTempName = $user->image->tempName;
                $fileName = $user->image->name;
                
                $upload_dir = realpath(getcwd()) . '/uploads/user_' . $userId . '/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir);
                }

                if (move_uploaded_file($fileTempName, "$upload_dir" . "$fileName")) {
                    if ($userImage) {
                        unlink("$upload_dir" . "$userImage");
                    }
                }
            } 
            else {
                $user->image = $userImage;
            }
            //Image Upload End
            $user->save();
            Yii::app()->user->setFlash('success', "Your profile information has been updated.");
            $this->redirect(Yii::app()->baseUrl . '/index.php/user/profile');
        }
        $this->layout = 'layout_user';
        $this->render('editprofile', array('model' => $user));
    }

    public function actionChangePassword() {
        $this->layout = 'empty';
        $model = new ChangePassword;

        // uncomment the following code to enable ajax-based validation
        /*
          if(isset($_POST['ajax']) && $_POST['ajax']==='change-password-changePassword-form')
          {
          echo CActiveForm::validate($model);
          Yii::app()->end();
          }
         */

        if (isset($_POST['ChangePassword'])) {
            $model->attributes = $_POST['ChangePassword'];
            //if($model->validate())
            //{


            $user = User::model()->find('id=:userId', array(':userId' => Yii::app()->user->userId));
            $password = $user->password;
            $enteredPassword = $_POST['ChangePassword']['password'];
            if ($enteredPassword == $model->password) {
                $user->password = md5($_POST['ChangePassword']['conformPassword']);
                $user->save();
                Yii::app()->user->setFlash('success', "Your password has been updated.");
                //$this->redirect(Yii::app()->baseUrl . '/index.php/user/dashboard');
                echo '<script type="text/javascript">window.top.location.href = "' . Yii::app()->baseUrl . '/index.php/user/settings"; </script>';
            }
            // form inputs are valid, do something here
            return;
            //}
        }
        $this->render('changePassword', array('model' => $model));
    }

    public function actionSettings() {
        $this->layout = "layout_user";
        $this->render('settings');
    }

    public function actionChangeemail() {
        $this->layout = 'empty';
        $model = new ChangeEmail;

        // uncomment the following code to enable ajax-based validation

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'change-email-changeemail-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        if (isset($_POST['ChangeEmail'])) {
            $model->attributes = $_POST['ChangeEmail'];
            if ($model->validate()) {
                $newEmail = $_POST['ChangeEmail']['email'];
                $user = User::model()->find('id=:userId', array(':userId' => Yii::app()->user->userId));
                $user->email = $newEmail;
                $user->save();
                Yii::app()->user->setFlash('success', "Your Email has been updated.");
                //$this->redirect(Yii::app()->baseUrl . '/index.php/user/dashboard');
                echo '<script type="text/javascript">window.top.location.href = "' . Yii::app()->baseUrl . '/index.php/user/settings"; </script>';
                
            }
        }
        $this->render('changeemail', array('model' => $model));
    }

   public function actionViewProfile($userId) {
        $this->layout = "layout_profile";
        
        $user = UserProfile::model()->find('user_id=:userId', array(':userId' => $userId));
        $country = Country::model()->find('id=:cId', array(':cId' => $user->country_id));
        $gender = Gender::model()->find('id=:gId', array(':gId' => $user->gender));
        $userFriend = UserFriend::model()->find('user_id=:userId AND friend_id=:friendId AND status=:status', array(':userId' => Yii::app()->user->userId, ':friendId' => $user->user_id, ':status' => 0));
        $userFriend2 = UserFriend::model()->find('user_id=:userId AND friend_id=:friendId AND status=:status', array(':userId' => $user->user_id, ':friendId' => Yii::app()->user->userId, ':status' => 0));
        $isFriend = UserFriend::model()->find('user_id=:userId AND friend_id=:friendId AND status=:status', array(':userId' => Yii::app()->user->userId, ':friendId' => $user->user_id, ':status' => 1));
        $isFriend2 = UserFriend::model()->find('user_id=:userId AND friend_id=:friendId AND status=:status', array(':userId' => $user->user_id, ':friendId' => Yii::app()->user->userId, ':status' => 1));
        //$posts = Post::model()->findAll(array('select' => '*','condition' => 'user_id=:userId','params' => array(':userId' => $userId),'order'=>'date DESC'));
        //$posts = PostTagging::model()->with('post')->findAll(array('select' => '*','distinct'=>true,'condition' => 't.user_id=:userId OR t.sender_id=:userId','params' => array(':userId' => $userId),'order'=>'post.date DESC'));
        $posts=PostTagging::model()->findAllBySql("SELECT DISTINCT( post_id ) AS post_id FROM post_tagging,posts WHERE post_tagging.user_id=$userId OR post_tagging.sender_id=$userId ORDER By post_tagging.id DESC");
        if(!empty($posts)){
        foreach($posts as $p):
            
            $post[] = Post::model()->find(array('select' => '*','condition' => 'id=:postId','params' => array(':postId' => $p->post_id),'order'=>'date DESC'));
        endforeach;
        }
        else
        {
            $post=Null;
        }
        
        $CheckuserFriend = UserFriend::model()->find('(user_id=:userId AND friend_id=:friendId) OR (user_id=:friendId AND friend_id=:userId) AND status=1', array(':userId' => Yii::app()->user->userId, ':friendId' => $userId));
        
        $this->render('viewprofile', array('posts' => $post, 'model' => $user, 'country' => $country, 'gender' => $gender, 'userFriend' => $userFriend, 'userFriend2' => $userFriend2, 'isFriend' => $isFriend, 'isFriend2' => $isFriend2,'checkFriend'=>$CheckuserFriend));
    }

    public function actionaddFriend($userId) {
        $friends = new UserFriend;
        $friends->user_id = Yii::app()->user->userId;
        $friends->friend_id = $userId;
        $friends->status = 0;
        $friends->save();
        $name = UserProfile::model()->find('user_id=:uid',array(':uid'=>Yii::app()->user->userId));
        $link = Yii::app()->baseUrl."/index.php/user/confirmfriend/userId/".Yii::app()->user->userId."/senderId/".$userId;
        $link1 = Yii::app()->baseUrl."/index.php/user/viewprofile/userId/".Yii::app()->user->userId;
        $message = $name['first_name']. " " .$name['last_name']." want to become a friend "."<span><a href ='$link1'>View user</a></span>&nbsp&nbsp<span><a href ='$link'>Accept</a></span>";
        $date = date('Y-m-d H:i:s');
        $this->notification(Yii::app()->user->userId,$userId,$message,$date,'friend');
    }
    

    public function actionConfirmfriend($userId,$senderId) {
        $friends = UserFriend::model()->find('user_id=:uid And friend_id=:fid', array(':uid' =>$userId,':fid'=>$senderId));
        $friends->status = 1;
        $friends->save();
        $name = UserProfile::model()->find('user_id=:uid',array(':uid'=>$senderId));
        $message = $name['first_name']. " " .$name['last_name']." Accept you friend request!";
        $date = date('Y-m-d H:i:s');
        $this->notification(Yii::app()->user->userId,$userId,$message,$date,'friend_accept');
        
        Yii::app()->user->setFlash('success', "Your request has been accepted.");
         $this->redirect(array('user/dashboard'));
    }
    public function actionconfirmFriend1($requestId) {
        $friends = UserFriend::model()->find('id=:id', array(':id' => $requestId));
        $friends->status = 1;
        $friends->save();
    }

    public function actionrejectFriend($requestId) {
        $friends = UserFriend::model()->find('id=:id', array(':id' => $requestId));
        $friends->delete();
    }

    public function actionMessages($userId) {
        $this->layout = 'empty';
        $model = new Messages;

        // uncomment the following code to enable ajax-based validation

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'messages-messages-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        if (isset($_POST['Messages'])) {
            $model->attributes = $_POST['Messages'];
            if ($model->validate()) {
                $model->sender_id = Yii::app()->user->userId;
                $model->user_id = $userId;
                $model->subject = $_POST['Messages']['subject'];
                $model->message = $_POST['Messages']['message'];
                $model->save();
                Yii::app()->user->setFlash('success', "Your message has been sent.");

                echo '<script type="text/javascript">window.top.location.href = "' . Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/' . $userId . '"; </script>';
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('messages', array('model' => $model));
    }
    
    public function actionNewmessages() {
        $this->layout = 'empty';
        $model = new Messages;

        // uncomment the following code to enable ajax-based validation

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'messages-messages-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        if (isset($_POST['Messages'])) {
            
            $usersId=$_POST['Messages']['user_id'];
            
            
             
               $usersId = explode(',',$usersId);      
            
           
            
            
            
           // if ($model->validate()) {
               
                foreach($usersId as $i):
                    $u = explode('(',$i);
                    if ($u[0] != " "){
                        $u = explode('(',$i);
                        $u1 = explode(')',$u[1]);
                       
                        $userTo=User::model()->find('email=:eId',array(':eId'=>$u1[0]));
                        if($userTo){
                            $newModel=new Messages;
                            $newModel->sender_id = Yii::app()->user->userId;
                            $newModel->user_id = $userTo['id'];
                            $newModel->subject = $_POST['Messages']['subject'];
                            $newModel->message = $_POST['Messages']['message'];
                            $newModel->is_read=0;
                            $newModel->save();
                            $Id = Yii::app()->db->getLastInsertId();
                            $chat=new MessageChat;
                            $chat->message_id=$Id;
                            $chat->user_id=$userTo['id'];
                            $chat->sender_id = Yii::app()->user->userId;
                            $chat->message = $_POST['Messages']['message'];
                            
                            $chat->save();
                        }
                    }
                endforeach;
                
                Yii::app()->user->setFlash('success', "Your message has been sent.");

               // echo '<script type="text/javascript">window.top.location.href = "' . Yii::app()->baseUrl . '/index.php/user/inbux"; </script>';
            $this->redirect(Yii::app()->baseUrl . '/index.php/user/inbux');
        }
        $this->render('newmessage', array('model' => $model));
    }
    
    public function actionCheckUsernames($users){
        
            $data=0;
            
             $user = explode(',',$users); 
            
            foreach($user as $i):
                if($i!='')
                {
                    if (preg_match ('/[(]/i', $i)) {
                       $data=0;
                      
                    }
                    else
                    {
                      $data=1;
                       break;
                    }
                    
                   
                    
                }
              endforeach;  
              echo $data;
    }
    public function actionupdatePost() {
        
        $message=$_POST['message'];
        $tag=$_POST['tag'];
        
        if(!empty($tag))
        {
            $tagging=explode(',',$tag);
            foreach($tagging as $t):
               if($t==Yii::app()->user->userId)
               {
                    $model = new Post;
                    $model->user_id = Yii::app()->user->userId;
                    //$model->sender_id = Yii::app()->user->userId;
                    $model->message = $message;
                    $model->date = date('Y-m-d H:i:s');
                    $model->save();
                    $Id = Yii::app()->db->getLastInsertId();
               }
               
               
               $pt=new PostTagging;
               $pt->user_id=$t;
               $pt->sender_id=Yii::app()->user->userId;
               $pt->post_id=$Id;
               $pt->save();
                
            endforeach;
            
        }
        
        //Yii::app()->user->setFlash('success', "Your status has been sent posted.");
        //$this->redirect(Yii::app()->baseUrl . '/index.php/user/dashboard');
        
        
        
        $data= Post::model()->findByPk($Id);
           
              
        $user = UserProfile::model()->find('user_id=:userId',array('userId' => $data['user_id']));
         $array = array();
         
         $array['user'] = $user['attributes'];
         $array['post'] = $data['attributes'];

         
        echo json_encode($array);
       
    }
    
    public function actionFindalluser(){
        
        $model = User::model()->findAll();
            
    
        
    }
    public function actionpostlike($postId,$text) {
        if($text=='post')
        {
            $model = new LikePost;
            $model->user_id = Yii::app()->user->userId;
            $model->post_id = $postId;
            $model->date = date('Y-m-d H:i:s');
            $model->save();
             
        $name = UserProfile::model()->find('user_id=:uid',array(':uid'=>Yii::app()->user->userId));
        $post = Post::model()->findByPk($postId);
        $message = $name['first_name']. " " .$name['last_name']." Like your post "."<span>".$post->message."</span>";
        $date = date('Y-m-d H:i:s');
        if(Yii::app()->user->userId!=$post->user_id){
        $this->notification($post->user_id, Yii::app()->user->userId,$message,$date,'like');
        }
            
            
            
            $likes = LikePost::model()->find('post_id=:post_id',array('post_id' =>$postId));
            echo count($likes);
        }
        elseif($text=='page')
        {
            $model=new LikeBusinessPost;
            $model->user_id = Yii::app()->user->userId;
            $model->post_id = $postId;
            $model->date = date('Y-m-d H:i:s');
            $model->save();
        }
        
    }

    public function actionpostunlike($postId,$text) {
        if($text=='post')
        {
            $model = LikePost::model()->find('post_id=:post_id AND user_id=:user_id', array('post_id' => $postId, 'user_id' => Yii::app()->user->userId));
            $model->delete();
        }   
        elseif($text=='page')
        {
            $model = LikeBusinessPost::model()->find('post_id=:post_id AND user_id=:user_id', array('post_id' => $postId, 'user_id' => Yii::app()->user->userId));
            $model->delete();
        }
    }

    public function actionaddcomment($postId, $comment,$text) {
        if($text=='post')
        {
                $model = new CommentPost;
                $model->user_id = Yii::app()->user->userId;
                $model->post_id = $postId;
                $model->date = date('Y-m-d H:i:s');
                $model->comment = $comment;
                $model->save();
        }
        else if($text=='page')
        {
            $model=new CommentBussinessPage;
            $model->user_id = Yii::app()->user->userId;
            $model->post_id = $postId;
            $model->date = date('Y-m-d H:i:s');
            $model->comment = $comment;
            $model->save();
        }
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
        $model = Post::model()->find('id=:id', array('id' => $postId));
        $comments = CommentPost::model()->findAll('post_id=:id', array('id' => $postId));
        $likes = LikePost::model()->findAll('post_id=:id', array('id' => $postId));
        foreach ($comments as $c) {
            $c->delete();
        }
        foreach ($likes as $l) {
            $l->delete();
        }
        $model->delete();
        echo "success";
    }
    
    public function actioncommentdelete($commentId,$text) {
       if($text=='post')
       {
            $comment = CommentPost::model()->find('id=:id', array('id' => $commentId));
            $comment->delete();        
       }
       elseif($text=='page')
        {
            $comment = CommentBussinessPage::model()->find('id=:id', array('id' => $commentId));
            $comment->delete();                   
        }
    }
    public function actionViewConversation($userId , $senderId){
        $this->layout = 'layout_user';
        //$userId = 35; $senderId = 33;
        $messages = Messages::model()->with('user')->findAll('user_id=:userId AND sender_id=:senderId OR user_id=:senderId AND sender_id=:userId',array(':userId'=>$userId,':senderId'=>$senderId));
        
                
        $this->render('conversation',array('messages'=>$messages));
    }
    public function actionUnfriend($id){
        
        $unfriend = UserFriend::model()->find("friend_id=:fid AND user_id=:uid",array(':fid'=>Yii::app()->user->userId,':uid'=>$id));
        $unfriend->delete();
        $this->redirect(array("user/viewprofile/userId/$id"));
    }
    public function actionViewMessage($messageId){
        $this->layout = 'layout_user';
      $messages = MessageChat::model()->with('user','sender','message')->findAll('t.message_id=:messgId',array(':messgId'=>$messageId));
      $model=  Messages::model()->findByPk($messageId);
      $model->is_read = 1;
      $model->save();
      $this->render('detailmessage',array('message'=>$messages));
    }
    
    public function actionReplyMessage(){
        $userId= $_POST['recvrId'];
        $messId= $_POST['messageId'];
        $message= $_POST['message'];
       
        $model=new MessageChat;
        $model->sender_id=Yii::app()->user->userId;
        $model->user_id=$userId;
        $model->message_id=$messId;
        $model->message=$message;
        $model->save();
        Yii::app()->user->setFlash('success', "Reply Message has been sent.");

               // echo '<script type="text/javascript">window.top.location.href = "' . Yii::app()->baseUrl . '/index.php/user/inbux"; </script>';
        $this->redirect(Yii::app()->baseUrl . '/index.php/user/viewmessage/messageId/'.$messId);
        
    }
    
    public function actionGetNames() {
	  
		/*$sql = 'SELECT people_id as id, CONCAT(first_name," ",last_name) as value, first_name as label FROM people WHERE first_name LIKE :qterm ';
		$sql .= ' ORDER BY first_name ASC';
		$command = Yii::app()->db->createCommand($sql);
		$qterm = $_GET['term'].'%';
		$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
		$result = $command->queryAll();*/
		echo CJSON::encode("in"); exit;
	  
	}
       
        public function actionAllfriend(){
            $this->layout = 'layout_user';
            $friend = UserFriend::model()->findAll('user_id=:userId',array('userId'=>Yii::app()->user->userId));
            $this->render('allfriends',array('friends'=>$friend));
        }
        
        
}
