	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.zxxbox.3.0.js"></script>
	<script type="text/javascript" rel="stylesheet" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.form.js"></script>
<style>
.inbox_pager {
	width:100%;
	height:30px;
    padding-top: 15px;
    text-align: center;
    clear:both;
}
</style>
<div style="border:0px solid red;width:950px;overflow:hidden;">
	<div class="menu_div">
		<div id="menu_dashboard" style="float:left;" class="menu_li_selected"><img src="/images/menu_dashboard.png" /></div>
		<div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		<div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	</div>
	
	<div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">
		<?php echo $this->renderPartial('_Rleft', array('model'=>$model,'modelEmail'=>$modelEmail,'hidden_to_uid'=>$hidden_to_uid)); ?>
		<div style="float: right;border:0px solid red;width:76%;overflow:hidden;margin:0 auto;padding-TOP:10px;">
			 <div style="float: left;width:98%;margin-left:10px;">
				<div id="r_index" class="rindex_right_list_2"><div><img src="/images/rindex_right_list_1.png" /></div></div>
				<div id="r_nonlisting" class="rindex_right_nonlisting_2"><div><img src="/images/rindex_right_nonlist_1.png" /></div></div>
				<div id="r_contact" class="rindex_right_contact_2"><div><img src="/images/rindex_right_contact_1.png" /></div></div>
				<div id="r_prospects" class="rindex_right_prospects_1"><div><img src="/images/rindex_right_prospects_2.png" /></div></div>
			</div>
			<div class="clear"></div>
			<div style="float: right;">
<form id="UpLoadForm" name="UpLoadForm" action='/user/uploadcsv' method="post" enctype='multipart/form-data'>
	<div style="float:left;margin-top:10px;">
		<div class="" style="position: relative; overflow: hidden;float:left">
			<img src="/images/upload_prospects.png" />
			<input type="file" multiple="multiple" id="file_csv" name="file_csv" 
		 		style="position: absolute; right: 0px; top: 0px; font-family: Arial;
				 font-size: 118px; margin: 0px; padding: 3px; cursor: pointer; opacity: 0;">
				<img src="/images/loading_1.gif"  style="display:none;margin:10px;" id="div_loading" />
		</div>
	</div>
</form>
			</div>
			<div class="clear"></div>
			<div id="r_index_content" style="float: left;width:98%;margin-left:10px;">
					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'dataProvider'=>$dataProvider,
						'columns'=>array(
array(
		'selectableRows' => 2,
		'footer' => '<button type="button" onclick="GetCheckbox();" style="width:76px;">delete</button>',
		'class' => 'CCheckBoxColumn',
		'headerHtmlOptions' => array('width'=>'33px'),
		'checkBoxHtmlOptions' => array('name' => 'selectdel[]','style'=>'margin-left:33px;'),
),
									array(
										'name'=>'first_name','type'=>'raw','value'=>'CHtml::link("$data->first_name","/user/rprospectsedit?id=".$data->uid)','htmlOptions'=>array('style'=>'width:120px;word-wrap:break-word; word-break:break-all;'),
									),
									array(
											'name'=>'last_name','type'=>'raw','value'=>'CHtml::link("$data->last_name","/user/rprospectsedit?id=".$data->uid)','htmlOptions'=>array('style'=>'width:120px;word-wrap:break-word; word-break:break-all;'),
									),
									array(
											'name'=>'email_1','type'=>'raw','value'=>'CHtml::link("$data->email_1","/user/rprospectsedit?id=".$data->uid)','htmlOptions'=>array('style'=>'width:180px;word-wrap:break-word; word-break:break-all;'),
									),
									array(
											'name'=>'mobile','type'=>'raw','value'=>'CHtml::link("$data->mobile","/user/rprospectsedit?id=".$data->uid)','htmlOptions'=>array('style'=>'width:150px;word-wrap:break-word; word-break:break-all;'),
									),

								),
						'pagerCssClass'=>'inbox_pager',
						'template'=>'{items}{summary}{pager}',
						'pager'=>array('header'=>'',),
					)); ?>
			</div>
		</div>
	</div>
	
</div>
<script>
	var GetCheckbox = function (){
		var data=new Array();
		$("input:checkbox[name='selectdel[]']").each(function ()
		{
			if($(this).attr("checked"))
			{
				data.push($(this).val());
			}
		});
		if(data.length > 0) 
		{
			$.post('<?php echo CHtml::normalizeUrl(array('/user/rprospectsdel/'));?>',{'selectdel[]':data}, function (data) {
				//if (data == 1) 
					$.fn.yiiGridView.update('yw0');
			});
		}else{
			alert("Please select");
		}
	}
	
$(function() {
	$("#r_index").click(function(){location.href="/user/rindex";});
	$("#r_contact").click(function(){location.href="/user/rcontact";});
	$("#r_nonlisting").click(function(){location.href="/user/rnonlisting";});
	$("#r_prospects").click(function(){location.href="/user/rprospects";});
	
	//$("#file_csv").click(function(){});
	$("#file_csv").change(function(){
		$("#div_loading").show();
		$('#UpLoadForm').ajaxSubmit({
            success: function (html, status) {
            	$("#div_loading").hide();
            	alert(html);
            	window.location.reload();
            }
        });
	});
});
</script>