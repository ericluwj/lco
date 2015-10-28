<?php

class Application {

	public static function setup() {
		// rename config files
		if(is_writable($src = APP . 'config/application.php')) {
			@rename($src, APP . 'config/app.php');
		}

		if(is_writable($src = APP . 'config/database.php')) {
			@rename($src, APP . 'config/db.php');
		}

		// load meta data from the db to the config
		static::meta();

		// import theming functions
		static::functions();

		// check mirgrations are up to date
		static::migrations();

		// populate registry with globals
		static::register();
	}

	public static function meta() {
		$table = Base::table('meta');

		// load database metadata
		foreach(Query::table($table)->get() as $item) {
			$meta[$item->key] = $item->value;
		}

		Config::set('meta', $meta);
	}

	public static function functions() {
		if( ! is_admin()) {
			$fi = new FilesystemIterator(APP . 'functions', FilesystemIterator::SKIP_DOTS);

			foreach($fi as $file) {
				$ext = pathinfo($file->getFilename(), PATHINFO_EXTENSION);

				if($file->isFile() and $file->isReadable() and '.' . $ext == EXT) {
					require $file->getPathname();
				}
			}

			// include theme functions
			if(is_readable($path = PATH . 'themes' . DS . Config::meta('theme') . DS . 'functions.php')) {
				require $path;
			}
		}
	}

	public static function register() {
		// register home page
		Registry::set('home_page', Page::home());

		// register posts page
		Registry::set('posts_page', Page::posts());

		if( ! is_admin()) {
			// register menu items
			$pages = Page::where('show_in_menu', '=', '1')
				->sort('menu_order')
				->get();

			$pages = new Items($pages);

			Registry::set('menu', $pages);
			Registry::set('total_menu_items', $pages->length());
		}
	}

	public static function migrations() {
		$current = Config::meta('current_migration');
		$migrate_to = Config::migrations('current');

		$migrations = new Migrations($current);
		$table = Base::table('meta');

		if(is_null($current)) {
			$number = $migrations->up($migrate_to);

			Query::table($table)->insert(array(
				'key' => 'current_migration',
				'value' => $number
			));
		}
		else if($current < $migrate_to) {
			$number = $migrations->up($migrate_to);
			Query::table($table)->where('key', '=', 'current_migration')->update(array('value' => $number));
		}
	}

}