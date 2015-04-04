<?php if ( ! defined('HABARI_PATH' ) ) { die( _t('Please do not load this page directly.') ); } ?>
<?php $theme->display('header'); ?>
<div id="contentcontainer">
	<div id="content">
		<div class="single post <?php echo Post::type_name($post->content_type[0]); ?><?php if($theme->evenodd) echo ' even'; else echo ' odd';?>">
			<div class="postmeta">
				<h2 class="postmeta-title"><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title_out; ?>"><?php echo $post->title_out; ?></a></h2>
			</div>
			<div class="postcontent-container">
				<div class="postcontent gallery">
					<a href="<?php echo Site::get_url('site'); ?>gallery/<?php echo $post->slug; ?>?start=<?php echo $start; ?>&show=<?php echo $next; ?>"><img src="<?php echo $photo->url; ?>" alt="<?php echo $photo->title; ?>"></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $theme->display('footer'); ?>