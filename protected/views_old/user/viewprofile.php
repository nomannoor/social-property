<style>#notify{margin:0px auto;font-size:13px;width:100%;text-shadow:0 1px 0 rgba(255,255,255,0.4)}#notify_error{margin:15px 0 5px;border:1px solid #a34625;background-color:#f9d9ce;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}#notify_success{margin:15px 0 5px;border:1px solid #25a336;background-color:#dfffe3;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}#notify_message{margin:15px 0 5px;border:1px solid #284797;background-color:#cedaf9;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}.flash_icon_container{margin-left: 150px; margin-right: 30px;float:left;width:20px;text-align:right;padding-right:8px;height:20px;position:relative;top:-3px}.flash_messages_container{margin-left: 200px; font-family:'Helvetica Neue', 'Myriad Pro', Calibri, 'trebuchet ms', Tahoma, Arial, Verdana, sans-serif;color:#333}.notify_message{width:400px;height:40px;background-color:#A6D6FF}</style>
<?php if (Yii::app()->user->hasFlash('success')) { ?>
    <div id="notify">
        <div id="notify_success" style="opacity: 1; ">
            <div class="flash_icon_container">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/icon-success.png" onload="$('#notify_success').animate({opacity: 1.0}, 3000).fadeOut(500)" />
            </div>
            <div class="flash_messages_container"><?php echo Yii::app()->user->getFlash('success'); ?></div><br class="clear">
        </div>
    </div>                
<?php } else if (Yii::app()->user->hasFlash('error')) {
    ?>
    <div id="notify">
        <div id="notify_error" style="opacity: 1; ">
            <div class="flash_icon_container">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/icon-error.png" onload="$('#notify_error').animate({opacity: 1.0}, 3000).fadeOut(500)" />
            </div>
            <div class="flash_messages_container"><?php echo Yii::app()->user->getFlash('error'); ?></div><br class="clear">
        </div>
    </div> 
<?php } ?>



<script>
    function addPost()
    {
        
        
        var tagFrnd=$('#tagFrnd').val();
        $('.well-for-table:nth-child(1)').css('margin-top','80px');
        var message = $('#message').html();
       
        
        $.post('<?php echo Yii::app()->baseUrl."/index.php/user/updatePost";?>', 
        { message: message, tag: tagFrnd },
        function(data) {
        
        obj = jQuery.parseJSON(data);
        
        var url = '<?php echo Yii::app()->baseUrl;?>';
        var userId = '<?php echo Yii::app()->user->userId; ?>';
        var like = '';
        var patt=/http/g;
        var result=patt.test(obj.user.image);
        
       var table = '<table class="well-for-table" >'; 
       
        table += '<tr>';
        if(obj.user.image == ""){
            table +='<td><img width="50" height="50" src="'+url+'/images/user.png"/></td>';
        }
        else if(result==true)
        {
            table +='<td><img width="50" height="50" src="asd'+obj.user.image+'"/></td>';
        }
        else { 
        table +='<td><img width="50" height="50" src="'+url+'/uploads/user_'+userId+'/'+obj.user.image+'" /></td>';
         } 
        table += '<td>&nbsp;&nbsp;&nbsp</td>';
        table += '<td style="width:100%">';
        table += '<p><b><a href="'+url+'/index.php/user/viewprofile/userId/'+userId+'">'+obj.user.first_name.toUpperCase().charAt(0) + obj.user.first_name.substring(1)+" "+obj.user.last_name.toUpperCase().charAt(0) + obj.user.last_name.substring(1)+'</a></b><span style="float:right; font-size: 10px;margin-right:3px;"></span><br />';
        table += obj.post.message; 
        table +='</td>';
        table +='</tr>';
        table += '<tr><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>';
        table +='<span id="like_'+obj.post.id+'"><i class="icon-check"></i><a  href="javascript:void(0)" onclick="postrecentLike('+obj.post.id+')">LIKE</a></i></span>';
        table +='&nbsp;&nbsp;<span id="comment_'+obj.post.id+'"><i class="icon-comment"></i><a href="javascript:void(0)" onclick="showCMBox('+obj.post.id+')">COMMENT</a></i></span>';
        table += '&nbsp;&nbsp;<i class="icon-share"></i><a href="javascript:void(0)" onclick="postShare('+obj.post.id+')">SHARE</a></i></span>&nbsp;&nbsp;<i class="icon-eye-open"></i><a href="#">WATCH</a>&nbsp;&nbsp';
        table +='<span id = "del_'+obj.post.id+'"><i class="icon-eye-open"></i><a href="javascript:void(0)" onclick="deletePost('+obj.post.id+')">DELETE</a></span></td></tr>';
        table +='<tr style="display:none;" id="comment_t'+obj.post.id+'"><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td><textarea id="commenttext_'+obj.post.id+'" style="width:98%; height:40px; resize: none;" placeholder="Enter your comment here..."></textarea><input style="float:right;margin-right:5px;" type="button" value="Comment" onclick="addrecentComment('+obj.post.id+')"></td></tr>'
        
   
    
    $('.innerdiv').prepend(table);
            
    $('.well-for-table:nth-child(2)').css('margin-top','0px');        
            
            
            //$('.well-for-table').html('');
        }); 
        
       $('#message').text(''); 
       //$('#update_button').hide();
    }
    function addFriend()
    {
        userId = <?php echo $model->user_id; ?>;
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/addFriend/userId/"; ?>'+userId, 
        function(data) {
            $('#addfriends').html('<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'warning', 'icon' => 'ok white', 'label' => 'Friend Request Sent')); ?>');
        });        
    }
    
    function confirmFriend()
    {
        requestId = $('#requestId').val();
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/confirmFriend1/requestId/"; ?>'+requestId, 
        function(data) {
            $('#confirmfriends').html('<span><?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'info', 'icon' => 'ok white', 'label' => 'Friends')); ?></span>');
        });        
    }
    
    function rejectFriend()
    {
        requestId = $('#requestId').val();
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/rejectFriend/requestId/"; ?>'+requestId, 
        function(data) {
            $('#confirmfriends').html('<span id="addfriends"><a href="javascript:void(0)" onclick="addFriend()" ><?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'info', 'icon' => 'ok white', 'label' => 'Add Friend')); ?></a></span>');
        });        
    }
</script>


<div class ="well" style =" float:left;margin-left:20px; margin-top: 0px; width: 250px; height: auto;">

    <a href="#" class="thumbnail" rel="tooltip" data-title="Tooltip">
        <?php if($model->image) { ?><img src="<?php echo Yii::app()->baseUrl ?>/uploads/user_<?php echo $model->user_id; ?>/<?php echo $model->image; ?>" alt=""><?php } else {?>
        <img src="<?php echo Yii::app()->baseUrl ?>/images/user.png" alt="">
            <?php } ?>
    </a>
    <table class="table">
        <tr>
            <td> 

            </td>
        </tr>
        <?php if($model->first_name){?>
        <tr>
            <td>Name</td><td><?php echo $model->first_name; ?></td>
        </tr><?php } if($model->last_name){?>
        <tr>
            <td>Last Name</td><td><?php echo $model->last_name; ?></td>
        </tr><?php } if($model->gender){?>
        <tr>
            <td>Gender</td><td><?php echo $gender->gender; ?></td>
        </tr><?php } if($model->address){?>
        <tr>
            <td>Address</td><td><?php echo $model->address; ?></td>
        </tr><?php } if($country){?>
        <tr>
            <td>Country</td><td><?php echo $country->name; ?></td>
        </tr><?php } if($model->city){?>
        <tr>
            <td>City</td><td><?php echo $model->city; ?></td>
        </tr><?php } if($model->state){?>


        <tr>
            <td>State</td><td><?php echo $model->state; ?></td>
        </tr><?php } if($model->contact_number){?>
        <tr>
            <td>Contect</td><td><?php echo $model->contact_number; ?></td>
        </tr>
        <tr><?php } if($model->dob){?>
            <td>Date Of Birth</td><td><?php echo $model->dob; ?></td>
        </tr>
        <tr><?php } if($model->join_date){?>
            <td>Join Date</td><td><?php echo $model->join_date; ?></td>
        </tr>
       <?php }?>




    </table>
    <?php if ($model->user_id == Yii::app()->user->userId) { ?>
        <center>
            <?php echo CHtml::link('Edit Profile', array('user/profile'), array('class' => 'btn btn-success')); ?>
        </center>
    <?php } ?>
</div>






<style>
    .well-for-table:hover {
        background-color: #e1eafe;
    }
    .well-for-table img{
        height:50px;
    }
    
    .well-for-table1:hover {
        background-color: #f5f5f5;
    }
    
    .well-for-table1 img{
        height:30px;
    }

</style>
<script>
    function postLike(postId)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postlike/postId/"; ?>'+postId+'/text/post', 
        function(data) {
            $('#like_'+postId).html('<span id="like_'+postId+'"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postUnlike('+postId+')">UNLIKE</a></span>');
        }); 
    }
    
    function postUnlike(postId)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postunlike/postId/"; ?>'+postId+'/text/post', 
        function(data) {
            $('#like_'+postId).html('<span id="like_'+postId+'"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postLike('+postId+')">LIKE</a></span>');
        }); 
    }
    
    function addComment(postId)
    {
        comment = $('#commenttext_'+postId).val();
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/addcomment/postId/"; ?>'+postId+'/comment/'+comment+'/text/post', 
        function(data) {
            $('#comment_'+postId).hide();
            $('#commenttext_'+postId).val('');
            location.reload();
        }); 
    }
    
    function postShare(postId)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postshare/postId/"; ?>'+postId, 
        function(data) {
            location.reload();
        });
    }
    
    function deletePost(postId)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postdelete/postId/"; ?>'+postId, 
        function(data) {
            location.reload();
        });
    }
    
    function deleteComment(commentId)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/commentdelete/commentId/"; ?>'+commentId, 
        function(data) {
            location.reload();
        });
    }
    function postrecentLike(postId)
    {
        
        
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postlike/postId/"; ?>'+postId+'/text/post', 
        function(data) {
            $('#no-of-likes_'+postId).html('<b>'+data+'</b> people like this');
            $('#like_'+postId).html('<span id="like_'+postId+'"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postrecentUnlike('+postId+')">UNLIKE</a></span>');
        }); 
    }
    function postrecentUnlike(postId)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postunlike/postId/"; ?>'+postId+'/text/post', 
        function(data) {
            $('#like_'+postId).html('<span id="like_'+postId+'"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postrecentLike('+postId+')">LIKE</a></span>');
        }); 
    }
    function showCMBox(id){
    $('#comment_t'+id).show();
    }
    function addrecentComment(id){
        var commValue=$('#commenttext_'+id).val();
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/addcomment/postId/"; ?>'+id+'/comment/'+commValue+'/text/post', 
        function(data) {
            $('#comment_t'+id).hide();
            //$('#commenttext_'+postId).val('');
            location.reload();
            //$("#inner").hide().fadeIn('fast');
        });
    }
</script>
<div style ="margin-left: 320px;">
    <?php
                if ($model->first_name) {
                    $userName2 = ucfirst($model->first_name) . ' ' . ucfirst($model->last_name);
                } else {
                    $user2 = User::model()->findByAttributes(array('id' => $model->user_id));
                    $userName2 = $user2->username;
                }
                ?>
    <h2 style="float:left; padding-left:7px;"><?php echo $userName2;?></h2>
    <?php
    if ($model->user_id != Yii::app()->user->userId) {
        ?>
    
        <div style="float:right;">
            <?php if ($userFriend) { ?>
                <span id="addfriends"><?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'warning', 'icon' => 'ok white', 'label' => 'Friend Request Sent')); ?></span>
            <?php } else if ($userFriend2) { ?>
                <input type="hidden" value="<?php echo $userFriend2->id;?>" id="requestId">
                <span id="confirmfriends" style="float:left;margin-right: 5px;">
    <?php $this->widget('bootstrap.widgets.BootButtonGroup', array(
        'type'=>'warning', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'buttons'=>array(
            array('label'=>'Confirm Friend', 'url'=>'javascript:void(0)'),
            array('items'=>array(
                array('label'=>'Confirm Request', 'url'=>'javascript: confirmFriend()'),                
                '---',
                array('label'=>'Reject FriendRequest', 'url'=>'javascript: rejectFriend()'),
            )),
        ),
    )); ?>
</span>
                
            <?php } else if ($isFriend || $isFriend2) { ?>
                <span id="addfriends">
                 <?php $id = Yii::app()->getRequest()->getQuery('userId');?>
                    <?php echo CHtml::link('Un-friend', array("user/unfriend/id/$id"), array('class' => 'btn btn-info',)); ?>
                    
                 <?php  //$this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'info', 'icon' => 'ok white', 'label' => 'Un-Friend', 'url'=>'user/unfriend/id/$id')); ?></span>
                
            <?php } else { ?>
                <span id="addfriends"><a href="javascript:void(0)" onclick="addFriend()" ><?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'info', 'icon' => 'ok white', 'label' => 'Add Friend')); ?></a></span>
            <?php } ?>
    <?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'myModal')); ?>

            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h3>Messaging</h3>
            </div>

            <div class="modal-body">
                <iframe style='width:100%;height:330px;border:none;' src='<?php echo Yii::app()->baseUrl."/index.php/user/messages/userId/".$model->user_id;?>'></iframe>
            </div>

            <div class="modal-footer">

                <?php
                $this->widget('bootstrap.widgets.BootButton', array(
                    'label' => 'Close',
                    'url' => '#',
                    'htmlOptions' => array('data-dismiss' => 'modal'),
                ));
                ?>
            </div>

    <?php $this->endWidget(); ?>
                <spain
            <?php echo CHtml::link('Message', '#myModal', array('class' => 'btn btn-info', 'data-toggle' => 'modal')); ?>
        </div>
            <?php } ?>
            <div style="padding-top:30px;height: 200px" class="shiftcontainer">
      <?php if(count($checkFriend) > 0 || Yii::app()->user->userId==$model->user_id) {?>
        <div class="well" style="height:100px;margin-left:-10px">
        <!--<textarea id ="message" name="message" onfocus="$('#buttonBox').show();"  style="width:98.5%; resize: none;" placeholder="What's on your mind?" cols="40"></textarea><br/>-->
        <div id="message" contenteditable="true"  onfocus="$('#buttonBox').show();" style="background-color: white;padding:5px;border-radius: 5px;width:98.5%;height:50px;border:solid 2px #333;font-family:Arial, Helvetica, sans-serif;font-size:14px;margin-bottom:6px;text-align:left;"></div>
        <input id="tagFrnd"  type="hidden" name="tag" value="<?php if(Yii::app()->user->userId==$model->user_id){ echo Yii::app()->user->userId; } else { echo Yii::app()->user->userId.','.$model->user_id; } ;?>" />
        <div id="buttonBox" style="display:none">
            <div id="update_button" style="float:right;margin-right: 5px;"><input style ="margin-bottom: 10px;" onClick="addPost();" type="button" value="Post" class="btn btn-primary" id="postbtn"></div>
        </div>
        </div><?php }?>
       
            <div class="shadowcontainer" >
                
                <div class="innerdiv">
                    <?php if ($posts){
            foreach ($posts as $p) { ?>
                <?php
                
                $userId = $p->user_id;
                $user = UserProfile::model()->findByAttributes(array('user_id' => $userId));
                if ($user->first_name) {
                    $userName = ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
                } else {
                    $user3 = User::model()->findByAttributes(array('id' => $userId));
                    $userName = $user3->username;
                }
                ?>
                <table class="well-for-table">
                    <tr>
                        <?php if($user->image){ ?>
                        <td><img width="50" height="50" src="<?php echo Yii::app()->baseUrl.'/uploads/user_'.$user->user_id.'/'.$user->image;?>" /></td>
                        <?php } else { ?>
                        <td><img width="50" height="50" src="<?php echo Yii::app()->baseUrl.'/images/user.png';?>"/></td>
                        <?php } ?>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td style="width:100%;">
                            <p>
                                <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$user->user_id; ?>"><?php echo $userName;?></a></b><span style="float:right;margin-right:3px;"><?php echo $this->checkTime($p->date);?></span><br />
                                <?php echo $p->message; ?><br/>
                                <?php if(!empty($p['image'])){ $Image=explode('.',$p["image"]);if($Image[1]!='mp4') {?><img src="<?php echo Yii::app()->baseUrl.'/uploads/'.$p['id'].'_'.$p['image'];?>" style="height:150px;width:150px"/><?php } else { echo "<div id='mediaplayer_".$p['id']."'></div><script type='text/javascript'>jwplayer('mediaplayer_".$p['id']."').setup({'flashplayer': '".Yii::app()->baseUrl."/js/jwplayer/player.swf','skin':'".Yii::app()->baseUrl."/js/jwplayer/bekle.zip','id': 'playerID','width': '400','height': '300','file': '".Yii::app()->baseUrl."/uploads/".$p['id'].'_'.$p['image']."', 'controlbar.position':'over'});</script>"; } } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td>
                            <?php $like = LikePost::model()->find('post_id=:post_id AND user_id=:user_id',array('post_id' => $p->id, 'user_id' => Yii::app()->user->userId));
                            if (!$like) { ?>
                            <span id="like_<?php echo $p->id;?>"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postLike(<?php echo $p->id;?>)">LIKE</a></span>
                            <?php } else { ?>
                            <span id="like_<?php echo $p->id;?>"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postUnlike(<?php echo $p->id;?>)">UNLIKE</a></span>
                            <?php } ?>
                            &nbsp;&nbsp;<i class="icon-comment"></i><a href="javascript:void(0)" onclick="$('#comment_t'+<?php echo $p->id;?>).show();">COMMENT</a>&nbsp;&nbsp;<i class="icon-share"></i><a href="javascript:void(0)" onclick="postShare(<?php echo $p->id;?>)">SHARE</a>&nbsp;&nbsp;<i class="icon-eye-open"></i><a href="#">WATCH</a>&nbsp;&nbsp;
                            <?php if ($p->user_id==Yii::app()->user->userId){ ?>
                            <span id="del_<?php echo $p->id;?>"><i class="icon-eye-open"></i><a href="javascript:void(0)" onclick="deletePost(<?php echo $p->id;?>)">DELETE</a></span></td>
                            <?php } ?>
                    </tr>
                    <?php $comments = CommentPost::model()->findAll(array('select' => '*',
                'condition' => "post_id = $p->id",
                //'order' => 'date ASC',
                    ));
                    if ($comments){
                    foreach ($comments as $c){
                    ?>
                    <?php
                $userId1 = $c->user_id;
                $user1 = UserProfile::model()->findByAttributes(array('user_id' => $userId1));
                if ($user1->first_name) {
                    $userName1 = $user1->first_name . ' ' . $user1->last_name;
                } else {
                    $user1 = User::model()->findByAttributes(array('id' => $userId1));
                    $userName1 = $user1->username;
                }
                ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td><td>
                        <table class="well-for-table well-for-table1" style="width:100%;">
                    <tr onmouseover="$('#img_<?php echo $c->id;?>').show()" onmouseout="$('#img_<?php echo $c->id;?>').hide()">
                        <?php if($user1->image){ ?>
                        <td style="padding-top:0px;"><img width="30" height="30" src="<?php echo Yii::app()->baseUrl.'/uploads/user_'.$user1->user_id.'/'.$user1->image;?>" /></td>
                        <?php } else { ?>
                        <td style="padding-top:0px;"><img width="30" height="30" src="<?php echo Yii::app()->baseUrl.'/images/user.png';?>"/></td>
                        <?php } ?>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td style="width:100%;">
                            <p>
                                <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$c->user_id; ?>"><?php echo $userName1;?></a></b>
                                <?php if($c->user_id==Yii::app()->user->userId){ ?>
                                <a href="javascript:void(0)"><img id="img_<?php echo $c->id;?>" width="12" style="height:12px;float:right;margin-right: 5px;margin-top: 25px;display:none;" src="<?php echo Yii::app()->baseUrl.'/images/delete.png';?>" onclick="deleteComment(<?php echo $c->id;?>)"/></a>
                                <?php } ?>
                                <br /><?php echo $c->comment; ?><br />
                                
                            </p>
                            <span style="margin-bottom:0px;float:right;margin-top: -45px;font-size: 10px"><?php echo $this->checkTime($c->date);?></span>
                        </td>
                    </tr>
                        </table>
                        </td>
                    </tr>
                    <?php } } ?>
                    <tr style="display:none;" id="comment_t<?php echo $p->id;?>"><td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td><td><textarea id="commenttext_<?php echo $p->id;?>" style="width:98%; height:40px; resize: none;" placeholder="Enter your comment here..."></textarea><input style="float:right;margin-right:5px;" type="button" value="Comment" onclick="addComment(<?php echo $p->id;?>)"></td></tr>
                </table>
<?php } } else{?>
                    No recent posts...
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
