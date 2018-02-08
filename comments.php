<?php
//Get only the approved comments 

echo comment_form();

echo '<ol id="comment-list">';

wp_list_comments( array(
    'style'       => 'ol',
    'short_ping'  => true,
    'avatar_size' => 0,
) );
echo '</ol>';

?>
