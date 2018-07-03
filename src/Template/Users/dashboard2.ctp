<div class="row" style=" border-bottom: solid 1px #e5e5e5; margin-bottom: 10px; ">
	<div class="col-md-3">
		<span id="BackToTables" style="display:none;font-weight: bold;" ><i class="fa fa-chevron-left"></i> Tables </span>
	</div>
	<div class="col-md-6" align="center">
		<span id="TablesHeading" style="font-weight: bold;" > TABLES </span>
		<span id="KOTHeading" style="display:none;font-weight: bold;" ><span>CREATE KOT FOR TABLE :</span> <span id="tableOutput"></span> <input type="hidden"  id="tableInput" /></span>
	</div>
</div>
<div class="row TableView">
	<div class="col-md-12">
		<?php foreach($Tables as $Table){ ?>
		<div class="tblBox" table_id="<?= h($Table->id) ?>" table_name="<?= h($Table->name) ?>">
			<div align="center" style="border-bottom:solid 1px #f27466;color: #FFF;background-color: #f27466;"><?= h($Table->name) ?></div>
			<div style="font-size:10px;background-color: #f1f1f178;">
				<div style="padding:2px;">
				<table width="100%">
					<tr>
						<th valign="top">STEWARD </th>
						<th valign="top"> :</th>
						<td valign="top">KISHAN SHARMA</td>
					</tr>
					<tr>
						<th valign="top">RUNNING BILL AMOUNT </th>
						<th valign="top"> :</th>
						<td valign="top">1559</td>
					</tr>
				</table>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<div class="row KOTView" style="display: none;">
	<div class="col-md-12">
		<table width="100%">
			<tr>
				<td valign="top" width="50%">
					<table width="100%">
						<tr>
							<td id="ItemArea" style="padding-bottom: 5px; border-bottom: solid 1px #CCC;height: 300px;" valign="top"></td>
						</tr>
						<tr>
							<td id="SubCategoryArea" style="padding-top: 5px;padding-bottom: 5px; border-bottom: solid 1px #CCC;" valign="top"></td>
						</tr>
						<tr>
							<td id="CategoryArea" style="padding-top: 5px; " valign="top"></td>
						</tr>
					</table>
					<div>
						<?php foreach($ItemCategories as $ItemCategory){ ?>
							<div class="ItemCategoryBox" category_id="<?= h($ItemCategory->id) ?>" >
								<?= h($ItemCategory->name) ?>
							</div>
							
							<div  category_id="<?= h($ItemCategory->id) ?>">
							<?php foreach($ItemCategory->item_sub_categories as $item_sub_category){ ?>
								<div class="ItemSubCategoryBox" category_id="<?= h($ItemCategory->id) ?>" sub_category_id="<?= h($item_sub_category->id) ?>" >
									<?= h($item_sub_category->name) ?>
								</div>
								
								<div  sub_category_id="<?= h($item_sub_category->id) ?>">
								<?php foreach($item_sub_category->items as $item){ ?>
									<div class="ItemBox" sub_category_id="<?= h($item_sub_category->id) ?>" item_id="<?= h($item->id) ?>" item_name="<?= h($item->name) ?>" rate="<?= h($item->rate) ?>" >
										<?= h($item->name) ?>
									</div>
								<?php } ?>
								</div>
							<?php } ?>
							</div>
							
						<?php } ?>
					</div>
				</td>
				<td valign="top" width="50%">
					<div>Search Item Area</div>
					<div style="height:200px;overflow: auto;">
						<table class="table table-condensed table-striped table-hover" id="kotBox">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Qty</th>
									<th>Rate</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
							
							</tbody>
						</table>
					</div>
					<div align="right">
						<a href="#" class="btn btn-sm bg-grey-gallery"><i class="fa fa-comment-o"></i> KOT COMMENT </a>
						<a href="#" class="btn btn-sm bg-grey-gallery CreateKOT" ><i class="fa fa-plus"></i> CREATE KOT </a>
					</div>
					<br/>
					<div align="right">
						<a href="#" class="btn btn-sm bg-grey-gallery CreateBill" ><i class="fa fa-money"></i> CREATE BILL </a>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
<style>
.tblBox{
	width: 210px; border: solid 2px #f27466; float: left;margin: 5px 5px;
}
.tblBox:hover{
	cursor: pointer;background-color: #ffcfcc;
}
.ItemCategoryBox, .ItemSubCategoryBox, .ItemBox{
    width: 100px;
    border: solid 1px;
    float: left;
    font-size: 12px;
    min-height: 40px;
	margin: 3px;
	cursor: pointer;
}
.active{
	background-color: #f26e68;
    color: #FFF;
}
#BackToTables{
	color: #f16969;
	font-size: 15px;
	cursor: pointer
}
#TablesHeading, #KOTHeading{
	color: #f16969;
	font-size: 16px;
}
#billTable{
	tr td{
		padding:2px;
	}
}
</style>
<?php echo $this->Html->css('/assets/animate.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
<?php
	$waitingMessage='<div align=center><br/><i class="fa fa-gear fa-spin" style="font-size:50px"></i><br/><span style="font-size: 18px; font-weight: bold;">Submitting...</span></div>';
	$waitingMessage2='<div align=center><br/><i class="fa fa-gear fa-spin" style="font-size:50px"></i><br/><span style="font-size: 18px; font-weight: bold;">Loading...</span></div>';
	$successMessage='<div align=center><br/><span aria-hidden=true class=icon-check style="font-size:50px;color: #096609; font-weight: bold;"></span><br/><span style="font-size: 18px; color: #096609; font-weight: bold;">KOT Created</span><div><button type="button" class="btn btn-primary closePopup">Close</button></div></div>';
	$BillSuccessMessage='<div align=center><br/><span aria-hidden=true class=icon-check style="font-size:50px;color: #096609; font-weight: bold;"></span><br/><span style="font-size: 18px; color: #096609; font-weight: bold;">Bill Created</span><div><button type="button" class="btn btn-primary closePopup">Close</button></div></div>';
	$errorMessage='<div align=center><br/><span aria-hidden=true class=icon-close style="font-size:50px;color: #ae0808; font-weight: bold;"></span><br/><span style="font-size: 18px; color: #ae0808; font-weight: bold;">Something went wrong.</span><div><button type="button" class="btn btn-primary closePopup">Close</button></div></div>';
	$js="
	$(document).ready(function() {
		$('#BackToTables').die().live('click',function(event){
			$('.TableView').show().addClass('animated bounceInDown');
			$('#BackToTables').hide();
			$('#TablesHeading').show();
			$('#KOTHeading').hide();
			$('.KOTView').removeClass('animated bounceInDown').hide();
		});
		
		$('.tblBox').die().live('click',function(event){
			var table_id=$(this).attr('table_id');
			var table_name=$(this).attr('table_name');
			$('.TableView').hide();
			$('#BackToTables').show();
			$('#TablesHeading').hide();
			$('#KOTHeading').show();
			$('.KOTView').show().addClass('animated bounceInDown');
			$('#tableInput').val(table_id);
			$('#tableOutput').text(table_name);
		});
		
		var q=$('.ItemCategoryBox').clone();
		$('.ItemCategoryBox').remove();
		$('#CategoryArea').html(q);
		var q=$('.ItemSubCategoryBox').clone();
		$('.ItemSubCategoryBox').remove();
		$('#SubCategoryArea').html(q);
		var q=$('.ItemBox').clone();
		$('.ItemBox').remove();
		$('#ItemArea').html(q);
		
		$('.ItemSubCategoryBox').hide();
		$('.ItemBox').hide();
		
		$('#CategoryArea .ItemCategoryBox').first().show().addClass('active');
		var category_id=$('#CategoryArea .ItemCategoryBox').first().attr('category_id');
		$('.ItemSubCategoryBox[category_id='+category_id+']').show();
		var sub_category_id=$('#SubCategoryArea .ItemSubCategoryBox[category_id='+category_id+']').first().attr('sub_category_id');
		$('#SubCategoryArea .ItemSubCategoryBox[category_id='+category_id+']').first().addClass('active');
		$('.ItemBox[sub_category_id='+sub_category_id+']').show();
		
		$('.ItemCategoryBox').die().live('click',function(event){
			$('.ItemCategoryBox').removeClass('active');
			$(this).addClass('active');
			var category_id=$(this).attr('category_id');
			$('.ItemSubCategoryBox').hide();
			$('.ItemSubCategoryBox[category_id='+category_id+']').show();
		});
		$('.ItemSubCategoryBox').die().live('click',function(event){
			$('.ItemSubCategoryBox').removeClass('active');
			$(this).addClass('active');
			var sub_category_id=$(this).attr('sub_category_id');
			$('.ItemBox').hide();
			$('.ItemBox[sub_category_id='+sub_category_id+']').show();
		});
		
		
		$('.ItemBox').die().live('click',function(event){
			var item_id=$(this).attr('item_id');
			var item_name=$(this).attr('item_name');
			var rate=$(this).attr('rate');
			var c=$('#kotBox tbody tr').length;
			c=c+1;
			$('#kotBox').append('<tr><td>'+c+'</td><td item_id='+item_id+'>'+item_name+'</td><td><span>1</span></td><td>'+rate+'</td><td>'+rate+'</td></tr>');
		});
		
		$('.closePopup').die().live('click',function(event){
			$('#WaitBox').hide();
		});
		
		$('.CreateKOT').die().live('click',function(event){
			event.preventDefault();
			$('#WaitBox').show();
			$('#WaitBox div.modal-body').html('".$waitingMessage."');
			var postData=[];
			$('#kotBox tbody tr').each(function(){
				var item_id=$(this).find('td:nth-child(2)').attr('item_id');
				var quantity=$(this).find('td:nth-child(3)').text();
				var rate=$(this).find('td:nth-child(4)').text();
				var amount=$(this).find('td:nth-child(5)').text();
				postData.push({item_id : item_id, quantity : quantity, rate : rate, amount : amount}); 
			});
			var table_id=$('#tableInput').val();
			var myJSON = JSON.stringify(postData);
			var url='".$this->Url->build(['controller'=>'Kots','action'=>'add'])."';
			url=url+'?myJSON='+myJSON+'&table_id='+table_id;
			$.ajax({
				url: url,
			}).done(function(response) {
				if(response=='1'){
					$('#kotBox tbody tr').remove();
					$('#WaitBox div.modal-body').html('".$successMessage."');
				}else{
					$('#WaitBox div.modal-body').html('".$errorMessage."');
				}
				
			});
		});
		
		$('.CreateBill').die().live('click',function(event){
			event.preventDefault();
			var table_id=$('#tableInput').val();
			$('#WaitBox').show();
			$('#WaitBox div.modal-body').html('".$waitingMessage2."');
			var url='".$this->Url->build(['controller'=>'Kots','action'=>'view'])."';
			url=url+'?table_id='+table_id;
			$.ajax({
				url: url,
			}).done(function(response) {
				$('#WaitBox div.modal-body').html(response);
			});
		});
		
		$('.CancelBill').die().live('click',function(event){
			event.preventDefault();
			$('#WaitBox').hide();
		});
		
		$('.SubmitBill').die().live('click',function(event){
			event.preventDefault();
			$('#WaitBox2').show();
			$('#WaitBox2 div.modal-body').html('".$waitingMessage."');
			var postData=[];
			$('#billTable tbody tr').each(function(){
				var item_id=$(this).find('td:nth-child(2)').attr('item_id');
				var quantity=$(this).find('td:nth-child(3)').text();
				var rate=$(this).find('td:nth-child(4)').text();
				var amount=$(this).find('td:nth-child(5)').text();
				var discount_per=$(this).find('td:nth-child(6) input').val();
				var net_amount=$(this).find('td:nth-child(7)').text();
				postData.push({item_id : item_id, quantity : quantity, rate : rate, amount : amount, discount_per : discount_per, net_amount : net_amount}); 
			});
			var table_id=$('#tableInput').val();
			var myJSON = JSON.stringify(postData);
			var url='".$this->Url->build(['controller'=>'Bills','action'=>'add'])."';
			url=url+'?myJSON='+myJSON+'&table_id='+table_id;
			console.log(url);
			$.ajax({
				url: url,
			}).done(function(bill_id) {
				if(bill_id!=0){
					$('#WaitBox2').hide();
					$('#WaitBox div.modal-body').html('".$BillSuccessMessage."');
					
					var url='".$this->Url->build(['controller'=>'Bills','action'=>'view'])."';
					url=url+'?bill_id='+bill_id;
					var w = window.open(url, 'popupWindow', 'scrollbars=yes');
				}else{
					$('#WaitBox div.modal-body').html('".$errorMessage."');
				}
				
			});
		});
		
		
	});	
	";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
?>

<div id="WaitBox" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>

<div id="WaitBox2" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>