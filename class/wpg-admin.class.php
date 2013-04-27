<?php
/**
 * WP-Glossary Admin
 */
class WPG_Admin{
 	function __construct() {
		add_action( 'admin_menu',                 array($this, 'options_submenu') );
		add_action( 'wp_ajax_wpg_update_options', array($this, 'update_options') );
	}

	public function options_submenu(){
		$slug             = 'glossary';
		$glossary_options = add_submenu_page( "edit.php?post_type=$slug", 'Glossary Options', 'Glossary Options', 'manage_options', 'glossary-options', array($this, 'options') );
	}

	public function options(){
		$ajax         = admin_url( 'admin-ajax.php' );
		$options      = get_option( 'wp_glossary', array() );
		$tooltips     = isset( $options['tooltips'] )     ? $options['tooltips']     : 'excerpt';
		$alphaarchive = isset( $options['alphaarchive'] ) ? $options['alphaarchive'] : 'standard';
		$qtipstyle    = isset( $options['qtipstyle'] )    ? $options['qtipstyle']    : 'cream';

		// Tooptip DD
		$ttddoptions = array(
			'full'    => array('title'=>'Full',    'attrs'=>array('title'=>'Display full post content')),
			'excerpt' => array('title'=>'Excerpt', 'attrs'=>array('title'=>'Display shorter excerpt content')), 
			'off'     => array('title'=>'Off',     'attrs'=>array('title'=>'Do not display tooltip at all')),
		);
		$tooltipdropdown = tcb_wpg_build_dropdown( 'tooltips', array(
			'selected' => $tooltips,
			'options'  => $ttddoptions,
		) );
		
		// Alpha Arrhive DD
		$aaddoptions = array(
			'alphabet' => array('title'=>'Alphabetical', 'attrs'=>array('title'=>'Display glossary archive alphabetically')),
			'standard' => array('title'=>'Standard',     'attrs'=>array('title'=>'No filtering, display as standard archive')),
		);
		$archivedropdown = tcb_wpg_build_dropdown( 'alphaarchive', array(
			'selected' => $alphaarchive,
			'options'  => $aaddoptions,
		) );

		// qTipd syle options
		$qtipdropdown = tcb_wpg_build_dropdown( 'qtipstyle', array(
			'selected' => $qtipstyle,
			'options'  => array('off'=>'Off', 'cream'=>'Cream', 'dark'=>'Dark', 'green'=>'Green', 'light'=>'Light', 'red'=>'Red', 'blue'=>'Blue'),
		) );
		
		echo <<<HERE
<div class="wrap">
	<div id="wp-glossary-options" class="meta-box meta-box-50" style="width: 50%;">
		<div class="meta-box-inside admin-help">
			<div class="icon32" id="icon-options-general">
				<br>
			</div>
			<h2>WP Glossary Options</h2>
			<form action="$ajax" method="post" class="simpleajaxform" target="update-response">
				<p> Tooltip: {$tooltipdropdown} </p>
				<p> Archive: {$archivedropdown} </p>
				<p> Tooltip (qTip): {$qtipdropdown} </p>
				<p>
					<input type="hidden" name="action" value="wpg_update_options"/>
					<input type="submit" name="submit" class="alignleft button-primary" value="Update Glossary Options"/>
	 	   </p>
			</form>
			<div id="update-response" class="clear confweb-update"></div>
		</div>
	</div>
</div>
HERE;
	}

	public function update_options(){
		$defaults         = array(
			'tooltips'     => 'excerpt',
			'alphaarchive' => 'standard',
			'qtipstyle'    => 'cream',
		);
		$glossary_options = get_option( 'wp_glossary', $defaults );
		foreach( $defaults as $key => $default ){
			$value                  = $_POST[$key] ? $_POST[$key] : $default;
			$glossary_options[$key] = $value;
		}
		
		update_option( 'wp_glossary', $glossary_options );
		die( '<p>Glossary options updated</p>' );
	}
}
