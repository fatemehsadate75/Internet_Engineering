<?php
 if($this->licenseCheck()['status'] == 'true') { if (!class_exists('jDateTime')) { include_once('jDateTime.php'); } $licenseexpiretime = jDateTime::date('Y/m/d H:i', $this->license['expiretime'], null, true,null); $fields_form_prepared = array( 'form' => array( 'legend' => array( 'title' => $this->l('Prepared Texts').' - <span class="license-expiretime">لایسنس این بخش تا این تاریخ معتبر است: '.$licenseexpiretime.'</span>', 'icon' => 'icon-edit' ), 'input' => array( array( 'type' => 'textarea', 'label' => $this->l('Text message:'), 'name' => 'preparedSmsText', 'class' => '', 'desc' => $this->l('Variables:').' {firstname} {lastname} {shop_name} {order_id} {order_reference} {payment} {total_paid} {invoice}', ), ), 'submit' => array( 'title' => $this->l('Save'), 'name' => 'preparedsms', ) ) ); $output .= $helper->generateForm(array($fields_form_prepared)); $preparedsmstexts = $this->getAllPreparedSMSText(); $output .= '<div class="panel" id="fieldset_preparedsms">
		<div class="panel-heading">
		<i class="icon-list"></i>
		'.$this->l('Prepared SMS').'
		</div>'; if(count($preparedsmstexts)) { $output .='<table class="data-table sorted_table">
					<thead>
						<tr>
							<th class="text">'.$this->l('Text').'</th>
							<th class="actions">'.$this->l('Actions').'</th>
						</tr>
					</thead>
					<tbody>'; foreach ($preparedsmstexts as $preparedsmstext) { $output .= '<tr data-id="'.$preparedsmstext['id'].'" data-weight="'.$preparedsmstext['weight'].'">
						<td class="text">'.$preparedsmstext['text'].'</td>
						<td class="actions">
							<a class="delete" data-action="deletePreparedSmsText" title="'.$this->l('Remove').'" data-textID="'.$preparedsmstext['id'].'"><i class="icon-remove"></i></a>	
							<a class="edit" data-action="editPreparedSmsText" title="'.$this->l('Edit').'" data-textID="'.$preparedsmstext['id'].'"><i class="icon-edit"></i></a>
						</td>
					</tr>'; } $output .= '</tbody>
					<!--<tfoot>
						<tr>
							<th colspan="9">Next</th>
						</tr>
					</tfoot>-->
				</table>
				<div class="sorted_table_save alert alert-warning">برای تغییر ترتیب قرارگیری پیامک های پیش فرض در لیست های موجود در افزونه روی یک سطر جدول بالا کلیک کرده و بالا یا پایین بکشید.
				</div>'; } else { $output .= '<p>'.$this->l('There is not any prepared text.').'</p>'; } $output .= '</div>
		<div class="modal fade" id="rangineModal">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close modal-clear" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title"></h4>
			  </div>
			  <div class="modal-body">
				<center><span class="loader"></span></center>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default modal-clear" data-dismiss="modal">'.$this->l('Close').'</button>
				
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->'; $output .= '<script type="text/javascript" src="//'.$this->domain.'/modules/ranginesmspresta/views/js/jquery-sortable.js"></script>'; }else{ $output .= $this->licenseForm(); }