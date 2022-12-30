<div class="col-lg-12">
	<div class="panel" id="ordersendsms">
		<div class="panel-heading">
			<i class="icon-mobile-phone"></i> {l s='Send sms to customer.' mod='ranginesmspresta'}
		</div>
		<div class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-lg-3">{l s='Select a prepared Text.' mod='ranginesmspresta'}</label>
				<div class="col-lg-9">{$preparedsmstexts}</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">{l s='The customer phone.' mod='ranginesmspresta'}</label>
				<div class="col-lg-9"><input class="form-control" id="smsphonenumber" value="{$phone}" /></div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-3">{l s='Text message:' mod='ranginesmspresta'}</label>
				<div class="col-lg-9">
					<textarea id="txt_sms" class="textarea-autosize" name="smstext" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 65px;"></textarea>
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
					{$orderLastSms}
				</tbody>
			</table>
		</div>
	</div>
</div>