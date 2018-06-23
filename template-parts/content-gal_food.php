
<div id="galfood" class="gall container-fluid">
<?php
$my_postid = 2008;

$content_post = get_post($my_postid);
//var_dump($content_post);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
echo str_replace(']]>', ']]&gt;', $content);

?>

</div>
