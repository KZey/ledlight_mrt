 <div style="border:0px solid red;width:950px;overflow:hidden;">
	 <div class="menu_div">
		  <div id="menu_dashboard" style="float:left;" class="menu_li_selected"><img src="/images/menu_dashboard.png" /></div>
		  <div id="menu_property" style="float:left;" class="menu_li_default"><img src="/images/menu_property.png" /></div>
		  <div id="menu_realtor" style="float:left;" class="menu_li_default"><img src="/images/menu_realtor.png" /></div>
	 </div>
	 <div style="border:0px solid red;width:100%;overflow:hidden;margin:0 auto;margin-top:3px;z-index:1;">

	 	<div style="width:100%;overflow:hidden;margin:0 auto;">
			<div style="border:1px solid #C2C2C2;overflow:hidden;margin:0 auto;">
				<div style="width:100%;border-bottom:1px solid #C2C2C2;height:30px;background-image:url(/images/createproperty_title_bg.png);">
					<div style="padding:6px 0 0 10px;">Email Analytics</div>
				</div>
				<div style="border:0px solid red;overflow:hidden;padding:15px;background:#F7F7F7;">


	<div id='report_nav'><a href='/statemail/rindex'>Back</a></div>

<div class="clear"></div>
<div id="r_index_content" style="float: left;width:98%;margin-left:10px;">

		
<?php $this->widget('zii.widgets.grid.CGridView', array(
						'dataProvider'=>$dataProvider,
						'columns'=>array(
										array('name'=>'From','type'=>'raw','value'=>'$data["from_first_name"]'),
										array('name'=>'To','type'=>'raw','value'=>'$data["to_first_name"]'),
										array('name'=>'Send Date','type'=>'raw','value'=>'$data["send_date"]'),
										array(
												'header'=>"Action",
												'type'=>'raw',
												'value'=>'CHtml::link("View",array("/statemail/view/?id=".$data["id"]))',
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
</div>
</div>


<script>
	function showEmailInfo(aa)
	{
		alert(aa);
	}
</script>
