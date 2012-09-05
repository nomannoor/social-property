<?php 

$model = SubPage::model()->with('page')->findByPk($id);  ?>

<div class="well" style=" float:left;margin-left:20px; margin-top: 0px; width: 250px; height: auto;">

    <a href="#" class="thumbnail" rel="tooltip" data-title="<?php echo $model['page']['company_name']; ?>" data-original-title="">
        <img src="<?php echo Yii::app()->baseUrl?>/uploads/business_page_<?php echo $model['page']['user_id'].'/'.$model['page']['image']; ?>" alt="">    </a>
    <table class="table">
        <tbody><tr>
            <td> 

            </td>
        </tr>
                <tr>
            <td>Subpage Name</td><td><?php echo $model['name']; ?></td>
        </tr>                <tr>
            <td>Domain</td><td><?php echo $model['domain']; ?></td>
        </tr>        <tr>
            <td>Description</td><td><?php echo $model['description']; ?></td>
        </tr>
        
         

    </tbody></table>
            <?php if($model['page']['user_id']==Yii::app()->user->userId){?><center><a class="btn btn-success" href="<?php echo Yii::app()->baseUrl.'/index.php/subpage/create/'.$model->id?>">Edit Page</a></center><?php }?>
    </div>