{*
* 2007-2016 PrestaShop
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
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
* @author    PrestaShop SA <contact@prestashop.com>
* @copyright 2007-2016 PrestaShop SA
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
* International Registered Trademark & Property of PrestaShop SA
*}
<section id="ranginesmspresta" class="panel widget{if $allow_push} allow_push{/if}">
	<div class="panel-heading">
		<i class="icon-ranginesmspresta"></i> {l s='Rangine SMS Module' mod='ranginesmspresta'}
		<span class="panel-heading-action">
			<a class="list-toolbar-btn" href="#" onclick="refreshDashboard('ranginesmspresta'); return false;" title="{l s='Refresh' mod='ranginesmspresta'}">
				<i class="process-icon-refresh"></i>
			</a>
		</span>
	</div>
	<!--<section id="ranginesmspresta_config" class="dash_config hide">
		<header><i class="icon-wrench"></i> {l s='Configuration' mod='ranginesmspresta'}</header>
		
	</section>-->
	<section id="dash_state_header" class="loading">
		<header><i class="icon-bar-chart"></i> {l s='Panel State' mod='ranginesmspresta'}</header>
		<ul class="data_list">
			<li>
				<span class="data_label">{l s='Credit' mod='ranginesmspresta'}</span>
				<span class="data_value size_s">
					<span id="panel_credit"></span>
				</span>
			</li>
			<li>
				<span class="data_label">{l s='Panel Expire' mod='ranginesmspresta'}</span>
				<span class="data_value size_s">
					<span id="panel_expire"></span>
				</span>
			</li>
			<li>
				<span class="data_label">{l s='Update Time' mod='ranginesmspresta'}</span>
				<span class="data_value size_s">
					<span id="update_time"></span>
				</span>
			</li>
		</ul>
	</section>
	<section id="dash_state_header" class="loading">
		<header><i class="icon-bar-chart"></i> {l s='Module State' mod='ranginesmspresta'}</header>
		<ul class="data_list">
			<li>
				<span class="data_label">{l s='Module License' mod='ranginesmspresta'}</span>
				<span class="data_value size_s">
					<span id="module_license"></span>
				</span>
			</li>
		</ul>
	</section>
</section>