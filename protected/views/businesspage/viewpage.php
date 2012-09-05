<?php 
$pageFollow=UserpageFollow::model()->find('user_id=:userId AND business_page_id=:pageId',array(':userId'=>Yii::app()->user->userId,':pageId'=>$id));

$model = Pages::model()->findByPk($id);  ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<style type="text/css">#map_canvas {height:250px;width:250px;margin-left:-10px}</style>

<style>#notify{margin:0px auto;font-size:13px;width:100%;text-shadow:0 1px 0 rgba(255,255,255,0.4)}#notify_error{margin:15px 0 5px;border:1px solid #a34625;background-color:#f9d9ce;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}#notify_success{margin:15px 0 5px;border:1px solid #25a336;background-color:#dfffe3;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}#notify_message{margin:15px 0 5px;border:1px solid #284797;background-color:#cedaf9;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}.flash_icon_container{margin-left: 150px; margin-right: 30px;float:left;width:20px;text-align:right;padding-right:8px;height:20px;position:relative;top:-3px}.flash_messages_container{margin-left: 200px; font-family:'Helvetica Neue', 'Myriad Pro', Calibri, 'trebuchet ms', Tahoma, Arial, Verdana, sans-serif;color:#333}.notify_message{width:400px;height:40px;background-color:#A6D6FF}</style>

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
    function addPost()
    {
        $('#show-empty-post').css('display','none');
        var pageId = "<?php echo Yii::app()->getRequest()->getQuery('id');?>";
        $('.well-for-table:nth-child(1)').css('margin-top','80px');
        var message = $('#message').val();
        $.post('<?php echo Yii::app()->baseUrl."/index.php/businesspage/updatePost/message/";?>'+message+'<?php echo "/id/"?>'+pageId, 
        function(data) {
        obj = jQuery.parseJSON(data);
        var url = '<?php echo Yii::app()->baseUrl;?>';
        var userId = '<?php echo Yii::app()->user->userId; ?>';
        var like = '';
       var table = '<table id ="row_'+obj.id+'" '; 
       table+='class="well-for-table">';
        table += '<tr>';
        if(obj.image != ""){
        table +='<td><img width="50" height="50" src="'+url+'/uploads/user_'+userId+'/'+obj.image+'" /></td>';
        }
        else { 
        
        table +='<td><img width="50" height="50" src="'+url+'/images/user.png"/></td>';
         } 
        table += '<td>&nbsp;&nbsp;&nbsp</td>';
        table += '<td style="width:100%">';
        table += '<p><b><a href="'+url+'/index.php/user/viewprofile/userId/'+userId+'">'+obj.first_name.toUpperCase().charAt(0) + obj.first_name.substring(1)+" "+obj.last_name.toUpperCase().charAt(0) + obj.last_name.substring(1)+'</a></b><span style="float:right; font-size: 10px;margin-right:3px;"></span><br />';
        table += obj.message; 
        table +='</td>';
        table +='</tr>';
        table += '<tr><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>';
        table +='<span id = "like_'+obj.id+'"><i class="icon-eye-open"></i><a href="javascript:void(0)" onclick="posLike('+obj.id+')">LIKE</a></i>';
        table +='&nbsp;&nbsp;<i class="icon-comment"></i><a onclick="">COMMENT</a>&nbsp;&nbsp;<i class="icon-share"></i>';
        table += '<a href="javascript:void(0)" onclick="postShare('+obj.id+')">SHARE</a>&nbsp;&nbsp;<i class="icon-eye-open"></i><a href="#">WATCH</a>&nbsp;&nbsp';
        table +='<span id = "del_'+obj.id+'"><i class="icon-eye-open"></i><a href="javascript:void(0)" onclick="deletePost('+obj.id+')">DELETE</a></span></td></tr>';
        
        
    //alert(table);
    $('#row_'+obj.id).fadeOut(5000);
    $('#inner').prepend(table);
            
    $('.well-for-table:nth-child(2)').css('margin-top','0px');        
            
            
            //$('.well-for-table').html('');
        }); 
        
    }
    function postLike(postId)
    {
        
        
        
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/businesspage/postlike/postId/"; ?>'+postId, 
        function(data) {
            alert(data);
            $('#like_'+postId).html('<span id="like_'+postId+'"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postUnlike('+postId+')">UNLIKE</a></span>');
        }); 
    }
    
    function postUnlike(postId)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postunlike/postId/"; ?>'+postId, 
        function(data) {
            $('#like_'+postId).html('<span id="like_'+postId+'"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postLike('+postId+')">LIKE</a></span>');
        }); 
    }
    
    function addComment(postId)
    {
        
        comment = $('#commenttext_'+postId).val();
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/businesspage/addcomment/postId/"; ?>'+postId+'/comment/'+comment, 
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
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/businesspage/postdelete/postId/"; ?>'+postId, 
        function(data) {
            alert("You want to delete this..")
            $('#row_'+postId).fadeOut("10000");
            //location.reload();
        });
    }
    
    function deleteComment(commentId)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/businesspage/commentdelete/commentId/"; ?>'+commentId, 
        function(data) {
            location.reload();
        });
    }
</script>


<script type="text/javascript">
$(document).ready(function (){
    
            var map;
            var latlng = new google.maps.LatLng("<?php echo $model->latitude; ?>","<?php echo $model->longitude; ?>");
            var myOptions = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
               var marker = new google.maps.Marker({
                position: latlng, 
                map: map
            });
             var followCount=<?php echo count($pageFollow);?>;
             if(followCount > 0){
                 $('#postDiv').show();
             }
    });
      
 function followPage(id,text){
     
     
     $.post('<?php echo Yii::app()->baseUrl;?>/index.php/businesspage/followbusinesspage/id/'+id+'/text/'+text, 
        function(data) {
            if(data=='follow')
             {
                 $('#followBtn').html('');
                 var btn='<a class="btn btn-success" style="margin-left:20px" href="javascript:void(0)" onclick="followPage('+id+','+"'"+data+"'"+');">Follow Page</a>';
                 $('#followBtn').html(btn);
                 $('#postDiv').hide();
             }
             else
             {
                 $('#followBtn').html('');
                 var btn='<a class="btn btn-success" style="margin-left:20px" href="javascript:void(0)" onclick="followPage('+id+','+"'"+data+"'"+');">Unfollow Page</a>';
                 $('#followBtn').html(btn);
                 $('#postDiv').show();

             }    
            
        });
 }
</script>


<div style="width:70%">
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

</div>




<div class="well" style=" float:left;margin-left:20px; margin-top: 0px; width: 250px; height: auto;">

    <a href="#" class="thumbnail" rel="tooltip" data-title="<?php echo $model['company_name']; ?>" data-original-title="">
        <img src="<?php echo Yii::app()->baseUrl?>/uploads/business_page_<?php echo $model['user_id'].'/'.$model['image']; ?>" alt="">    </a>
    <table class="table">
        <tbody><tr>
            <td> 

            </td>
        </tr>
                <tr>
            <td>Company Name</td><td><?php echo $model['company_name']; ?></td>
        </tr>        <tr>
            <td>Address</td><td><?php echo $model['address']; ?></td>
        </tr>        <tr>
            <td>Domain</td><td><?php echo $model['domain']; ?></td>
        </tr>        <tr>
            <td>Description</td><td><?php echo $model['description']; ?></td>
        </tr>
        <tr><td colspan="2" style="text-align:center"><b>Sub Pages</b></td></tr><tr><td colspan="2">
            <?php
            $bpId=$model['id'];
            $dataProvider = new CActiveDataProvider('SubPage', array('criteria'=>array( 'condition'=>"bussiness_page_id=$bpId")));
            $dataProvider->pagination->pageSize = 5;
            $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider,
             'summaryText' => '',
                'pager' => array(
                        'header' => false,
                        'nextPageLabel' => 'Next',
                        'lastPageLabel' => 'Last',
                    ),
            'columns' => array(
                    array(
                        'header'=>'Name',
                        'name' => 'name',
                        'type' => 'raw',
                        'value' => 'CHtml::link(ucfirst($data->name), $this->grid->controller->createUrl("businesspage/viewsubpage", array("id" => $data->id,)))',
                    ),                
                ),
            ));
            ?></td>
        </tr>
        <tr>
        <td colspan="2" style="text-align:center"><b>Location</b></td>
        </tr>
        <tr>
            <td colspan="2"><div id="map_canvas"></div></td>
        </tr>
        

    </tbody></table>
            
            <?php if(Yii::app()->user->userId==$model->user_id) { ?><a class="btn btn-success" href="<?php echo Yii::app()->baseUrl.'/index.php/businesspage/createpage/'.$model->id?>">Edit Page</a><?php }?>
            <?php if(Yii::app()->user->userId!=$model->user_id) { ?><span id="followBtn"><?php if(count($pageFollow)>0) { ?><a class="btn btn-success" style="margin-left:20px" href="javascript:void(0)" onclick="followPage(<?php echo $model->id;?>,'unfollow');">Unfollow Page</a><?php } else { ?><a class="btn btn-success" style="margin-left:20px" href="javascript:void(0)" onclick="followPage(<?php echo $model->id;?>,'follow');">Follow Page</a> <?php }?></span><?php }?>
    </div>
<div class="well" style ="margin-left: 320px; width: auto;" >
 <?php if(Yii::app()->user->userId==$model->user_id) { 
     
     $display='display:show';
 }
 else
 {
     $display='display:none';
 }
?>
    <div id="postDiv" style="<?php echo $display?>">
    <textarea id ="message" name="message" onclick="this.style.height='40px'; $('#update_button').show();" style="width:98.5%; height:20px; resize: none;" placeholder="What's on your mind?"></textarea>
        <br/>
        <div id="update_button" style="display:none;float:right;margin-right: 5px;">
            <input style ="margin-bottom: 10px;"onClick="addPost();" type="button" value="Post" class="btn btn-primary">
        </div>
        <br/>
        <br/>
    </div>
       <!-- <div style="clear:both"></div> -->
        
        
        <div class="shiftcontainer" style="width:100%">
    <div class="shadowcontainer">
        <div  id ="inner" class="innerdiv">
            <?php if ($posts){
            foreach ($posts as $p) { ?>
                <?php
                
                    $userId = $p->user_id;
                    $user = UserProfile::model()->findByAttributes(array('user_id' => $userId));
                    if (!empty($user->first_name)) {
                        $userName = ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
                    } else {
                        $users = User::model()->findByPk($userId);
                        $userName = $users['username'];
                    }
                ?>
                <table id ="row_<?php echo $p->id; ?>" class="well-for-table" >
                    <tr>
                        <?php if(!empty($user->image)){ ?>
                        <td><img width="50" height="50" src="<?php echo Yii::app()->baseUrl.'/uploads/user_'.$user->user_id.'/'.$user->image;?>" /></td>
                        <?php } else { ?>
                        <td><img width="50" height="50" src="<?php echo Yii::app()->baseUrl.'/images/user.png';?>"/></td>
                        <?php } ?>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td style="width:100%;">
                            <p>
                                <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$p->user_id; ?>"><?php echo $userName;?></a></b><span style="float:right; font-size: 10px;margin-right:3px;"><?php echo $this->checkTime($p->date);?></span><br />
                                <?php echo $p->message; ?>
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
                            &nbsp;&nbsp;<i class="icon-comment"></i><a href="javascript:void(0)" onclick="$('#comment_'+<?php echo $p->id;?>).show();">COMMENT</a>&nbsp;&nbsp;<i class="icon-share"></i><a href="javascript:void(0)" onclick="postShare(<?php echo $p->id;?>)">SHARE</a>&nbsp;&nbsp;<i class="icon-eye-open"></i><a href="#">WATCH</a>&nbsp;&nbsp;
                            <?php if ($p->user_id==Yii::app()->user->userId){ ?>
                            <span id="del_<?php echo $p->id;?>"><i class="icon-eye-open"></i><a href="javascript:void(0)" onclick="deletePost(<?php echo $p->id;?>)">DELETE</a></span></td>
                            <?php } ?>
                    </tr>
                    <?php $comments = CommentBussinessPage::model()->findAll(array('select' => '*',
                'condition' => "post_id = $p->id",
                'order' => 'date DESC',
                    ));
                    if ($comments){
                    foreach ($comments as $c){
                    ?>
                    <?php
                $userId1 = $c->user_id;
                $user1 = UserProfile::model()->findByAttributes(array('user_id' => $userId1));
                if (!empty($user1->first_name)) {
                    $userName1 = ucfirst($user1->first_name) . ' ' . ucfirst($user1->last_name);
                } else {
                    $user2 = User::model()->findByAttributes(array('id' => $userId1));
                    $userName1 = $user2['username'];
                }
                ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td><td>
                        <table class="well-for-table well-for-table1" style="width:100%">
                            <tr onmouseover="$('#img_<?php echo $c->id;?>').show()" onmouseout="$('#img_<?php echo $c->id;?>').hide()">
                        <?php if(!empty($user1->image)){ ?>
                        <td><img width="30" height="30" src="<?php echo Yii::app()->baseUrl.'/uploads/user_'.$user1->user_id.'/'.$user1->image;?>" /></td>
                        <?php } else { ?>
                        <td><img width="30" height="30" src="<?php echo Yii::app()->baseUrl.'/images/user.png';?>"/></td>
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
                    <tr style="display:none;" id="comment_<?php echo $p->id;?>"><td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td><td><textarea id="commenttext_<?php echo $p->id;?>" style="width:98%; height:40px; resize: none;" placeholder="Enter your comment here..."></textarea><input style="float:right;margin-right:5px;" type="button" value="Comment" onclick="addComment(<?php echo $p->id;?>)"></td></tr>
                </table>
<?php } }else{?>
            <div id ="show-empty-post">  No recent posts...</div>
                    <?php } ?>
        </div>
    </div>
</div>

        
</div>
