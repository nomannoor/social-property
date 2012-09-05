<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
       $this->layout='main'; 
        $session = Yii::app()->session['isLoggedIn'];
            if(!empty($session)){
                $this->redirect(Yii::app()->baseUrl.'/index.php/user/dashboard');
            }else {
        $this->render('index');
            }
    }
    public function actionFacebook()
	{
		           
		//$this->render('facebook');
           $app_id = "372023319534070";
           $app_secret = "b1c4cd3cd3499d7a781fd454b790fa87";
           $my_url = "http://thepaksoft.net/social-property/index.php/site/facebookcallback";
           
           

           //session_start();
           $code = ''/*$_REQUEST["code"]*/;


           if(empty($code)) {
             Yii::app()->session['state']=md5(uniqid(rand(), TRUE)); //CSRF protection

           $dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" 
               . $app_id . "&scope=email&redirect_uri=" . urlencode($my_url) . "&state="
               . Yii::app()->session['state'];

             //echo("<script> top.location.href='" . $dialog_url . "'</script>"); 
           $this->redirect($dialog_url);
           }
	}
        public function actionFacebookCallback()
	{
		           
		$this->render('facebookcallback');
	}

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }


    

}
