<?php
class TVIGallery extends Plugin
{
	public function action_init()
	{
		$this->add_template('gallery_single', dirname(__FILE__) . '/gallery.php');
	}
	
	/**
	 * Add rewrite rule for galleries
	 */
	public function filter_rewrite_rules($rules)
	{
		$rules[] = RewriteRule::create_url_rule('"gallery"/slug', 'PluginHandler', 'tvigallery');
		return $rules;
	}
	
	/**
	 * Fetch post, assign it, fetch photo list and determine current photo
	 */
	public function action_plugin_act_tvigallery($handler)
	{
		$post = Post::get($handler->handler_vars['slug']);
		
		$start = $_GET['start'];
		$next = $_GET['show'];
		if(!isset($next)) {
			$next = 0;
		}
		
		$photosource = $post->info->tvi_photosource;
		if(isset($photosource) && !empty($photosource)) {
			$assets = Media::dir($photosource);
			$list = array();
			foreach($assets as $asset) {
				if($asset->path == $start) {
					array_unshift($list, $asset);
				}
				else {
					$list[] = $asset;
				}
			}
		}
		
		$handler->theme->assign('post', $post);
		$handler->theme->assign('photo', $list[$next]);
		$next++;
		if($next == count($list)) {
			$next = 0;
		}
		$handler->theme->assign('next', $next);
		$handler->theme->assign('start', $start);
		$handler->theme->display('gallery_single');
	}
}
?>