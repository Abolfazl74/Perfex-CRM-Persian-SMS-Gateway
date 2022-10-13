<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<h4><?php echo _l(STUXAN_PARSGREEN_MODULE_NAME).' '._l('stuxan_parsgreen_settings_validate'); ?></h4>
<hr/>
<?php if((get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activated') == 'true') && (get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activation_code')!='')){?>
	<span><?php echo _l('stuxan_parsgreen_settings_activated_info');?> <a href="<?php echo  admin_url('settings?group=sms')?>"><?php echo _l('settings') ?></a></span>
<br></br>
<div class="row" id="stuxan_parsgreen_deactivate_wrapper" data-wait-text="<?php echo '<i class=\'fa fa-spinner fa-pulse\'></i> '._l('wait_text'); ?>" data-original-text="<?php echo _l('stuxan_parsgreen_settings_validate'); ?>">
<div class="col-md-9" id="stuxan_parsgreen_deactivate_wrapper">
<span><?php echo render_input('settings['.STUXAN_PARSGREEN_MODULE_NAME.'_activation_code]','stuxan_parsgreen_settings_activation_code_numero',get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activation_code'),'text',array('data-toggle'=>'tooltip','data-title'=>_l('stuxan_parsgreen_settings_activation_code_numero'),'readonly'=>'true'));?></a></span>
</a></span>
</div>
</div>
<?php }else{?>

<div class="row" id="stuxan_parsgreen_validate_wrapper" data-wait-text="<?php echo '<i class=\'fa fa-spinner fa-pulse\'></i> '._l('wait_text'); ?>" data-original-text="<?php echo _l('stuxan_parsgreen_settings_validate'); ?>">
	<div class="col-md-9">
		<i class="fa fa-question-circle pull-left" data-toggle="tooltip" data-title="<?php echo _l('stuxan_parsgreen_settings_purchase_code_help'); ?>"></i>
		<?php echo render_input('settings['.STUXAN_PARSGREEN_MODULE_NAME.'_activation_code]','stuxan_parsgreen_settings_activation_code',get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activation_code'),'text',array('data-toggle'=>'tooltip','data-title'=>_l('stuxan_parsgreen_settings_purchase_code_help'),'maxlength'=>60));
			echo form_hidden('settings['.STUXAN_PARSGREEN_MODULE_NAME.'_activated]',get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activated'));			?>
		<span><a target="_blank" href="mailto::ashiyan3@gmail.com"><?php echo _l('setup_help'); ?></a></span>
	</div>
	<div class="col-md-3 mtop25">
		<button id="stuxan_parsgreen_validate" class="btn btn-success"><?php echo _l('stuxan_parsgreen_settings_validate');?></button>
	</div>
	<div class="col-md-12" id="stuxan_parsgreen_validate_messages" class="mtop25 text-left"></div>
</div>
<?php 
} ?>