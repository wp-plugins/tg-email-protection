<?php
/**
 * Plugin Name: TG Email Protection
 * Plugin URI : http://www.tekgazet.com/tg-email-protection-plugin
 * Description: Protect email addresses from being harvested by spammers and spambots, obfuscating them. Your visitors can still see email addresses.
 * Version: 1.0
 * Author: Ashok Dhamija
 * Author URI: http://tilakmarg.com/dr-ashok-dhamija/
 * License: GPLv2 or later
 */
 
 /*
  Copyright 2015 Ashok Dhamija web: http://tilakmarg.com/dr-ashok-dhamija/

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */
 
// Add a menu for our option page
add_action('admin_menu', 'tg_email_protection_add_page');
function tg_email_protection_add_page() {
	add_options_page( 'TG Email Protection Plugin', 'TG Email Protection', 'manage_options', 'tg_email_protection', 'tg_email_protection_option_page' );
}

// Draw the option page
function tg_email_protection_option_page() {
	
	//Check if it is first time after installation, if so, set default values
	$valid = array();
	$valid = get_option( 'tg_email_protection_options' );
	if( !$valid ) {	
		$valid['automatic'] = ''; //this is to cheat form to show default values for others in first view after activation
		$valid['maincontent'] = 1;
		$valid['title'] = 1;
		$valid['excerptz'] = 1;
		$valid['comment'] = 1;
		$valid['widget'] = 1;
		$valid['blogdiscr'] = 1;
		$valid['at_if'] = '';
		$valid['at_text'] = ' (AT) ';
		$valid['dot_if'] = '';
		$valid['dot_text'] = ' (DOT) ';
		
		update_option( 'tg_email_protection_options', $valid );
		$valid['automatic'] = 1; //this is to cheat form to show default values for others in first view after activation
		update_option( 'tg_email_protection_options', $valid );
	}
	
	?>
	<div class="wrap">
		<h2>TG Email Protection Page</h2>
		<form action="options.php" method="post">
			<?php settings_fields('tg_email_protection_options'); ?>
			<?php do_settings_sections('tg_email_protection'); ?>
			<input name="Submit" type="submit" value="Save Changes" />
			<input name="Submit2" type="submit" value="Reset to Default Values" />	
		</form>
	</div>
	<?php
}

// Register and define the settings
add_action('admin_init', 'tg_email_protection_admin_init');
function tg_email_protection_admin_init(){
	register_setting(
		'tg_email_protection_options',
		'tg_email_protection_options',
		'tg_email_protection_validate_options'
	);
	
	add_settings_section(
		'tg_email_protection_about',
		'About TG Email Protection Plugin',
		'tg_email_protection_section_about_text',
		'tg_email_protection'
	);
	
	add_settings_section(
		'tg_email_protection_scode',
		'How to use Shortcode?',
		'tg_email_protection_section_scode_text',
		'tg_email_protection'
	);
		
	add_settings_section(
		'tg_email_protection_main',
		'TG Email Protection Plugin Settings',
		'tg_email_protection_section_text',
		'tg_email_protection'
	);
	
	add_settings_section(
		'tg_email_protection_other',
		'',
		'tg_email_protection_section_other_text',
		'tg_email_protection'
	);
	
	add_settings_field(
		'tg_email_protection_automatic',
		'Automatically enable email protection on your website:',
		'tg_email_protection_setting_input_automatic',
		'tg_email_protection',
		'tg_email_protection_main'
	);
	
	add_settings_field(
		'tg_email_protection_maincontent',
		'Automatically enable email protection on main content:',
		'tg_email_protection_setting_input_maincontent',
		'tg_email_protection',
		'tg_email_protection_main'
	);

	add_settings_field(
		'tg_email_protection_title',
		'Automatically enable email protection on Title:',
		'tg_email_protection_setting_input_title',
		'tg_email_protection',
		'tg_email_protection_main'
	);
	
	add_settings_field(
		'tg_email_protection_excerptz',
		'Automatically enable email protection on excerpts:',
		'tg_email_protection_setting_input_excerptz',
		'tg_email_protection',
		'tg_email_protection_main'
	);
	
	add_settings_field(
		'tg_email_protection_comment',
		'Automatically enable email protection on comments:',
		'tg_email_protection_setting_input_comment',
		'tg_email_protection',
		'tg_email_protection_main'
	);
	
	add_settings_field(
		'tg_email_protection_widget',
		'Automatically enable email protection on widget text:',
		'tg_email_protection_setting_input_widget',
		'tg_email_protection',
		'tg_email_protection_main'
	);
	
	add_settings_field(
		'tg_email_protection_blogdiscr',
		'Automatically enable email protection on blog description / information:',
		'tg_email_protection_setting_input_blogdiscr',
		'tg_email_protection',
		'tg_email_protection_main'
	);	
		
	add_settings_field(
		'tg_email_protection_at_if',
		'Replace @ character in emails with some other character?',
		'tg_email_protection_setting_input_at_if',
		'tg_email_protection',
		'tg_email_protection_other'
	);	
	
	add_settings_field(
		'tg_email_protection_at_text',
		'Enter text or character in place of @ in email addresses:',
		'tg_email_protection_setting_input_at_text',
		'tg_email_protection',
		'tg_email_protection_other'
	);	
	
	add_settings_field(
		'tg_email_protection_dot_if',
		'Replace . (DOT) character in emails with some other character?',
		'tg_email_protection_setting_input_dot_if',
		'tg_email_protection',
		'tg_email_protection_other'
	);	
	
	add_settings_field(
		'tg_email_protection_dot_text',
		'Enter text or character in place of . (DOT) in email addresses:',
		'tg_email_protection_setting_input_dot_text',
		'tg_email_protection',
		'tg_email_protection_other'
	);	
}

// Draw the section header
function tg_email_protection_section_about_text() {
	echo '<p><b>TG Email Protection</b> is a plugin developed by <a href="http://tilakmarg.com/dr-ashok-dhamija/" target="_blank">Ashok Dhamija</a>. For any help or support issues, please leave your comments at <a href="http://www.tekgazet.com/tg-email-protection-plugin" target="_blank">TG Email Protection Plugin Page</a>, where you can also read more about the detailed functioning of this plugin. If you like this plugin, please vote favorably for it at its <a href="https://wordpress.org/plugins/tg-email-protection/" target="_blank">WordPress plugin page</a>.</p><p>This plugin protects email addresses on your website from being harvested by spammers and spambots, by hiding or obfuscating them from spammers and spambots. But, your genuine visitors can still see email addresses. Thus, you would not have to worry about the privacy of your email addresses being displayed on your websites.</p><hr />';
}

// Draw the section header
function tg_email_protection_section_scode_text() {
	echo '<p>Shortcode can be used to protect or obfuscate email addresses <b>only when</b> the following setting for automatic obfuscation of email addresses on the website is <b>NOT</b> selected; otherwise, shortcode will <b>NOT</b> do anything. So, please use shortcode only with this understanding. To use shortcode, use format like this: <b>[tgemail]person@example.com[/tgemail]</b>, where <b>person@example.com</b> is the email being obfuscated. Put this shortcode in any of your posts, pages or widgets, wherever you want to display email. Please do <b>NOT</b> use shortcode for email in <b>mailto:</b> format.</p><hr />';
}

// Draw the section header
function tg_email_protection_section_text() {
	echo '<p>Enter your settings here for protecting or obfuscating email addresses on your website. You can change these settings any time later.</p><p>Mainly, you have two options to protect your email addresses from spambots. You can choose to automatically enable email obfuscation on your website (in which case, you can still decide to disable / enable email obfuscation on individual elements. Second option is to use email obfuscation only through shortcode, which means that emails will be protected only where you use shortcode around them.</p>';
	//Display the Save Changes and Reset buttons at the top
	echo '<input name="Submit" type="submit" value="Save Changes" />  ';
	echo '<input name="Submit2" type="submit" value="Reset to Default Values" />  ';	
}

// Draw the section header
function tg_email_protection_section_other_text() {
	echo '<hr /><hr /><hr />';
}

// Display and fill the form field
function tg_email_protection_setting_input_automatic() {
	// get option 'automatic' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$automatic = $options['automatic'];
	// echo the field
	$msg1 = '<input type="checkbox" id="automatic" name="tg_email_protection_options[automatic]" value="1"' . checked( 1, $automatic, false ) . '/>';
    echo $msg1;
	echo '<p>When you select this, email protection or obfuscation will be enabled on your website automatically. However, from the following options, you can still select to disable it on certain specific elements of your website.</p><hr /><p><b>Note:</b> Next 6 settings will be relevant only if this automatic setting is selected.</p><hr />';
}

// Display and fill the form field
function tg_email_protection_setting_input_maincontent() {
	// get option 'maincontent' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$disabled = '';
	if ( $options['automatic'] != 1) {
		$disabled = "disabled" ;
	}
	$maincontent = $options['maincontent'];
	// echo the field
	$msg1 = '<input type="checkbox" id="maincontent" name="tg_email_protection_options[maincontent]" value="1"' . checked( 1, $maincontent, false ) . $disabled . '/>';
    echo $msg1;
	echo '<p>Select this to automatically enable email protection on the main contents of your website.</p>';
}

// Display and fill the form field
function tg_email_protection_setting_input_title() {
	// get option 'title' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$disabled = '';
	if ( $options['automatic'] != 1) {
		$disabled = "disabled" ;
	}
	$title = $options['title'];
	// echo the field
	$msg1 = '<input type="checkbox" id="title" name="tg_email_protection_options[title]" value="1"' . checked( 1, $title, false ) . $disabled . '/>';
    echo $msg1;
	echo '<p>Select this to automatically enable email protection on the title of posts.</p>';
}

// Display and fill the form field
function tg_email_protection_setting_input_excerptz() {
	// get option 'excerptz' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$disabled = '';
	if ( $options['automatic'] != 1) {
		$disabled = "disabled" ;
	}
	$excerptz = $options['excerptz'];
	// echo the field
	$msg1 = '<input type="checkbox" id="excerptz" name="tg_email_protection_options[excerptz]" value="1"' . checked( 1, $excerptz, false ) . $disabled . '/>';
    echo $msg1;
	echo '<p>Select this to automatically enable email protection on the excerpts of posts.</p>';
}

// Display and fill the form field
function tg_email_protection_setting_input_comment() {
	// get option 'comment' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$disabled = '';
	if ( $options['automatic'] != 1) {
		$disabled = "disabled" ;
	}
	$comment = $options['comment'];
	// echo the field
	$msg1 = '<input type="checkbox" id="comment" name="tg_email_protection_options[comment]" value="1"' . checked( 1, $comment, false ) . $disabled . '/>';
    echo $msg1;
	echo '<p>Select this to automatically enable email protection on the comments.</p>';
}

// Display and fill the form field
function tg_email_protection_setting_input_widget() {
	// get option 'widget' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$disabled = '';
	if ( $options['automatic'] != 1) {
		$disabled = "disabled" ;
	}
	$widget = $options['widget'];
	// echo the field
	$msg1 = '<input type="checkbox" id="widget" name="tg_email_protection_options[widget]" value="1"' . checked( 1, $widget, false ) . $disabled . '/>';
    echo $msg1;
	echo '<p>Select this to automatically enable email protection on the widget text.</p>';
}

// Display and fill the form field
function tg_email_protection_setting_input_blogdiscr() {
	// get option 'blogdiscr' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$disabled = '';
	if ( $options['automatic'] != 1) {
		$disabled = "disabled" ;
	}
	$blogdiscr = $options['blogdiscr'];
	// echo the field
	$msg1 = '<input type="checkbox" id="blogdiscr" name="tg_email_protection_options[blogdiscr]" value="1"' . checked( 1, $blogdiscr, false ) . $disabled . '/>';
    echo $msg1;
	echo '<p>Select this to automatically enable email protection on the blog description / information.</p>';
}

// Display and fill the form field
function tg_email_protection_setting_input_at_if() {
	// get option 'at_if' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$at_if = $options['at_if'];
	// echo the field
	$msg1 = '<input type="checkbox" id="at_if" name="tg_email_protection_options[at_if]" value="1"' . checked( 1, $at_if, false ) . '/>';
    echo $msg1;
	echo '<p>Select this if you want to replace @ character in email addresses. If yes, in the next option, you can customize what should replace @ in emails.</p>';
}

// Display and fill the form field
function tg_email_protection_setting_input_at_text() {
	// get option 'at_text' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$at_text = $options['at_text'];
	// echo the field
	echo "<input id='tg_email_protection_options[at_text]' name='tg_email_protection_options[at_text]' type='text' value='$at_text' />";
	echo '<p>Select the text by which you want to replace @ character in email addresses. The default is " (AT) " (<b>with one space character each on both sides</b>). This setting will be used <b>ONLY IF</b> you have selected the above checkbox to replace the @ character in email addresses, otherwise this setting will be ignored. Only alphabets, numbers, @ (at the rate of), - (hyphen), _ (underscore), ( (left parentheses), ) (left parentheses), [ (left square bracket), ] (right square bracket) and space characters are allowed here. If you select the default setting here (and in the next setting), email addresses will be displayed something like <b>person (AT) example (DOT) com</b>.</p>';
}

// Display and fill the form field
function tg_email_protection_setting_input_dot_if() {
	// get option 'dot_if' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$dot_if = $options['dot_if'];
	// echo the field
	$msg1 = '<input type="checkbox" id="dot_if" name="tg_email_protection_options[dot_if]" value="1"' . checked( 1, $dot_if, false ) . '/>';
    echo $msg1;
	echo '<p>Select this if you want to replace . (DOT) character in email addresses. If yes, in the next option, you can customize what should replace . (DOT) character in emails.</p>';
}

// Display and fill the form field
function tg_email_protection_setting_input_dot_text() {
	// get option 'dot_text' value from the database
	$options = get_option( 'tg_email_protection_options' );
	$dot_text = $options['dot_text'];
	// echo the field
	echo "<input id='dot_text' name='tg_email_protection_options[dot_text]' type='text' value='$dot_text' />";
	echo '<p>Select the text by which you want to replace . (DOT) character in email addresses. The default is " (DOT) " (<b>with one space character each on both sides</b>).  This setting will be used <b>ONLY IF</b> you have selected the above checkbox to replace the . (DOT) character in email addresses, otherwise this setting will be ignored. Only alphabets, numbers, . (DOT), - (hyphen), _ (underscore), ( (left parentheses), ) (left parentheses), [ (left square bracket), ] (right square bracket) and space characters are allowed here. If you select the default setting here (and in the previous setting), email addresses will be displayed something like <b>person (AT) example (DOT) com</b>.</p>';
}

// Validate user input 
function tg_email_protection_validate_options( $input ) {		
	$valid = array();	
	$options = get_option( 'tg_email_protection_options' );

	//Reset to default values, if needed
	if ( isset( $_POST['Submit2'] ) ) 
	{ 
		$valid['automatic'] = 1;
		$valid['maincontent'] = 1;
		$valid['title'] = 1;
		$valid['excerptz'] = 1;
		$valid['comment'] = 1;
		$valid['widget'] = 1;
		$valid['blogdiscr'] = 1;
		$valid['at_if'] = '';
		$valid['at_text'] = ' (AT) ';
		$valid['dot_if'] = '';
		$valid['dot_text'] = ' (DOT) ';
		
		
		//Show message for defaults restored
		add_settings_error(
			'tg_email_protection_option_page',
			'tg_email_protection_texterror',
			'Default values have been restored.',
			'updated'
			);	
			
		return $valid;
	}

	/* this is to ensure that when 'automatic' option is checked (when earlier it was unchecked), 
	all other elements are enabled from disabled status with correct existing value 
	*/
	if (($input['automatic'] == 1) && ($options['automatic'] != $input['automatic'])) {
		$input['maincontent'] = $options['maincontent'] ;
		$input['title'] = $options['title'] ;
		$input['excerptz'] = $options['excerptz'] ;
		$input['comment'] = $options['comment'] ;
		$input['widget'] = $options['widget'] ;
		$input['blogdiscr'] = $options['blogdiscr'] ;
	}
	
	//check whether at_text is correctly entered
	$valid['at_text'] = preg_replace( '/[^)(\][\-_@a-z0-9 ]/i', '', $input['at_text'] );	
	if( $valid['at_text'] != $input['at_text'] ) {
		//restore the old value
		$valid['at_text'] = $options['at_text'] ;
		//set error
		add_settings_error(
			'tg_email_protection_at_text',
			'tg_email_protection_texterror',
			'Error: Please enter valid characters for text to replace @ character in Emails. Only alphabets, numbers, @ (at the rate of), - (hyphen), _ (underscore), ( (left parentheses), ) (left parentheses), [ (left square bracket), ] (right square bracket) and space characters are allowed.',
			'error'
		);		
	}
	
	//check whether dot_text is correctly entered
	$valid['dot_text'] = preg_replace( '/[^)(\][\-_.a-z0-9 ]/i', '', $input['dot_text'] );	
	if( $valid['dot_text'] != $input['dot_text'] ) {
		//restore the old value
		$valid['dot_text'] = $options['dot_text'] ;
		//set error
		add_settings_error(
			'tg_email_protection_dot_text',
			'tg_email_protection_texterror',
			'Error: Please enter valid characters for text to replace . (DOT) character in Emails. Only alphabets, numbers, . (DOT), - (hyphen), _ (underscore), ( (left parentheses), ) (left parentheses), [ (left square bracket), ] (right square bracket) and space characters are allowed.',
			'error'
		);		
	}	
	
	$valid['automatic'] = $input['automatic'] ;
	$valid['maincontent'] = $input['maincontent'] ;
	$valid['title'] = $input['title'] ;
	$valid['excerptz'] = $input['excerptz'] ;
	$valid['comment'] = $input['comment'] ;
	$valid['widget'] = $input['widget'] ;
	$valid['blogdiscr'] = $input['blogdiscr'] ;
	$valid['at_if'] = $input['at_if'] ;
	//$valid['at_text'] = $input['at_text'] ;
	$valid['dot_if'] = $input['dot_if'] ;
	//$valid['dot_text'] = $input['dot_text'] ;	
			
	return $valid;		
}

//generate a random string of lower-case letters
function random_string($length = 6) {
	return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
}

// Hide email from Spam Bots using a shortcode.
function tg_email_protection_shortcode( $atts , $content = null ) {
	$newstr = $newstr1 = $content ; //this is to take care of situation if it is not an email, so that shortcode will return the unchanged input
	// get options from the database
	$options = get_option( 'tg_email_protection_options' );
	if ( $options['automatic'] != 1) { //shortcode can be used only if automatic obfuscation of emails on website is disabled		
		global $email_count;		
		$pos = strpos($newstr1, '@');
		if ($pos !== false) {	//note the use of !== operator instead of != operator; this is to take care of $pos being 0							
			$number = mt_rand(0, $pos - 1);				
			$begin = substr($newstr1, 0, $number);
			$end = substr($newstr1, $number);
			$newstr2 = substr_replace($begin, '<span class="tgemailprotection' . random_string( mt_rand(1, 6) ) . '">', mt_rand(0, $number), 0);
			$newstr3 = substr_replace($end, "</span>", $pos - $number + 1, 0);
			$newstr = $newstr2 . $newstr3;
		}
		if ($email_count == 0){
			$email_count = 1 ;
		}			
	}
	return $newstr ;
}
add_shortcode( 'tgemail', 'tg_email_protection_shortcode' );
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

//Enable email protection depending upon options chosen
$choice = get_option( 'tg_email_protection_options' );
if ($choice['automatic'] == 1 ) {	
	// No need to protect email in admin screen area
	if ( is_admin() ) {
		return;
	}	
	if ($choice['maincontent'] == 1 ) {
		add_filter( 'the_content', 'tg_email_protection_modify_email' );	
	}
	if ($choice['title'] == 1 ) {
		add_filter( 'the_title', 'tg_email_protection_modify_email2' );
	}
	if ($choice['excerptz'] == 1 ) {
		add_filter( 'get_the_excerptz', 'tg_email_protection_modify_email2' );
	}
	if ($choice['comment'] == 1 ) {
		add_filter( 'comment_text', 'tg_email_protection_modify_email2' );	
	}
	if ($choice['widget'] == 1 ) {
		add_filter( 'widget_text', 'tg_email_protection_modify_email2' );
	}
	if ($choice['blogdiscr'] == 1 ) {
		add_filter( 'bloginfo', 'tg_email_protection_modify_email2' );
	}		
}

function tg_email_protection_modify_email($content) {
	global $email_count;
	$pattern = '/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/i' ;
	$pattern2 = '/(?<=mailto:|<|< |>|> )[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}(?=>| >|<\/a>| <\/a>|\'|"| \'| ")/i' ;
	//first run regex test for email surrounded by various elements
	$content = preg_replace_callback( $pattern2, 'tg_email_protection_modify_email_callback2', $content );  
	//Now run regex for plain email addresses
	$content = preg_replace_callback( $pattern, 'tg_email_protection_modify_email_callback', $content );  
	//insert plugin info if needed
	if ($email_count == 1){
			$content .= ' <!-- Email protection powered by TG Email Protection plugin : http://www.tekgazet.com/tg-email-protection-plugin written by Ashok Dhamija http://tilakmarg.com/dr-ashok-dhamija/  --> ' ;
	}	
	return $content;
}
//this second function is to restrict plugin info to be shown only once and that too at correct place after main content
function tg_email_protection_modify_email2($content) {
	$pattern = '/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/i' ;
	$pattern2 = '/(?<=mailto:|<|< |>|> )[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}(?=>| >|<\/a>| <\/a>|\'|"| \'| ")/i' ;
	//first run regex test for email surrounded by various elements
	$content = preg_replace_callback( $pattern2, 'tg_email_protection_modify_email_callback2', $content );  
	//Now run regex for plain email addresses
	$content = preg_replace_callback( $pattern, 'tg_email_protection_modify_email_callback', $content );  
	//insert plugin info if needed
	return $content;
}

// the callback function
function tg_email_protection_modify_email_callback ($matches) {
    return tg_email_protection_hide_email ( $matches[0] ) ;	// $matches[0] is the complete match
}

// the callback function
function tg_email_protection_modify_email_callback2 ($matches) {
    return tg_email_protection_hide_email2 ( $matches[0] ) ;	// $matches[0] is the complete match
}

//define global variable
$email_count = 0;

// Hide email from Spam Bots.
function tg_email_protection_hide_email( $content ) {
	$newstr = $newstr1 = $content ; //this is to take care of situation if it is not an email, so that shortcode will return the unchanged input
	
	global $email_count;
	
	$pos = strpos($newstr1, '@');
	if ($pos !== false) {	//note the use of !== operator instead of != operator; this is to take care of $pos being 0
						
		$number = mt_rand(0, $pos - 1);				
		$begin = substr($newstr1, 0, $number);
		$end = substr($newstr1, $number);
		$newstr2 = substr_replace($begin, '<span class="tgemailprotection' . random_string( mt_rand(1, 6) ) . '">', mt_rand(0, $number), 0);
		//$newstr2 = substr_replace($begin, '<span tgemailprotection' . random_string( mt_rand(1, 6) ) . '>', mt_rand(0, $number), 0);
		$newstr3 = substr_replace($end, "</span>", $pos - $number + 1, 0);
		$newstr = $newstr2 . $newstr3;
		
		$options = get_option( 'tg_email_protection_options' );
		if ($options['at_if'] == 1 ) {
			$pos2 = strpos($newstr, '@');
			if ($pos2 !== false) {	//note the use of !== operator instead of != operator
				if ($options['at_text'] != '') {
					$newstr = substr_replace($newstr, $options['at_text'] , $pos2, 1);
				}				
			}
		}
		
		if ($options['dot_if'] == 1 ) {
			$pos3 = strpos($newstr, '.');
			if ($pos3 !== false) {	//note the use of !== operator instead of != operator
				if ($options['dot_text'] != '') {
					$newstr = substr_replace($newstr, $options['dot_text'] , $pos3, 1);
				}				
			}
		}		
				
		if ($email_count == 0){
			$email_count = 1 ;
		}
	}
	return $newstr ;
}	

//define global array
$str2 = array( '&#8204;', '&#8205;' );

// Hide email from Spam Bots.
function tg_email_protection_hide_email2( $content ) {
	$newstr = $newstr1 = $content ; //this is to take care of situation if it is not an email, so that shortcode will return the unchanged input
	
	global $email_count;
	global $str2;	
	
	$pos = strpos($newstr1, '@');
	if ($pos !== false) {	//note the use of !== operator instead of != operator; this is to take care of $pos being 0
						
		$number = mt_rand(0, $pos - 1);				
		$begin = substr($newstr1, 0, $number);
		$end = substr($newstr1, $number);
		$newstr2 = substr_replace($begin, $str2[0], mt_rand(0, $number), 0);		
		$newstr3 = substr_replace($end, $str2[1], $pos - $number + 1, 0);
		$newstr = $newstr2 . $newstr3;
		
		$options = get_option( 'tg_email_protection_options' );
		if ($options['at_if'] == 1 ) {
			$pos2 = strpos($newstr, '@');
			if ($pos2 !== false) {	//note the use of !== operator instead of != operator
				if ($options['at_text'] != '') {
					$newstr = substr_replace($newstr, $options['at_text'] , $pos2, 1);
				}				
			}
		}
		
		if ($options['dot_if'] == 1 ) {
			$pos3 = strpos($newstr, '.');
			if ($pos3 !== false) {	//note the use of !== operator instead of != operator
				if ($options['dot_text'] != '') {
					$newstr = substr_replace($newstr, $options['dot_text'] , $pos3, 1);
				}				
			}
		}		
		
		if ($email_count == 0){
			$email_count = 1 ;
		}
	}
	return $newstr ;
}	


	
?>