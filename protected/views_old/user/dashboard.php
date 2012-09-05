<script type="text/javascript" src="<?php //echo Yii::app()->baseUrl?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/jquery.form.js"></script>
<script type='text/javascript' src='<?php echo Yii::app()->baseUrl; ?>/js/jwplayer/jwplayer.js'></script>
<style>#notify{margin:0px auto;font-size:13px;width:100%;text-shadow:0 1px 0 rgba(255,255,255,0.4)}#notify_error{margin:15px 0 5px;border:1px solid #a34625;background-color:#f9d9ce;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}#notify_success{margin:15px 0 5px;border:1px solid #25a336;background-color:#dfffe3;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}#notify_message{margin:15px 0 5px;border:1px solid #284797;background-color:#cedaf9;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}.flash_icon_container{margin-left: 150px; margin-right: 30px;float:left;width:20px;text-align:right;padding-right:8px;height:20px;position:relative;top:-3px}.flash_messages_container{margin-left: 200px; font-family:'Helvetica Neue', 'Myriad Pro', Calibri, 'trebuchet ms', Tahoma, Arial, Verdana, sans-serif;color:#333}.notify_message{width:400px;height:40px;background-color:#A6D6FF}</style>
<!--tag css & js-->
 <script type="text/javascript">
$(document).ready(function()
{
var tagFrnd=new Array('<?php echo Yii::app()->user->userId;?>');   
$("#tagFrnd").val(tagFrnd);
var start=/@/ig;
var word=/@(\w+)/g;

$("#message").live("keyup",function() 
{
    
    
var content=$("#message").text();
var go= content.match(/@/g);
var name= content.match(/@(\w+)/g);
var dataString = 'searchword/'+ name;

if(go==null)
    {
        $("#msgbox").hide();
        $("#display").hide();
    }
else if(go.length > 0)
{
$("#msgbox").slideDown('show');
$("#display").slideUp('show');
$("#msgbox").html("Type the name of someone or something...");
if(name.length>0)
{
$.ajax({
type: "POST",
url: "<?php echo Yii::app()->baseUrl?>/index.php/user/searctag/"+dataString,
cache: false,
success: function(html)
{
    

$("#msgbox").hide();
$("#display").html(html).show();
}
});

}

}

return false();
});

$(".addname").live("click",function() 
{

var username=$(this).attr('title');
var old=$("#message").html();
var content=old.replace(word,"");
$("#message").html(content);
var  result=include(tagFrnd, $(this).attr('name'));                        
if(result != true)
{

tagFrnd.push($(this).attr('name'));
}
var E="<a class='red' contenteditable='false' href='<?php echo Yii::app()->baseUrl?>/index.php/user/viewprofile/userId/"+$(this).attr('name')+"' >"+username+' '+"</a>";
//$("#message").focus();
$("#message").append(E);
$('#tagFrnd').val(tagFrnd);
$("#display").hide();
$("#msgbox").hide();
//$("#message").focus();

});

});
function include(arr, obj) {
        for(var i=0; i<arr.length; i++) {
            if (arr[i] == obj) return true;
        }
    }
</script>
<style>
#contentbox
{
width:460px; height:50px;
border:solid 2px #333;
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
margin-bottom:6px;
text-align:left;
moz-border-radius: 15px;
border-radius: 15px;
}
.img
{
float:left; width:150px; margin-right:10px;
text-align:center;
}
#msgbox
{
width:auto;border:solid 1px #dedede;padding:5px;
display:none;background-color:#f2f2f2
}
.red
{
color:#08C;
font-weight:bold;
}
 a
{
text-decoration:none;
}
a:hover
{
text-decoration:none;
}
#display
{
width:auto;
display:none;
border-left:solid 1px #dedede;
border-right:solid 1px #dedede;
border-bottom:solid 1px #dedede;
overflow:hidden;
}
.display_box
{
padding:4px; border-top:solid 1px #dedede; font-size:12px; height:30px;
background-color: white;
}

.display_box:hover
{
background:#3b5998;
color:#FFFFFF;
}
.display_box a
{
color:#333;
}
.display_box a:hover
{
color:#fff;
}
#container
{
margin:50px; padding:10px; width:460px
}
.image
{
width:40px; float:left; margin-right:6px
}

</style>
<!--end-->
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
    iframe {
  margin-top: 5px;
  
    padding: 2px;
  -moz-border-radius: 6pxpx;
  -webkit-border-radius: 6px; 
  border-radius: 6px; 
}
hr {
  background: #ddd; 
  clear: both; 
  float: none; 
  width: 100%; 
  height: 1px;
  margin: 0 0 1.4em;
  border: none; 
}
</style>
<script type="text/javascript">
    function Tagging(e,text){
         var unicode=e.keyCode? e.keyCode : e.charCode;
         
            $('#ded').show();
            var val=text.substr(text.indexOf("@") + 1);
            
        
         if(unicode==32)
             {
                 $('#message').attr("onkeyup", '');
                 $('#message').attr("onkeyup", 'displayunicode(event)');
             }
          else
           {
               $('#ded').show();
               var anchors = $("#ded >li a");
                
                if (val !== "") {
                    var pattern = new RegExp('^' + val, 'i');
                    anchors.not(function(index) {
                        return $(this).text().match(pattern);
                    }).hide();
                }
           }   
    }
    function displayunicode(e){
    
    var unicode=e.keyCode? e.keyCode : e.charCode;
    var val = $('#message').val();
     
    if(unicode==50)
        {
            alert('starttagginf');
            val = val.slice(0, -1);
          
           $('#ded').show();
           $('#message').attr("onkeyup", '');
           $('#message').attr("onkeyup", 'Tagging(event,this.value)');
            /*var anchors = $("#ded >li a");
                $('#ded').show();
                if (val !== "") {
                    var pattern = new RegExp('^' + val, 'i');
                    anchors.not(function(index) {
                        return $(this).text().match(pattern);
                    }).hide();
                }*/
        }
    else
      {
          //alert('not');
      }  
    
        
    }
    
    function AddpostPic(){ 
                                   $("#preview").html('');
                                   //$("#loadingImage").html('<img src="<?php echo Yii::app()->baseUrl?>/images/loader.gif" alt="Uploading...."/>');
                                   $("#imageform").ajaxForm({target: '#preview'}).submit();  
                                  
                                   
                                   
            }
    
    function addstatus(){
        $('#photoDiv').hide();
        $('#message').html('');
        $('#message').show();
        $('#image_button').html('Add Photo / Video');
        $('#photoimg').val('');
        $('#postbtn').attr("onclick", '');
        $('#postbtn').attr("onclick", 'addPost()');
        $('#image_button').attr("onclick", '');
        $('#image_button').attr("onclick", 'addPic()');
        $('#postbtn').show();
        
    }
    function addPic()
    {
        $('#message').hide();
        $('#photoDiv').show();
        var message = $('#message').html();
        $('#image_message').html(message);
        $('#image_button').html('Update Status');
        $('#image_button').attr("onclick", '');
        $('#image_button').attr("onclick", 'addstatus()');
        
        $('#postbtn').attr("onclick", '');
        $('#postbtn').attr("onclick", 'AddpostPic()');
        $('#postbtn').attr('disabled','disabled');
            
        $('#photoimg').change(function(){
         $('#postbtn').removeAttr("disabled")
        });
    }
    function addPost()
    {
        
        
        var tagFrnd=$('#tagFrnd').val();
        
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
        
       var table = '<table id ="row_'+obj.post.id+'" '; 
       table+='class="well-for-table">';
        table += '<tr>';
        if(obj.user.image == ""){
            table +='<td><img width="50" height="50" src="'+url+'/images/user.png"/></td>';
        }
        else if(result==true)
        {
            table +='<td><img width="50" height="50" src="'+obj.user.image+'"/></td>';
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
        
    
    $('#row_'+obj.post.id).fadeOut(5000);
    $('#inner').prepend(table);
            
    $('.well-for-table:nth-child(2)').css('margin-top','0px');        
            
            
            //$('.well-for-table').html('');
        }); 
        
       $('#message').text(''); 
       //$('#update_button').hide();
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
    function postLike(postId,text)
    {
        
        
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postlike/postId/"; ?>'+postId+'/text/'+text, 
        function(data) {
            $('#no-of-likes_'+postId).html('<b>'+data+'</b> people like this');
            $('#like_'+postId).html('<span id="like_'+postId+'"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postUnlike('+postId+','+text+')">UNLIKE</a></span>');
        }); 
    }
    
    function postUnlike(postId,text)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postunlike/postId/"; ?>'+postId+'/text/'+text, 
        function(data) {
            $('#like_'+postId).html('<span id="like_'+postId+'"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postLike('+postId+','+text+')">LIKE</a></span>');
        }); 
    }
    
    function addComment(postId,text)
    {
        
        var comment = $('#commenttext_'+postId).val();
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/addcomment/postId/"; ?>'+postId+'/comment/'+comment+'/text/'+text, 
        function(data) {
            $('#comment_t'+postId).hide();
            //$('#commenttext_'+postId).val('');
            location.reload();
            //$("#inner").hide().fadeIn('fast');
        }); 
    }
    
    function postShare(postId)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postshare/postId/"; ?>'+postId, 
        function(data) {
            //location.reload();
            $("#inner").hide().fadeIn('fast');
        });
    }
    
    function deletePost(postId,text)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/postdelete/postId/"; ?>'+postId+'/text/'+text, 
        function(data) {
            alert("You want to delete this..")
            $('#row_'+postId).fadeOut("10000");
            //location.reload();
        });
    }
    
    function deleteComment(commentId,text)
    {
        $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/commentdelete/commentId/"; ?>'+commentId+'/text/'+text, 
        function(data) {
            //location.reload();
            $("#inner").hide().fadeIn('fast');
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
    
      <?php 
      /*  $status_frame = '<div class="well"><textarea id ="message" name="message" onclick="this.style.height='."'40px'".'; $('."'#update_button'".').show();" style="width:98.5%; height:40px; resize: none;" placeholder="Whats on your mind?" cols="40"></textarea><br/><div id="update_button" style="display:none;float:right;margin-right: 5px;"><input style ="margin-bottom: 10px;" onClick="addPost();" type="button" value="Post" class="btn btn-primary"></div><br/><div style="clear:both"></div></div>';
    $upload_frame = "<div class='well'><form id='imageform' method='POST' enctype='multipart/form-data' action='".Yii::app()->baseUrl."/index.php/user/newpic'>Upload your image <input type='file' name='photoimg' id='photoimg' /></form></div>";
    
    
    $this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'Status', 'content'=>$status_frame, 'active'=>true),
        array('label'=>'Photo', 'content'=>$upload_frame),
       
        
    ),
    'htmlOptions'=>array('style'=>'height:auto;font-weight:bold'),
    )); 
    */
    ?>
         
    <div class="well">
        <!--<textarea id ="message" name="message" onfocus="$('#buttonBox').show();"  style="width:98.5%; resize: none;" placeholder="What's on your mind?" cols="40"></textarea><br/>-->
        <div id="message" contenteditable="true"  onfocus="$('#buttonBox').show();" style="background-color: white;padding:5px;border-radius: 5px;width:98.5%;height:50px;border:solid 2px #333;font-family:Arial, Helvetica, sans-serif;font-size:14px;margin-bottom:6px;text-align:left;"></div>
        <div id="display"></div>
        <div id="msgbox"></div>
        
        <div id="photoDiv" style="display:none">
        
        <form id='imageform'  method='POST' enctype='multipart/form-data' action='<?php echo Yii::app()->baseUrl."/index.php/user/newpic";?>'>
            <textarea id="image_message" name="image_message" style="height:50px;width:98.5%; resize: none;margin-top:0px;border:solid 2px #333" placeholder="Say something about this..." cols="40"></textarea>
            <br/><hr>
            <b>Select an image or video file on your computer.</b><br/>
            <input type='file' name='photoimg' id='photoimg' />
            <input id="tagFrnd"  type="hidden" name="tag" value="" />
        </form>
        
        </div>
        <div id="buttonBox" style="display:none">
            <div id="update_button" style="float:right;margin-right: 5px;"><input style ="margin-bottom: 10px;" onClick="addPost();" type="button" value="Post" class="btn btn-primary" id="postbtn"></div>
            <a href="javascript:void(0)" onclick="addPic()" id="image_button" class="label label-info">Add Photo / video</a>
            &nbsp;
            
            
        </div>
        <br/>
        <div style="clear:both"></div></div>
</div>

<hr style="width:70%">
<div class="shiftcontainer" style="width:70%" id="mainDiv">
    <div class="shadowcontainer">
        <div  id ="inner" class="innerdiv">
            <center><div id='loadingImage'></div></center>
             <div id='preview'></div>
            <?php 
           
            if ($posts){
                
            foreach ($posts as $p) { ?>
                <?php $userId = $p['user_id'];
                
                $user = UserProfile::model()->findByAttributes(array('user_id' => $userId));
                if (!empty($user->first_name)) {
                    $userName = ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
                } else {
                    $users = User::model()->findByPk($userId);
                    $userName = $users['username'];
                }
                $postTag=PostTagging::model()->findAll('post_id=:postId',array(':postId'=>$p['id']));
              if(!isset($p['page_id']))
              {      
                if(count($postTag) >0)
                { foreach($postTag as $pt):
                    if($pt->user_id==Yii::app()->user->userId)
                    {?>
                        <table id ="row_<?php echo $pt->post_id; ?>" class="well-for-table"  style="margin-bottom:15px">
                    <tr>
                        <?php if(!empty($user->image)){ ?>
                        <td><img height="50" width="50" src="<?php echo $this->geUserImage($user->user_id);?>"/></td>
                        <?php } ?>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        
                        <td style="width:100%;">
                            
                            <p>
                                <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$user->user_id; ?>"><?php echo "<u>".ucfirst($userName)."</u>";?></a></b><span style="float:right; font-size: 10px;margin-right:3px;"><?php echo $this->checkTime($p['date']);?></span><br />
                                
                                <?php echo $p['message']; ?><br/>
                                <?php if(!empty($p['image'])){ $Image=explode('.',$p["image"]);if($Image[1]!='mp4') {?><img src="<?php echo Yii::app()->baseUrl.'/uploads/'.$p['id'].'_'.$p['image'];?>" style="height:150px;width:150px"/><?php } else { echo "<div id='mediaplayer_".$p['id']."'></div><script type='text/javascript'>jwplayer('mediaplayer_".$p['id']."').setup({'flashplayer': '".Yii::app()->baseUrl."/js/jwplayer/player.swf','skin':'".Yii::app()->baseUrl."/js/jwplayer/bekle.zip','id': 'playerID','width': '400','height': '300','file': '".Yii::app()->baseUrl."/uploads/".$p['id'].'_'.$p['image']."', 'controlbar.position':'over'});</script>"; } } ?>
                                
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td>
                            <?php $like = LikePost::model()->find('post_id=:post_id AND user_id=:user_id',array('post_id' => $pt->post_id, 'user_id' => Yii::app()->user->userId));
                            
                            if (!$like) { ?>
                            <span id="like_<?php echo $pt->post_id;?>"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postLike(<?php echo $pt->post_id;?>,<?php echo "'post'";?>)">LIKE</a></span>
                            <?php } else { ?>
                            <span id="like_<?php echo $pt->post_id;?>"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postUnlike(<?php echo $pt->post_id;?>,<?php echo "'post'";?>)">UNLIKE</a></span>
                            <?php } ?>
                            &nbsp;&nbsp;<i class="icon-comment"></i><a href="javascript:void(0)" onclick="$('#comment_t'+<?php echo $pt->post_id;?>).show();">COMMENT</a>&nbsp;&nbsp;<i class="icon-share"></i><a href="javascript:void(0)" onclick="postShare(<?php echo $pt->post_id;?>)">SHARE</a>&nbsp;&nbsp;<i class="icon-eye-open"></i><a href="#">WATCH</a>&nbsp;&nbsp;<span style ="float:right;color:#005580;font-style:normal"id ="no-of-likes_<?php echo $pt->post_id;?>"><b><?php echo count($like); ?></b> people like this </span>
                            <?php if ($p['user_id']==Yii::app()->user->userId){ ?>
                            <span id="del_<?php echo $pt->post_id;?>"><i class="icon-eye-open"></i><a href="javascript:void(0)" onclick="deletePost(<?php echo $pt->post_id;?>)">DELETE</a></span></td>
                            <?php } ?>
                        
                    </tr>
                   
                    <?php $comments = CommentPost::model()->findAll(array('select' => '*',
                'condition' => "post_id = $pt->post_id",
                'order' => 'id ASC',
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
                    <tr id="comment_<?php echo $c->id;?>">
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td><td>
                        <table class="well-for-table well-for-table1" style="width:100%">
                            <tr onmouseover="$('#img_<?php echo $c->id;?>').show()" onmouseout="$('#img_<?php echo $c->id;?>').hide()">
                        <?php if(!empty($user1->image)){ ?>
                        <td><img height="50" width="50" src="<?php echo $this->geUserImage($user1->user_id);?>"/></td>
                        <?php } ?>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td style="width:100%;">
                            <p>
                                <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$c->user_id; ?>"><?php echo "<u>".ucfirst($userName1)."</u>";?></a></b>
                                <?php if($c->user_id==Yii::app()->user->userId){ ?>
                                <a href="javascript:void(0)"><img id="img_<?php echo $c->id;?>" width="12" style="height:12px;float:right;margin-right: 5px;margin-top: 25px;display:none;" src="<?php echo Yii::app()->baseUrl.'/images/delete.png';?>" onclick="deleteComment(<?php echo $c->id;?>,<?php echo "'post'";?>)"/></a>
                                <?php } ?>
                                <br /><?php echo $c->comment; ?><br />
                                
                            </p>
                            <span style="margin-bottom:0px;float:right;margin-top: -45px;font-size: 10px"><?php echo $this->checkTime($c->date);?></span>
                        </td>
                    </tr>
                        </table>
                        </td>
                    </tr>
                    <?php }  } ?>
                    <tr style="display:none;" id="comment_t<?php echo $p['id'];?>"><td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td><td><textarea id="commenttext_<?php echo $p['id'];?>" style="width:98%; height:40px; resize: none;" placeholder="Enter your comment here..."></textarea><input style="float:right;margin-right:5px;" type="button" value="Comment" onclick="addComment(<?php echo $p['id'];?>,<?php echo "'post'";?>)"></td></tr>
                </table>
                   <?php }
                endforeach;}
                elseif($p['user_id']==Yii::app()->user->userId)
                {
                ?>
                <table id ="row_<?php echo $p['id']; ?>" class="well-for-table" style="margin-bottom:15px">
                    <tr>
                        <?php if(!empty($user->image)){ ?>
                        <td><img height="50" width="50" src="<?php echo $this->geUserImage($user->user_id);?>"/></td>
                        <?php } ?>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        
                        <td style="width:100%;">
                            
                            <p>
                                <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$user->user_id; ?>"><?php echo "<u>".ucfirst($userName)."</u>";?></a></b><span style="float:right; font-size: 10px;margin-right:3px;"><?php echo $this->checkTime($p['date']);?></span><br />
                                
                                <?php echo $p['message']; ?><br/>
                                <?php if(!empty($p['image'])){ $Image=explode('.',$p['image']);if($Image[1]!='mp4') {?><img style="height:150px;width:150px" src="<?php echo Yii::app()->baseUrl.'/uploads/'.$p['id'].'_'.$p['image'];?>" /><?php } else { echo "<div id='mediaplayer_".$p['id']."'></div><script type='text/javascript'>jwplayer('mediaplayer_".$p['id']."').setup({'flashplayer': '".Yii::app()->baseUrl."/js/jwplayer/player.swf','skin':'".Yii::app()->baseUrl."/js/jwplayer/bekle.zip','id': 'playerID','width': '400','height': '300','file': '".Yii::app()->baseUrl."/uploads/".$p['id'].'_'.$p['image']."', 'controlbar.position':'over'});</script>"; } } ?>
                                
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td>
                            <?php $like = LikePost::model()->find('post_id=:post_id AND user_id=:user_id',array('post_id' => $p['id'], 'user_id' => Yii::app()->user->userId));
                            if (!$like) { ?>
                            <span id="like_<?php echo $p['id'];?>"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postLike(<?php echo $p['id'];?>,<?php echo "'post'";?>)">LIKE</a></span>
                            <?php } else { ?>
                            <span id="like_<?php echo $p['id'];?>"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postUnlike(<?php echo $p['id'];?>,<?php echo "'post'";?>)">UNLIKE</a></span>
                            <?php } ?>
                            &nbsp;&nbsp;<i class="icon-comment"></i><a href="javascript:void(0)" onclick="$('#comment_t'+<?php echo $p['id'];?>).show();">COMMENT</a>&nbsp;&nbsp;<i class="icon-share"></i><a href="javascript:void(0)" onclick="postShare(<?php echo $p['id'];?>)">SHARE</a>&nbsp;&nbsp;<i class="icon-eye-open"></i><a href="#">WATCH</a>&nbsp;&nbsp;<i style ="float:right;color:#005580;font-style:normal"id ="no-of-likes_<?php echo $p['id'];?>"><b><?php echo count($like); ?></b> people like this </i>
                            <?php if ($p['user_id']==Yii::app()->user->userId){ ?>
                            <span id="del_<?php echo $p['id'];?>"><i class="icon-eye-open"></i><a href="javascript:void(0)" onclick="deletePost(<?php echo $p['id'];?>)">DELETE</a></span></td>
                            <?php } ?>
                    </tr>
                        
                <?php $comments = CommentPost::model()->findAll(array('select' => '*',
                'condition' => "post_id = {$p['id']}",
                'order' => 'id ASC',
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
                    <tr id="comment_<?php echo $c->id;?>">
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td><td>
                        <table class="well-for-table well-for-table1" style="width:100%">
                            <tr onmouseover="$('#img_<?php echo $c->id;?>').show()" onmouseout="$('#img_<?php echo $c->id;?>').hide()">
                        <?php if(!empty($user1->image)){ ?>
                        <td><img height="50" width="50" src="<?php echo $this->geUserImage($user1->user_id);?>"/></td>
                        <?php } ?>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td style="width:100%;">
                            <p>
                                <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$c->user_id; ?>"><?php echo "<u>".ucfirst($userName1)."</u>";?></a></b>
                                <?php if($c->user_id==Yii::app()->user->userId){ ?>
                                <a href="javascript:void(0)"><img id="img_<?php echo $c->id;?>" width="12" style="height:12px;float:right;margin-right: 5px;margin-top: 25px;display:none;" src="<?php echo Yii::app()->baseUrl.'/images/delete.png';?>" onclick="deleteComment(<?php echo $c->id;?>,<?php echo "'post'";?>)"/></a>
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
                    <tr style="display:none;" id="comment_t<?php echo $p['id'];?>"><td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td><td><textarea id="commenttext_<?php echo $p['id'];?>" style="width:98%; height:40px; resize: none;" placeholder="Enter your comment here..."></textarea><input style="float:right;margin-right:5px;" type="button" value="Comment" onclick="addComment(<?php echo $p['id'];?>,<?php echo "'post'";?>)"></td></tr>
                </table>
<?php }}

else
{               
                ?>
<!--business page post table-->

             <table id ="row_<?php echo $p['id']; ?>" class="well-for-table" style="margin-bottom:15px">
                    <tr>
                        <?php if(!empty($user->image)){ ?>
                        <td><img height="50" width="50" src="<?php echo $this->geUserImage($user->user_id);?>"/></td>
                        <?php } ?>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        
                        <td style="width:100%;">
                            
                            <p><?php $username=$p->user->userProfile->first_name.' '.$p->user->userProfile->last_name; ?>
                                <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$p['page']['user_id']; ?>"><?php echo "<u>".ucfirst($username)."</u>";?></a></b> posted on <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/businesspage/viewpage/'.$p['page_id']; ?>"><?php echo "<u>".ucfirst($p['page']['company_name'])."</u>";?></a></b><span style="float:right; font-size: 10px;margin-right:3px;"><?php echo $this->checkTime($p['date']);?></span><br />
                                
                                <?php echo $p['message']; ?><br/>
                                <!--<?php //if(!empty($p->image)){ $Image=explode('.',$p->image);if($Image[1]!='mp4') {?><img src="<?php //echo Yii::app()->baseUrl.'/uploads/'.$p->id.'_'.$p->image;?>" /><?php //} else { echo "<div id='mediaplayer_".$p->id."'></div><script type='text/javascript'>jwplayer('mediaplayer_".$p->id."').setup({'flashplayer': '".Yii::app()->baseUrl."/js/jwplayer/player.swf','skin':'".Yii::app()->baseUrl."/js/jwplayer/bekle.zip','id': 'playerID','width': '400','height': '300','file': '".Yii::app()->baseUrl."/uploads/".$p->id.'_'.$p->image."', 'controlbar.position':'over'});</script>"; } } ?>-->
                                
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td>
                            <?php $like = LikeBusinessPost::model()->find('post_id=:post_id AND user_id=:user_id',array('post_id' => $p['id'], 'user_id' => Yii::app()->user->userId));
                            if (!$like) { ?>
                            <span id="like_<?php echo $p['id'];?>"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postLike(<?php echo $p['id'];?>,<?php echo "'page'";?>)">LIKE</a></span>
                            <?php } else { ?>
                            <span id="like_<?php echo $p['id'];?>"><i class="icon-check"></i><a href="javascript:void(0)" onclick="postUnlike(<?php echo $p['id'];?>,<?php echo "'page'";?>)">UNLIKE</a></span>
                            <?php } ?>
                            &nbsp;&nbsp;<i class="icon-comment"></i><a href="javascript:void(0)" onclick="$('#comment_t'+<?php echo $p['id'];?>).show();">COMMENT</a>&nbsp;&nbsp;<i class="icon-share"></i><a href="javascript:void(0)" onclick="postShare(<?php echo $p['id'];?>)">SHARE</a>&nbsp;&nbsp;<i class="icon-eye-open"></i><a href="#">WATCH</a>&nbsp;&nbsp;<i style ="float:right;color:#005580;font-style:normal"id ="no-of-likes"><b></b> people like this </i>
                            <?php if ($p['user_id']==Yii::app()->user->userId){ ?>
                            <span id="del_<?php echo $p['id'];?>"><i class="icon-eye-open"></i><a href="javascript:void(0)" onclick="deletePost(<?php echo $p['id'];?>)">DELETE</a></span></td>
                            <?php } ?>
                        </tr>
                        
                    <?php $comments1 = CommentBussinessPage::model()->findAll(array('select' => '*','condition' => "post_id = {$p['id']}",'order' => 'id ASC'));
                    
                    if ($comments1){
                    foreach ($comments1 as $c){
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
                    <tr id="comment_<?php echo $c->id;?>">
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td><td>
                        <table class="well-for-table well-for-table1" style="width:100%">
                            <tr onmouseover="$('#img_<?php echo $c->id;?>').show()" onmouseout="$('#img_<?php echo $c->id;?>').hide()">
                        <?php if(!empty($user1->image)){ ?>
                        <td><img height="50" width="50" src="<?php echo $this->geUserImage($user1->user_id);?>"/></td>
                        <?php } ?>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td style="width:100%;">
                            <p>
                                <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$c->user_id; ?>"><?php echo "<u>".ucfirst($userName1)."</u>";?></a></b>
                                <?php if($c->user_id==Yii::app()->user->userId){ ?>
                                <a href="javascript:void(0)"><img id="img_<?php echo $c->id;?>" width="12" style="height:12px;float:right;margin-right: 5px;margin-top: 25px;display:none;" src="<?php echo Yii::app()->baseUrl.'/images/delete.png';?>" onclick="deleteComment(<?php echo $c->id;?>,<?php echo "'page'";?>)"/></a>
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
                    <tr style="display:none;" id="comment_t<?php echo $p['id'];?>"><td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td><td><textarea id="commenttext_<?php echo $p['id'];?>" style="width:98%; height:40px; resize: none;" placeholder="Enter your comment here..."></textarea><input style="float:right;margin-right:5px;" type="button" value="Comment" onclick="addComment(<?php echo $p['id'];?>,<?php echo "'page'";?>)"></td></tr>
                </table>
<?php }


} } else { ?>
                    No recent posts...
                    <?php } ?>
        </div>
    </div>
    
</div>
