<?php
function active_nonactive($val){
    $user = User::model()->findByPk($val);
 return $user['is_active'] == 1 ? 'Active' : 'Deactive';
}

?>
<?php



Yii::import('application.components.EImageColumn_user');
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $model->search(),
	'filter' => $model,
        'ajaxUpdate'=>true,
	'columns' => array(
                
            array(
            'class'=>'EImageColumn_user',
            'name' => "image",
            
            'htmlOptions' => array('style' => 'width: 50px;height:50px'),
            ),
            array(
			'name' => 'first_name',
			'type' => 'raw',
			//'value' => 'CHtml::link(CHtml::encode($data->title))',
                        'value' => 'CHtml::link($data->first_name, Yii::app()->createUrl("/user/viewprofile/" , array( "userId" => $data->user_id )))',
		),
		array(
			'name' => 'last_name',
			'type' => 'raw',
			'value' => 'CHtml::link($data->last_name, Yii::app()->createUrl("/user/viewprofile/" , array( "userId" => $data->user_id ) ))',
                        
                    
		),
          
           
            
             
            array(
                        'header'=>'Status',
			//'name' => 'Active',
			'type' => 'raw',
			'value' => 'active_nonactive($data->user_id)',
                        'filter'=> array(1=>'Active',0=>'Deactive'),
                         
		),
           
            array(
                        'class'=>'CButtonColumn',
                        'header'=>'Action',
                          'template'=>'{update}{view}{delete}',
                          'updateButtonUrl' => 'Yii::app()->createUrl("/admin/changestatus/" , array( "id" => $data->user_id ) )',  
                          'viewButtonUrl' => 'Yii::app()->createUrl("/user/viewprofile/" , array( "userId" => $data->user_id ) )',  
                          'deleteButtonUrl' => 'Yii::app()->createUrl("/admin/deleteuser/" , array( "id" => $data->user_id ) )',
                  ),
            
            ),
          
            
	
));
    


?>