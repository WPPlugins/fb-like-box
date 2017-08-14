<?php
/*
Plugin Name: FB Like Box 
Plugin URI: http://cre8tivenerd.com/2010/09/facebook-like-box-wordpress-plugin/
Description: This will help one to add facebook like box at the end of the post 
Version: 1.0.2
Author: Kannan Sanjeevan
Author URI: http://www.cre8tivenerd.com
License: GPL
*/
add_option("fbfan","","Enter Your FB Fan Page Link","yes");
add_action('admin_menu','efblike');
add_action('the_content','fbbcontent','15000');
add_action( 'wp_head', 'fblikecss' );


function fblikecss(){
echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') .'/wp-content/plugins/fb-like-box/fblikecss.css" />' . "\n";
echo '<style type="text/css">#facebooklike h3 {
background:url("' . get_bloginfo('url') . '/wp-content/plugins/fb-like-box/images/facebooklike.jpg") repeat scroll left top transparent;}#fbbutton a {
background:url("' . get_bloginfo('url') . '/wp-content/plugins/fb-like-box/images/fbfanbutton.jpg") repeat scroll left top transparent;}</style>';
}

function efblike(){
add_options_page('FB Like Box','FB Like Box','administrator','fb-like-box',fb_like_box_admin);
}

function fb_like_box_admin(){
?>
<h2>Want to add a FB like box below your post</h2>
<img src="http://i51.tinypic.com/opu5pd.jpg" />

<u><h3>Fill in the Form</h3></u>
<form method="post"  action="options.php"><?php wp_nonce_field('update-options'); ?>
<p> Enter Your Fan Page URL <input type="text" size="100" name="fbfan" id="fbfan" value="<?php echo get_option('fbfan'); ?>" /></p>
<input type="submit" value="<?php _e('Update Settings')?>" /><input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="fbfan" />
</form>

<?php
}
function fbbcontent($content){


$fblikec = '<div id="facebooklike"><div id="fbhead"><h3>Share on Facebook</h3><div id="fbbutton"><a title="Become a fan" target="_new" href="' . get_option('fbfan') . '">Become a Fan</a></div></div><div id="fb_like"><iframe src="http://www.facebook.com/plugins/like.php?href=' . get_permalink() . ' &amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;font=trebuchet+ms&amp;colorscheme=light&amp;height=25" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:25px;" allowTransparency="true"></iframe></div></div><br><br>';

if( is_single() )
{
return $content.$fblikec;

}
else
{
return $content;
}
}
?>
