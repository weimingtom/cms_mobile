$(function(){
	$('textarea.blocTxtEditor').ckeditor({
		toolbar:[
			[
			 	'Bold','Italic','Underline','Strike'
			],[
				'JustifyLeft',
				'JustifyCenter',
				'JustifyRight',
				'JustifyBlock'
			],[
			   'NumberedList','BulletedList'
			],[
				'Link',
				'Unlink'
			],[
				'HorizontalRule',
				'SpecialChar'
			],[
			   'Format'
			],[
				'ShowBlocks',
				'Source'
			],[
			   'RemoveFormat'
			],[
			   'Image'
			],['TextColor','BGColor']
		]
	});
});