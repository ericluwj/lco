<?php echo $header; ?>

<form method="post" action="<?php echo Uri::to('admin/posts/add'); ?>" enctype="multipart/form-data" novalidate>

	<input name="token" type="hidden" value="<?php echo $token; ?>">

	<fieldset class="header">
		<div class="wrap">
			<?php echo $messages; ?>

			<?php echo Form::text('title', Input::previous('title'), array(
				'placeholder' => __('posts.title'),
				'autocomplete'=> 'off',
				'autofocus' => 'true'
			)); ?>

			<aside class="buttons">
				<?php echo Form::button(__('global.save'), array(
					'type' => 'submit',
					'class' => 'btn'
				)); ?>
			</aside>
		</div>
	</fieldset>

	<fieldset class="main">
		<div class="wrap">
			<?php echo Form::textarea('html', Input::previous('html'), array(
				'placeholder' => __('posts.content_explain')
			)); ?>

			<?php echo $editor; ?>
		</div>
	</fieldset>

	<fieldset class="meta split">
		<div class="wrap">
			<p>
				<label><?php echo __('posts.slug'); ?>:</label>
				<?php echo Form::text('slug', Input::previous('slug')); ?>
				<em><?php echo __('posts.slug_explain'); ?></em>
			</p>
			<p>
				<label for="description"><?php echo __('posts.description'); ?>:</label>
				<?php echo Form::textarea('description', Input::previous('description')); ?>
				<em><?php echo __('posts.description_explain'); ?></em>
			</p>
			<p>
				<label><?php echo __('posts.custom_css'); ?>:</label>
				<?php echo Form::textarea('css', Input::previous('css')); ?>
				<em><?php echo __('posts.custom_css_explain'); ?></em>
			</p>
			<p>
				<label for="js"><?php echo __('posts.custom_js', 'Custom JS'); ?>:</label>
				<?php echo Form::textarea('js', Input::previous('js')); ?>
				<em><?php echo __('posts.custom_js_explain'); ?></em>
			</p>
		</div>
	</fieldset>
</form>

<script src="<?php echo asset('application/views/assets/js/slug.js'); ?>"></script>
<script src="<?php echo asset('application/views/assets/js/dragdrop.js'); ?>"></script>
<script src="<?php echo asset('application/views/assets/js/upload-fields.js'); ?>"></script>
<script src="<?php echo asset('application/views/assets/js/text-resize.js'); ?>"></script>
<script src="<?php echo asset('application/views/assets/js/editor.js'); ?>"></script>
<script>
	$('textarea[name=html]').editor();
</script>

<?php echo $footer; ?>