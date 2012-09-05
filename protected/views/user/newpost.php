<script type="text/javascript">
function addPost()
    {
        /*$('.well-for-table:nth-child(1)').css('margin-top','80px');
        var message = $('#message').val();
        $.post('<?php echo Yii::app()->baseUrl."/index.php/user/updatePost/message/";?>'+message, 
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
        table +='&nbsp;&nbsp;<i class="icon-comment"></i><a href="javascript:void(0)" onclick="addComment('+obj.id+')">COMMENT</a>&nbsp;&nbsp;<i class="icon-share"></i>';
        table += '<a href="javascript:void(0)" onclick="postShare('+obj.id+')">SHARE</a>&nbsp;&nbsp;<i class="icon-eye-open"></i><a href="#">WATCH</a>&nbsp;&nbsp';
        table +='<span id = "del_'+obj.id+'"><i class="icon-eye-open"></i><a href="javascript:void(0)" onclick="deletePost('+obj.id+')">DELETE</a></span></td></tr>';
        
        
    //alert(table);
    $('#row_'+obj.id).fadeOut(5000);
    $('#inner').prepend(table);
            
    $('.well-for-table:nth-child(2)').css('margin-top','0px');        
            
            
            //$('.well-for-table').html('');
        }); */
        alert('asd');
        
    }
</script>
<textarea id ="message" name="message" onclick="this.style.height='40px'; $('#update_button').show();" style="width:98.5%; height:40px; resize: none;" placeholder="What's on your mind?" cols="40"></textarea>
        <br/>
        <div id="update_button" style="display:none;float:right;margin-right: 5px;">
            <input style ="margin-bottom: 10px;" onClick="addPost();" type="button" value="Post" class="btn btn-primary">
        </div>
        <br/>
        <div style="clear:both"></div>