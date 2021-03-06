<?php

/**
 * @file Template file for options form
 *
 * @author Gerkin
 * @copyright 2016 GerkinDevelopment
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @package ithoughts-tooltip-glossary
 *
 * @version 2.5.0
 */



if ( ! defined( 'ABSPATH' ) ) {
	 status_header( 403 );wp_die("Forbidden");// Exit if accessed directly
}

?>
<div class="wrap">
	<div id="ithoughts-tooltip-glossary-options" class="meta-box meta-box-50 metabox-holder">
		<div class="meta-box-inside admin-help">
			<div class="icon32" id="icon-options-general">
				<br>
			</div>
			<h2><?php _e('Options', 'ithoughts-tooltip-glossary' ); ?></h2>
			<div id="dashboard-widgets-wrap">
				<div id="dashboard-widgets">
					<div id="normal-sortables" class=""><!--Old removed classes: "meta-box-sortables ui-sortable"-->
						<form action="<?php echo $ajax; ?>" method="post" class="simpleajaxform" data-target="update-response">
<?php wp_nonce_field( 'ithoughts_tt_gl-update_options' ); ?>
							<p style="font-size:17px;"><em><?php printf(wp_kses(__('Need help? Check out the full plugin manual at <a href="%s">GerkinDevelopment.net</a>.', 'ithoughts-tooltip-glossary'), array('a' => array('href' => array()))), esc_url($url)); ?></em></p>
							<p><strong><?php _e("Note", 'ithoughts-tooltip-glossary' ); ?>:</strong>&nbsp;<?php printf(wp_kses(__('Labels in <span class=\"nonoverridable\">red</span> indicate global options, not overridable by tips.', 'ithoughts-tooltip-glossary'), array('span' => array('class' => array())))); ?></p>

							<div id="ithoughts_tt_gllossary_options_1" class="postbox">
								<div class="handlediv" title="Cliquer pour inverser."><br></div><h3 class="hndle"><span><?php esc_html_e('Term Options', 'ithoughts-tooltip-glossary' ); ?></span></h3>
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label for="termlinkopt"><?php esc_html_e('Term link', 'ithoughts-tooltip-glossary' ); ?>:</label>
												</th>
												<td>
													<?php echo $options_inputs["termlinkopt"]; ?>
												</td>
											</tr>
											<tr class="nonoverridable">
												<th>
													<label for="staticterms"><?php esc_html_e('Static terms', 'ithoughts-tooltip-glossary' ); ?>&nbsp;<?php echo apply_filters('ithoughts-tt-gl_tooltip', '('.esc_html__("infos", 'ithoughts-tooltip-glossary' ).')', esc_html__('Include term content directly into the pages to avoid use of Ajax. This can slow down your page generation.', 'ithoughts-tooltip-glossary' ), array("attributes" => array('tooltip-nosolo'=>"true"))); ?>


												</th>
												<td>
													<?php echo $options_inputs["staticterms"]; ?>
												</td>
											</tr>
											<tr class="nonoverridable">
												<th>
													<label for="forceloadresources"><?php esc_html_e('Force load resources', 'ithoughts-tooltip-glossary' ); ?>&nbsp;<?php echo apply_filters('ithoughts-tt-gl_tooltip', '('.esc_html__("infos", 'ithoughts-tooltip-glossary' ).')', esc_html__('Load scripts on every pages, even if not required. This option can be useful if some cache plugins are active, or if you think that scripts are not loaded when required.', 'ithoughts-tooltip-glossary' ), array("attributes" => array('tooltip-nosolo'=>"true"))); ?>:</label>
												</th>
												<td>
													<?php echo $options_inputs["forceloadresources"]; ?>
												</td>
											</tr>
											<tr class="nonoverridable">
												<th>
													<label for="verbosity"><?php esc_html_e('Log level', 'ithoughts-tooltip-glossary' ); ?>&nbsp;<?php echo apply_filters('ithoughts-tt-gl_tooltip', '('.esc_html__("infos", 'ithoughts-tooltip-glossary' ).')', wp_kses(__('Print more infos to the browser console & the server logs.<ul>
													<li>&aquot;Silent&aquot; will output nothing. Use it if all works fine and you are in production site</li>
													<li>&aquot;Errors&aquot; will only output if something was wrong. This is recomended on most sites</li>
													<li>&aquot;Warnings&aquot; should be used on test sites</li>
													<li>&aquot;Infos&aquot; is the mode to use when asking for help on support thread, except if we ask you to use the mode &aquot;All&aquot;</li>
													<li>&aquot;All&aquot; will print many informations usefull for advanced debugging, but also a lot of trash. Post your logs in this mode ONLY if asked by the maintainer</li>
													</ul>.', 'ithoughts-tooltip-glossary'), array('ul' => array(), 'li' => array())), array("attributes" => array('data-tooltip-nosolo'=>"true", "data-qtip-keep-open" => "true"))); ?>:</label>
												</th>
												<td>
													<?php echo $options_inputs["verbosity"]; ?>&nbsp;<label for="verbosity" id="ithoughts_tt_gl-verbosity_label" style="display:inline-block;line-height:27px;vertical-align:top;" data-labels='["<?php esc_attr_e('Silent', 'ithoughts-tooltip-glossary' ); ?>","<?php esc_attr_e('Errors', 'ithoughts-tooltip-glossary' ); ?>","<?php esc_attr_e('Warnings', 'ithoughts-tooltip-glossary' ); ?>","<?php esc_attr_e('Infos', 'ithoughts-tooltip-glossary' ); ?>","<?php _e('All', 'ithoughts-tooltip-glossary' ); ?>"]'></label>
												</td>
											</tr>
											<tr class="nonoverridable">
												<th>
													<label for="itg-purge"><?php esc_html_e('Empty log file', 'ithoughts-tooltip-glossary' ); ?>:</label>
												</th>
												<td>
													<button id="itg-purge" class="button button-link-delete"><?php esc_html_e('Empty', 'ithoughts-tooltip-glossary' ); ?></button>
												</td>
											</tr>
											<tr class="nonoverridable">
												<th>
													<label for="termtype"><?php esc_html_e('Base Permalink', 'ithoughts-tooltip-glossary' ); ?>:</label>
												</th>
												<td>
													<code>/</code><?php echo $options_inputs["termtype"]; ?><code>/</code>
												</td>
											</tr>
											<tr class="nonoverridable">
												<th>
													<label for="grouptype"><?php esc_html_e('Taxonomy group prefix', 'ithoughts-tooltip-glossary' ); ?>:</label>
												</th>
												<td>
													<code>/<?php echo $options["termtype"]; ?>/</code><?php echo $options_inputs["grouptype"]; ?><code>/</code>
												</td>
											</tr>
											<tr class="nonoverridable">
												<th>
													<label for="exclude_search"><?php esc_html_e('Exclude from search', 'ithoughts-tooltip-glossary' ); ?>:</label>
												</th>
												<td>
													<?php echo $options_inputs["exclude_search"]; ?>
												</td>
											</tr>
											<tr>
												<th>
													<label for="termcontent"><?php esc_html_e('Glossary Tip Content', 'ithoughts-tooltip-glossary' ); ?>:</label>
												</th>
												<td>
													<?php echo $options_inputs["termcontent"]; ?>
												</td>
											</tr>
											<tr>
												<th>
													<label for="termscomment"><?php esc_html_e('Enable comments on glossary terms', 'ithoughts-tooltip-glossary' ); ?>:</label>
												</th>
												<td>
													<?php echo $options_inputs["termscomment"]; ?><p><em><strong><?php esc_html_e("Note:", 'ithoughts-tooltip-glossary'); ?> </strong><?php esc_html_e("You may need to enable manually the comments on each glossary terms posted before enabling this option.", 'ithoughts-tooltip-glossary'); ?></em></p>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="postbox" id="ithoughts_tt_gllossary_options_2">
								<div class="handlediv" title="Cliquer pour inverser." onclick="window.refloat(this);"><br></div><h3 onclick="window.refloat(this);" class="hndle"><span><?php esc_html_e('qTip2 Tooltip Options', 'ithoughts-tooltip-glossary' ); ?></span></h3>
								<div class="inside">
									<div style="display:flex;flex-direction:row;flex-wrap:wrap;">
										<div style="flex:1 1 auto;">


											<p><?php printf(wp_kses(__('iThoughts Tooltip Glossary uses the jQuery based <a href="http://qtip2.com/">qTip2</a> library for tooltips.', 'ithoughts-tooltip-glossary'), array('a' => array('href'=>array())))); ?></p>
											<table class="form-table">
												<tbody>
													<tr>
														<th>
															<label for="qtiptrigger"><?php esc_html_e('Tooltip activation', 'ithoughts-tooltip-glossary' ); ?>:</label>
														</th>
														<td>
															<?php echo $options_inputs["qtiptrigger"]; ?>
														</td>
													</tr>
													<tr>
														<th>
															<label for="qtipstyle"><?php esc_html_e('Tooltip Style (qTip)', 'ithoughts-tooltip-glossary' ); ?>:</label>
														</th>
														<td>
															<?php echo $options_inputs["qtipstyle"]; ?>
														</td>
													</tr>
													<tr>
														<th>
															<label for="qtipshadow"><?php esc_html_e('Tooltip shadow', 'ithoughts-tooltip-glossary' ); ?>&nbsp;<?php echo apply_filters('ithoughts-tt-gl_tooltip','('.esc_html__("infos", 'ithoughts-tooltip-glossary' ).')', esc_html__('This option can be overriden by some tooltip styles.', 'ithoughts-tooltip-glossary' ), array("attributes" => array('tooltip-nosolo'=>"true"))); ?>:</label>
														</th>
														<td>
															<?php echo $options_inputs["qtipshadow"]; ?>
														</td>
													</tr>
													<tr>
														<th>
															<label for="qtiprounded"><?php esc_html_e('Rounded corners', 'ithoughts-tooltip-glossary' ); ?>&nbsp;
														<?php echo apply_filters('ithoughts-tt-gl_tooltip','('.esc_html__("infos", 'ithoughts-tooltip-glossary' ).')', esc_html__('This option can be overriden by some tooltip styles.', 'ithoughts-tooltip-glossary' ), array("attributes" => array('tooltip-nosolo'=>"true"))); ?>:</label>
														</th>
														<td>
															<?php echo $options_inputs["qtiprounded"]; ?>
														</td>
													</tr>
													<tr>
														<th>
															<label for="anims"><?php esc_html_e('Animations', 'ithoughts-tooltip-glossary' ); ?></label>
														</th>
														<td>
															<label for="anim_in"><?php esc_html_e('Animation in', 'ithoughts-tooltip-glossary' ); ?>:&nbsp;<?php echo $options_inputs["anim_in"]; ?></label><br/>
															<label for="anim_out"><?php esc_html_e('Animation out', 'ithoughts-tooltip-glossary' ); ?>:&nbsp;<?php echo $options_inputs["anim_out"]; ?></label><br/>
															<label for="anim_time"><?php esc_html_e('Animation duration', 'ithoughts-tooltip-glossary' ); ?>:&nbsp;<?php echo $options_inputs["anim_time"]; ?>ms</label>
														</td>
													</tr>
												</tbody>
											</table>


										</div>
										<div style="flex:1 1 auto;;position:relative;">
											<div id="floater" style="display:flex;flex-direction:row;width:100%;">
												<p style="flex:1 1 auto;text-align:center">
													<span class="itg-tooltip" data-tooltip-autoshow="true" data-tooltip-prerender="true" data-tooltip-id="exampleStyle" data-tooltip-nosolo="true" data-tooltip-nohide="true" data-tooltip-content="<?php echo esc_attr(wp_kses(__('This is an example tooltip, with content such as <a>a tag for link</a>, <em>em tag for emphasis</em>, <b>b tag for bold</b> and <i>i tag for italic</i>', 'ithoughts-tooltip-glossary'), array('a' => array(), 'em' => array(), 'b' => array(), 'i' => array()))); ?>"><a href="javascript:void(0)" title=""><?php esc_html_e('Example Tooltip', 'ithoughts-tooltip-glossary' ); ?></a></span>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>

							<p>
								<input autocomplete="off" type="hidden" name="action" value="ithoughts_tt_gl_update_options"/>
								<button name="submit" class="alignleft button-primary"><?php esc_html_e('Update Options', 'ithoughts-tooltip-glossary' ); ?></button>
							</p>

						</form>
						<div id="update-response" class="clear confweb-update"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
