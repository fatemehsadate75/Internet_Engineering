<div class="col-lg-12">
	<div class="panel card" id="customersendsms" style="clear:both">
		<div class="panel-heading card-header">
			<i class="icon-mobile-phone"></i> {l s='Send sms to customer.' mod='ranginesmspresta'} 
			{if $trausted_rangine_phone != null}
			<span style="float: right;">{$trausted_rangine_phone} 
				{if $trausted_rangine_phone_status == 1}
					<i title="تأیید شده" class="icon-check"></i>
				{else}
					<i title="تأیید نشده" class="icon-close"></i>
				{/if}
				
			</span>
			{/if}
			
			
		</div>
		<div class="form-horizontal card-body">
			<div class="form-group">
				<label class="control-label col-lg-3">{l s='Select a prepared Text.' mod='ranginesmspresta'}</label>
				<div class="col-lg-9">{$preparedsmstexts}</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">{l s='The customer phone.' mod='ranginesmspresta'}</label>
				<div class="col-lg-9">
				{if $phoneoptions == ''}
					<input class="form-control" id="smsphonenumber" placeholder="{l s='Mobile number not found!' mod='ranginesmspresta'}" value=""/></div>
				{else}
					<select class="form-control" id="smsphonenumber"/>{$phoneoptions}</select></div>
				{/if}
			</div>

			<div class="form-group">
				<label class="control-label col-lg-3">{l s='Text message:' mod='ranginesmspresta'}</label>
				<div class="col-lg-9">
					<textarea id="txt_sms" class="textarea-autosize form-control" name="smstext" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 65px;"></textarea>
				</div>
			</div>
			<button id="sendsms" class="btn btn-primary pull-right" data-idshop="{$shop_id}" data-customerid="{$customer_id}">{l s='Send SMS' mod='ranginesmspresta'}</button>
			<div style="clear:both"></div>
			<hr/>
			<strong><a data-toggle="collapse" href="#usersmstable">{l s='Last sent SMS to the customer' mod='ranginesmspresta'}</a></strong>
			<table class="table panel-collapse collapse" id="usersmstable">
					<thead>
					<tr>
						<th><span class="title_box">{l s='BULK' mod='ranginesmspresta'}</span></th>
						<th><span class="title_box">{l s='PHONE' mod='ranginesmspresta'}</span></th>
						<th><span class="title_box">{l s='TIME' mod='ranginesmspresta'}</span></th>
						<th><span class="title_box">{l s='DESCRIPTION' mod='ranginesmspresta'}</span></th>
						<th><span class="title_box">{l s='STATUS' mod='ranginesmspresta'}</span></th>
						<th><span class="title_box">{l s='DELIVERY' mod='ranginesmspresta'}</span></th>
					</tr>
					</thead>
					<tbody>
						{$userLastSms}
					</tbody>
				</table>
		</div>
	</div>
</div>