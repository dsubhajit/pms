<?php
    
    if(!isset($ckeditor_path)) $ckeditor_path='';

    include_once $ckeditor_path.'ckeditor/ckeditor.php';

    $ckeditor = new CKEditor();
    $ckeditor->replace($target_textarea);
    $ckeditor->basePath = $ckeditor_path.'ckeditor/';
    $ckeditor->replaceAll();
    $ckeditor->config['contentsCss'] = array($ckeditor->basePath.'contents.css','css/bootstrap.min.css','css/dashboard.css');
    $ckeditor->config['filebrowserBrowseUrl'] = $ckeditor_path.'ckfinder/ckfinder.html';
    $ckeditor->config['filebrowserImageBrowseUrl'] = $ckeditor_path.'ckfinder/ckfinder.html?type=Images';
    $ckeditor->config['filebrowserFlashBrowseUrl'] = $ckeditor_path.'ckfinder/ckfinder.html?type=Flash';
    $ckeditor->config['filebrowserUploadUrl'] = $ckeditor_path.'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    $ckeditor->config['filebrowserImageUploadUrl'] = $ckeditor_path.'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    $ckeditor->config['filebrowserFlashUploadUrl'] = $ckeditor_path.'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
    
    
    $ckeditor->editor($target_textarea);
    
?>   