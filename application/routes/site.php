<?php

/**
 * Important pages
 */
$home_page = Registry::get('home_page');
$posts_page = Registry::get('posts_page');

/**
 * The Home page
 */
if($home_page->id != $posts_page->id) {
	Route::get(array('/', $home_page->slug), function() use($home_page) {
		Registry::set('page', $home_page);

		return new Template('page');
	});
}

/**
 * Post listings page
 */
$routes = array($posts_page->slug, $posts_page->slug . '/(:num)');

if($home_page->id == $posts_page->id) {
	array_unshift($routes, '/');
}

Route::get($routes, function($offset = 1) use($posts_page) {
	if($offset > 0) {
		// get public listings
		list($total, $posts) = Post::listing(null, $offset, $per_page = Config::meta('posts_per_page'));
	} else {
		return Response::create(new Template('404'), 404);
	}

	// get the last page
	$max_page = ($total > $per_page) ? ceil($total / $per_page) : 1;

	// stop users browsing to non existing ranges
	if(($offset > $max_page) or ($offset < 1)) {
		return Response::create(new Template('404'), 404);
	}

	$posts = new Items($posts);

	Registry::set('posts', $posts);
	Registry::set('total_posts', $total);
	Registry::set('page', $posts_page);
	Registry::set('page_offset', $offset);

	return new Template('posts');
});

/**
 * Redirect by article ID
 */
Route::get('(:num)', function($id) use($posts_page) {
	if( ! $post = Post::id($id)) {
		return Response::create(new Template('404'), 404);
	}

	return Response::redirect($posts_page->slug . '/' . $post->data['slug']);
});

/**
 * View article
 */
Route::get($posts_page->slug . '/(:any)', function($slug) use($posts_page) {
	if( ! $post = Post::slug($slug)) {
		return Response::create(new Template('404'), 404);
	}

	Registry::set('page', $posts_page);
	Registry::set('article', $post);

	return new Template('article');
});

/**
 * View pages
 */
Route::get('(:all)', function($uri) {
	if( ! $page = Page::slug($slug = basename($uri))) {
		return Response::create(new Template('404'), 404);
	}

	if($page->redirect) {
		return Response::redirect($page->redirect);
	}

	Registry::set('page', $page);

	return new Template('page');
});