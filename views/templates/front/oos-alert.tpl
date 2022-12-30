{**
* 2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
*
*  @author    Hadi Mollaei <mr.hadimollaei@gmail.com>
*  @copyright 2020 Rangine.ir
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  @file is used for display header messages on module config page.
*}
<!-- MODULE ranginesmspresta -->
<script>
    ranginesmspresta_add_url='{$link->getModuleLink('ranginesmspresta','actions', ['process' => 'add'])}';
    ranginesmspresta_remove_url='{$link->getModuleLink('ranginesmspresta','actions', ['process' => 'remove'])}';
</script>
<div class="get-mobile-wrapper">
	<span>
		<i class="bell"></i>
		<span class="sms-alert-label" >
		{if $oosButtonText != ''}
			{$oosButtonText}
		{else}
			{l s='Notify me when available' mod='ranginesmspresta'}
		{/if}
		</span>
	</span>
</div>
<div id="ranginesmsoosalert" style="display:none;">
	<div class="sms-alert-content">
		<div class="sms-alert-header">
		<h4 class="sms-alert-title">
		{if $oosButtonText != ''}
			{$oosButtonText}
		{else}
			{l s='Notify me when available' mod='ranginesmspresta'}
		{/if}
		</h4>
		</div>
		<div class="sms-alert-body">
			<center>{l s='Send me a text message when it is available' mod='ranginesmspresta'}</center>
			<br>
			<input class="sms-alert-mobile-number form-control" placeholder="{l s='Send Number' mod='ranginesmspresta'}"/>
			<div class="massage"></div>
			<div class="button-wrapper"></div>
			<br>
		<span class="sms-alert-mobile-submit btn btn-primary"/>{l s='Send Number' mod='ranginesmspresta'}</span>
		<span class="sms-alert-mobile-cancel btn btn-primary"/>{l s='Cancel' mod='ranginesmspresta'}</span>
		</div>
		<div class="sms-alert-loading"><span class="sms-alert-loader"></span></div>
	</div>
	
</div>
{if $oosButtonPosition != '' && $oosButtonWrapper != ''}
<script>
	var oosButtonPosition = '{$oosButtonPosition}';
	var oosButtonWrapper = '{$oosButtonWrapper}';
</script>
{/if}
<!-- MODULE ranginesmspresta -->
