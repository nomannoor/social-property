 <?php 
    session_start();
   $app_id = "372023319534070";
   $app_secret = "b1c4cd3cd3499d7a781fd454b790fa87";
   $my_url = "http://thepaksoft.net/social-property/index.php/site/facebookcallback";

  // http://thepaksoft.net/zzzeal/index.php/site/facebookcallback?state=7444da7a584e7e3fc29afb005aec3ff9&code=AQBTvINxW_5SNzq4xiZrJoyGrnlaItOCuFmaePQxoIVAdAKrJs8h8kLjF1Bvm0oop2aVzBcA8c0eUIF8hqOpTbJh7odFyJJbNbPG1fn-9NcxBGsbJZWyDGM4NAHsPQs7IIfrQn533CU__EJtlAhwip59702XdaHZ-md-_ycTxrYGzh7Feds-kGdNZXYpVZLDirY#_=_
   //session_start();
   $code = $_REQUEST["code"];
   //$_REQUEST['state'];

   /*if(empty($code)) {
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
     $dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'];

     echo("<script> top.location.href='" . $dialog_url . "'</script>");
   }*/
   if($_REQUEST['state'] /*== $_SESSION['state']*/) {
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;

     
     $response = file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];

     $user = json_decode(file_get_contents($graph_url));
    
$users = User::model()->find('username=:username', array('username' => $user->name));
                                if(count($users ) > 0)
                                {
                                    //echo "already coming user";
                                    //$this->redirect(Yii::app()->baseUrl);
                                    Yii::app()->request->cookies['username'] = new CHttpCookie('username', $user->name);
                                    Yii::app()->request->cookies['userId']=new CHttpCookie('userId',$users['id']);
                                    Yii::app()->request->cookies['userType']=new CHttpCookie('userType',$users['user_type']);
                                    
                                    Yii::app()->user->setFlash('success',"You Are Now Logged With Facebook Account");
                                     echo "<script>window.opener.location.href='".Yii::app()->baseUrl."/index.php/user/dashboard/';window.close();</script>";
                                }                                
                                else
                                {
                                    $length = 06;
                                    $chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
                                    shuffle($chars);
                                    $password = implode(array_slice($chars, 0, $length));
                                    $model=new User;
                                    $model->username=$user->name;
                                    $model->password=$password;
                                    $model->email=$user->email;
                                    $model->user_type=1;
                                    $model->is_active=1;
                                    $model->save();
                                    $Id = Yii::app()->db->getLastInsertId();
                                    $profile_pic =  "http://graph.facebook.com/".$user->id."/picture";
                                    $userProfile=new UserProfile;
                                    $userProfile->user_id=$Id;                                    
                                    $userProfile->first_name=$user->first_name;
                                    $userProfile->last_name=$user->last_name;
                                    $userProfile->image=$profile_pic;
                                    $userProfile->join_date=date('Y-m-d');
                                    $userProfile->save(false);
                                    Yii::app()->request->cookies['username'] = new CHttpCookie('username', $user->name);
                                    Yii::app()->request->cookies['userId']=new CHttpCookie('userId',$Id);
                                    Yii::app()->request->cookies['userType']=new CHttpCookie('userType',1);
                                    Yii::app()->user->setFlash('success',"You Are Now Logged With Facebook Account");
                                    echo "<script>window.opener.location.href='".Yii::app()->baseUrl."/index.php/user/dashboard/';window.close();</script>";
                                }

   }
   else {
     echo("The state does not match. You may be a victim of CSRF.");
   }

 ?>
