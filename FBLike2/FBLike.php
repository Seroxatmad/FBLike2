<?php
/**
 * 
 * Place <var>printFBLike()</var> in your theme's image.php file where you want it to appear.
 *		Something like <?php if (function_exists('printFBLike')) { ?>
 *		<div class="rating"><?php printFBLike(); ?></div>
 *		<?php  } ?>
 *
 * To customise go to the admin area and select option/plugin.
 *
 */

$plugin_is_filter = 5|ADMIN_PLUGIN|THEME_PLUGIN;
$plugin_description = gettext('Inserts a FaceBook <i>Like Button</i> on an Image page.');
$plugin_author = "John Stott (seroxatmad)";
$plugin_version = '1.4.3.betaV3';

$option_interface = 'FBLike';

zp_register_filter('theme_body_open','FBLikeJS');

class FBLike {

	function FBLike() {
			setOptionDefault('fbwidth', 450);
			setOptionDefault('fbfaces', false);
			setOptionDefault('fbfont', 'arial');
			setOptionDefault('fblayout', 'standard');
			setOptionDefault('fbcolorscheme', 'light');
			setOptionDefault('fbaction', 'like');
			}
	
	function getOptionsSupported() {
			return array (gettext('Width') => array('key' => 'fbwidth','type'
													=> OPTION_TYPE_TEXTBOX,
													'order'=>1,
													'desc' => gettext('Enter width in Pixels.')),
						gettext('Profile Photo') => array('key' => 'fbfaces','type'
													=> OPTION_TYPE_CHECKBOX,
													'order'=>2,
													'desc' => gettext('Select to show profile photo for Standard Layout only.')),
						gettext('Display Font') => array('key' => 'fbfont','type' 
													=> OPTION_TYPE_SELECTOR,
													'order' =>6,
													'selections' => array(gettext('Arial') => 'arial', 
																			gettext('Lucida grande') => 'lucida_grande', 
																			gettext('Segoe ui') => 'segoe_ui', 
																			gettext('Tahoma') => 'tahoma', 
																			gettext('Trebuchet ms') => 'trebuchet_ms', 
																			gettext('Verdana') => 'verdana'),
													'desc' => gettext('Select Display Font.')),
						gettext('Layout Style') => array('key' => 'fblayout','type' 
													=> OPTION_TYPE_SELECTOR,
													'order' =>3,
													'selections' => array(gettext('Standard') => 'standard', 
																			gettext('Box Count') => 'box_count', 
																			gettext('Button Count') => 'button_count'), 
													'desc' => gettext('Select Layout Style.')),						
						gettext('Display Button Text') => array('key' => 'fbaction','type' 
													=> OPTION_TYPE_SELECTOR,
													'order' =>4,
													'selections' => array(gettext('Like') => 'like', 
																			gettext('Recommend') => 'recommend'), 
													'desc' => gettext('Select text to display on the button.')),							
						gettext('Colour Scheme') => array('key' => 'fbcolorscheme','type' 
													=> OPTION_TYPE_SELECTOR,
													'order' =>5,
													'selections' => array(gettext("Light") => "light", 
																			gettext("Dark") => "dark"), 
													'desc' => gettext("Select Colour Scheme.")));					
									}
	}	
	
	function FBLikeJS() { ?>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
	<?php } 

	function printFBLike() {
			$data_width = getOption('fbwidth');
			$data_show_faces = getOption('fbfaces');
			$data_font = getOption('fbfont');
			$data_layout = getOption('fblayout');
			$data_colorscheme = getOption('fbcolorscheme');
			$data_action = getOption('fbaction');
	?>
	
	<div class="fb-like" data-href="<?php echo html_encode(getMainSiteURL()); ?><?php echo html_encode(getImageLinkURL()); ?>" 
	data-send="false" data-width="<?php echo $data_width ?>" data-show-faces="<?php echo $data_show_faces ?>" data-font="<?php echo $data_font ?>" 
	data-layout="<?php echo $data_layout ?>" data-colorscheme="<?php echo $data_colorscheme ?>" data-action="<?php echo $data_action ?>" ></div>
	<?php } 
				
?>

