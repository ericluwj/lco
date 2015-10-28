<?php echo $header; ?>

<form method="post" action="<?php echo Uri::to('admin/posts/edit/' . $article->id); ?>" enctype="multipart/form-data" novalidate>

	<input name="token" type="hidden" value="<?php echo $token; ?>">

	<fieldset class="header">
		<div class="wrap">
			<?php echo $messages; ?>

			<?php echo Form::text('title', Input::previous('title', $article->title), array(
				'placeholder' => __('posts.title'),
				'autocomplete'=> 'off',
				'autofocus' => 'true'
			)); ?>

			<aside class="buttons">
				<?php echo Form::button(__('global.save'), array(
					'type' => 'submit',
					'class' => 'btn'
				)); ?>

				<?php echo Html::link('admin/posts/delete/' . $article->id, __('global.delete'), array(
					'class' => 'btn delete red'
				)); ?>
			</aside>
		</div>
	</fieldset>

	<fieldset class="main">
		<div class="wrap">
			<?php echo Form::textarea('html', Input::previous('html', $article->html), array(
				'placeholder' => __('posts.content_explain')
			)); ?>

			<?php echo $editor; ?>
		</div>
	</fieldset>

	<fieldset class="meta split">
		<div class="wrap">
			<p>
				<label><?php echo __('posts.slug'); ?>:</label>
				<?php echo Form::text('slug', Input::previous('slug', $article->slug)); ?>
				<em><?php echo __('posts.slug_explain'); ?></em>
			</p>
			<p>
				<label for="description"><?php echo __('posts.description'); ?>:</label>
				<?php echo Form::textarea('description', Input::previous('description', $article->description)); ?>
				<em><?php echo __('posts.description_explain'); ?></em>
			</p>
			<p>
				<label><?php echo __('posts.custom_css'); ?>:</label>
				<?php echo Form::textarea('css', Input::previous('css', $article->css)); ?>
				<em><?php echo __('posts.custom_css_explain'); ?></em>
			</p>
			<p>
				<label for="js"><?php echo __('posts.custom_js'); ?>:</label>
				<?php echo Form::textarea('js', Input::previous('js', $article->js)); ?>
				<em><?php echo __('posts.custom_js_explain'); ?></em>
			</p>
		</div>
	</fieldset>
</form>

<script src="<?php echo asset('application/views/assets/js/dragdrop.js'); ?>"></script>
<script src="<?php echo asset('application/views/assets/js/upload-fields.js'); ?>"></script>
<script src="<?php echo asset('application/views/assets/js/text-resize.js'); ?>"></script>
<script src="<?php echo asset('application/views/assets/js/editor.js'); ?>"></script>
<script>
	$('textarea[name=html]').editor();
</script>

<?php echo $footer; ?>