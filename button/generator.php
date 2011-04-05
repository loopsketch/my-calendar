<?php
// fix for a possible contact-form-7 problem (may not exist anymore)
// http://wordpress.org/extend/plugins/contact-form-7/
if (!function_exists('wpcf7_add_tag_generator')) {
	function wpcf7_add_tag_generator(){
		//if this is missing, it'll break things. But it's not my problem to fix it.
	}
}
// Load WordPress core files
	$iswin = preg_match('/:\\\/', dirname(__file__));
	$slash = ($iswin) ? "\\" : "/";
	$wp_path = preg_split('/(?=((\\\|\/)wp-content)).*/', dirname(__file__));
	$wp_path = (isset($wp_path[0]) && $wp_path[0] != "") ? $wp_path[0] : $_SERVER["DOCUMENT_ROOT"];
require_once($wp_path . $slash . 'wp-load.php');
require_once($wp_path . $slash . 'wp-admin' . $slash . 'admin.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php do_action('admin_xml_ns'); ?> <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<title><?php bloginfo('name') ?> &rsaquo; <?php _e("My Calendar Shortcode Generator",'my-calendar'); ?> &#8212; WordPress</title>
<?php
// WordPress styles
wp_admin_css( 'css/global' );
wp_admin_css();
wp_admin_css( 'css/colors' );
wp_admin_css( 'css/ie' );
$hook_suffix = '';
if ( isset($page_hook) )
	$hook_suffix = "$page_hook";
else if ( isset($plugin_page) )
	$hook_suffix = "$plugin_page";
else if ( isset($pagenow) )
	$hook_suffix = "$pagenow";
do_action("admin_print_styles-$hook_suffix");
do_action('admin_print_styles');
do_action("admin_print_scripts-$hook_suffix");
do_action('admin_print_scripts');
do_action("admin_head-$hook_suffix");
do_action('admin_head');
?>
<link rel="stylesheet" href="<?php echo plugins_url('/my-calendar/button/generator.css'); ?>?ver=<?php echo mc_tiny_mce_version(); ?>" type="text/css" media="screen" charset="utf-8" />
<script src="<?php echo plugins_url('/my-calendar/button/mcb.js'); ?>" type="text/javascript" charset="utf-8"></script>
</head>
<body class="<?php echo apply_filters( 'admin_body_class', '' ); ?>">
	<div class="wrap">
		<h2><?php _e("My Calendar Shortcode Generator",'my-calendar'); ?></h2> 
		<fieldset> 
			<legend><?php _e('Shortcode Atributes', 'my-calendar'); ?></legend>
					<p>
					<?php my_calendar_categories_list('select','admin'); ?>
					</p>
					<p>
					<label for="format"><?php _e('Format', 'my-calendar'); ?></label>
                    <select name="format" id="format">
                        <option value="calendar" selected="selected">Grid</option> 
						<option value="list">List</option>
                    </select>
					</p>
					<p>
					<label for="showkey"><?php _e('Show Category Key', 'my-calendar'); ?></label> 
	                    <select name="showkey" id="showkey">
                        <option value="yes">Yes</option>
                        <option value="no" selected="selected">No</option> 
                    </select> 
					</p>
					<p>
					<label for="shownav"><?php _e('Show Previous/Next Links', 'my-calendar'); ?></label>
                    <select name="shownav" id="shownav">
                        <option value="yes">Yes</option>
                        <option value="no" selected="selected">No</option> 
                    </select> 
					</p>
					<p>
					<label for="toggle"><?php _e('Show Format Toggle', 'my-calendar'); ?></label>
                    <select name="toggle" id="toggle">
                        <option value="yes">Yes</option>
                        <option value="no" selected="selected">No</option> 
                    </select> 
					</p>					
					<p>
					<label for="time"><?php _e('Time Segment', 'my-calendar'); ?></label>
                    <select name="time" id="time">
                        <option value="month" selected="selected">Month</option>
                        <option value="week">Week</option> 
                    </select>
					</p>
		</fieldset>
		<p>
		<input type="button" class="button" id="generate" name="generate" value="<?php _e('Generate Shortcode', 'my-calendar'); ?>" />
		</p>
	</div>
	<?php jd_show_support_box(); ?>
	<script type="text/javascript" charset="utf-8">
		// <![CDATA[
		jQuery(document).ready(function(){
			try {
				myCalQT.Tag.Generator.initialize();
			} catch (e) {
				throw "<?php _e("My Calendar: this generator isn't going to put the shortcode in your page. Sorry!", 'my-calendar'); ?>";
			}
		});
		// ]]>
	</script>
</body>
</html>