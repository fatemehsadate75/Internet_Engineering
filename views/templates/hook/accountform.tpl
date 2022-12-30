<!-- MODULE RangineSmsPresta -->
<fieldset class="account_mobile_verify form-group">
	<h3 class="page-subheading">{l s='Mobile Verification' mod='ranginesmspresta'}</h3>
	<label for="mobilenumber">{l s='Your mobile number to get OTP' mod='ranginesmspresta'} :</label>
	<input type="text" class="form-control" id="mobilenumber" name="mobilenumber" value="{if isset($smarty.post.mobilenumber)}{$smarty.post.mobilenumber|escape:'html':'UTF-8'}{/if}" />
	<input type="button" id="mobilenumbersend" value="{l s='Verification' mod='ranginesmspresta'}" />
</fieldset>
{addJsDef ranginesmspresta_verification_url=$link->getModuleLink('ranginesmspresta','actions', ['process' => 'mobileverification'])}
<!-- END : MODULE RangineSmsPresta -->