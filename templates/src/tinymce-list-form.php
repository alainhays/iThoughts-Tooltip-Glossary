<?php

use \ithoughts\tooltip_glossary\Backbone as Backbone;
/**
 * @file Template file for TinyMCE "Insert a list" editor
 *
 * @author Gerkin
 * @copyright 2016 GerkinDevelopment
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @package ithoughts-tooltip-glossary
 *
 * @version 2.6.5
 */



if ( ! defined( 'ABSPATH' ) ) {
	 status_header( 403 );wp_die("Forbidden");// Exit if accessed directly
}

?>
<div id="ithoughts_tt_gl-list-form-container">
	<pre style="display:none;"><?php var_dump($data); ?></pre>
	<div id="pseudohead">
		<link rel="stylesheet" id="ithoughts_tt_gl-tinymce_form-css" href="<?php echo Backbone::get_instance()->get_resource('ithoughts_tooltip_glossary-tinymce_form-css')->get_file_url(); ?>" type="text/css" media="all">
		<script type="text/javascript" src="<?php echo Backbone::get_instance()->get_resource('ithoughts-simple-ajax-v5')->get_file_url(); ?>" defer></script>
		<script type="text/javascript" src="<?php echo Backbone::get_instance()->get_resource('ithoughts_tooltip_glossary-tinymce_form')->get_file_url(); ?>?v=3.0.1" defer></script>
		<!--<script>
iThoughtsTooltipGlossaryEditor.groups = <?php echo json_encode($groups); ?>;
</script>-->
		<script type="text/javascript" src="<?php echo Backbone::get_instance()->get_resource('ithoughts_tooltip_glossary-qtip')->get_file_url(); ?>" defer></script>
	</div>
	<div aria-label="<?php esc_html_e('Insert Glossary Index', 'ithoughts-tooltip-glossary'); ?>" role="dialog" style="border-width: 1px; z-index: 999999;" class="itg-panel itg-floatpanel itg-window itg-in" hidefocus="1" id="ithoughts_tt_gl-list-form">
		<div class="itg-reset" role="application">
			<div class="itg-window-head">
				<div class="itg-title">
					<?php esc_html_e('Insert Glossary Index', 'ithoughts-tooltip-glossary' ); ?>
				</div>
				<button aria-hidden="true" class="itg-close ithoughts_tt_gl-tinymce-discard" type="button">×</button>
			</div>


			<div class="itg-window-body">
				<div class="itg-form itg-first itg-last">
					<div class="" style="height: 100%;">







						<form>
							<div style="padding:10px;flex:0 0 auto;">
								<table>
									<tr>
										<td>
											<label for="letters">
												<?php echo apply_filters('ithoughts-tt-gl_tooltip', esc_html__("Letters", 'ithoughts-tooltip-glossary' ), esc_html__('Letters to be displayed in the list. If not specified, all letters will be displayed', 'ithoughts-tooltip-glossary' )); ?>
											</label>
										</td>
										<td>
											<?php echo $inputs["letters"]; ?>
										</td>
									</tr>
									<tr>
										<td>
											<label for="groups">
												<?php echo apply_filters('ithoughts-tt-gl_tooltip', esc_html__("Groups", 'ithoughts-tooltip-glossary' ), esc_html('Glossary group(s) to list. If empty, any groups will be displayed', 'ithoughts-tooltip-glossary' )); ?>
											</label>
										</td>
										<td>
											<?php echo $inputs["groups_text"]; ?>
											<?php echo $inputs["groups"]; ?>
											<div class="groupspicker" class="hidden">
												<div class="group-select" data-groupid="0">
													<input type="checkbox" <?php echo in_array(0, $data["group"]) ? "checked " : ""; ?> name="group_check" value="0" id="group_check_0">
													<label for="group_check_0" class="group-label">
														<span class="group-title"><em><?php esc_html_e('No group', 'ithoughts-tooltip-glossary'); ?></em></span>&nbsp;<span class="group-count">(<?php echo $no_groups ?>)</span>
													</label>
												</div>
												<?php
	foreach($groups as $group){
												?>
												<div class="group-select" data-groupid="<?php echo $group->term_id; ?>">
													<input type="checkbox" <?php echo in_array($group->term_id, $data["group"]) ? "checked " : ""; ?> name="group_check" value="<?php echo $group->term_id; ?>" id="group_check_<?php echo $group->term_id; ?>">
													<label for="group_check_<?php echo $group->term_id; ?>" class="group-label">
														<span class="group-title"><?php echo esc_html($group->name); ?></span>&nbsp;<span class="group-count">(<?php echo $group->count; ?>)</span>
													</label>
												</div>
												<?php
	}
												?>
											</div>
										</td>
									</tr>
								</table>
								<div class="tab-container">
									<ul class="tabs" role="tablist">
										<li class="<?php echo ("atoz" === $data['type']) ? "active" : ""; ?>" role="tab" tabindex="-1">
											<?php esc_html_e("A to Z", 'ithoughts-tooltip-glossary' ); ?>
										</li>


										<li class="<?php echo ("list" === $data['type']) ? "active" : ""; ?>" role="tab" tabindex="-1">
											<?php esc_html_e("List", 'ithoughts-tooltip-glossary' ); ?>
										</li>
										<li class="topLiner"></li>
									</ul>



									<div class="tab">
										<?php esc_html_e("No additionnal options", "ithoughts-tooltip-glossary"); ?>
									</div>
									<div class="tab">
										<table>
											<tr>
												<td>
													<label for="description_mode">
														<?php echo apply_filters('ithoughts-tt-gl_tooltip', __("Description", 'ithoughts-tooltip-glossary' ), __('Description mode: Full/Excerpt/None', 'ithoughts-tooltip-glossary' )); ?>
													</label>
												</td>
												<td>
													<?php echo $inputs["description_mode"]; ?>
												</td>
											</tr>
											<tr>
												<td>
													<label for="columns_count">
														<?php echo apply_filters('ithoughts-tt-gl_tooltip', esc_html__("Columns", 'ithoughts-tooltip-glossary' ), esc_html__('Number of columns to show for list', 'ithoughts-tooltip-glossary' )); ?>
													</label>
												</td>
												<td>
													<?php echo $inputs["columns_count"]; ?>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="itg-panel itg-foot" tabindex="-1" role="group">
				<div class="">
					<div class="itg-btn itg-primary itg-first itg-btn-has-text" tabindex="-1" role="button">
						<button role="presentation" type="button" tabindex="-1" style="height: 100%; width: 100%;" id="ithoughts_tt_gl-tinymce-validate">
							<?php esc_html_e('OK', 'ithoughts-tooltip-glossary'); ?>
						</button>
					</div>
					<div class="itg-btn itg-last itg-btn-has-text" tabindex="-1" role="button">
						<button role="presenation" type="button" tabindex="-1" style="height: 100%; width: 100%;" class="ithoughts_tt_gl-tinymce-discard">
							<?php esc_html_e('Cancel', 'ithoughts-tooltip-glossary'); ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div style="z-index: 100100;" class="itg-modal-block" class="itg-reset itg-fade itg-in">
	</div>
</div>
