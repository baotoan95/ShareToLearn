/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
        config.filebrowserBrowseUrl = 'http://btit95.esy.es/assets/js/ckfinder/ckfinder.html';
        config.filebrowserImageBrowseUrl = 'http://btit95.esy.es/assets/js/ckfinder/ckfinder.html?type=Images';
        config.filebrowserFlashBrowseUrl = 'http://btit95.esy.es/assets/js/ckfinder/ckfinder.html?type=Flash';
        config.filebrowserUploadUrl = 'http://btit95.esy.es/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
        config.filebrowserImageUploadUrl = 'http://btit95.esy.es/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
        config.filebrowserFlashUploadUrl = 'http://btit95.esy.es/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
        config.enterMode = CKEDITOR.ENTER_BR;
        config.extraPlugins = 'syntaxhighlight';
        config.extraPlugins = 'dialog';
        config.extraPlugins = 'dialogui';
        config.allowedContent = true;
        config.extraAllowedContent =  'img[alt,border,width,height,align,vspace,hspace,class,src,data-original]';
};
