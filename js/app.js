var editor, html = '';
var editor2, html2 = '';
function removeCKEditorInstance(){
    if (CKEDITOR.instances['editor']) { 
        delete CKEDITOR.instances['editor'] 
    }
 }

function createEditor()
{    
    editor = CKEDITOR.replace( 'editor' );        
    CKFinder.setupCKEditor( editor, 'ckfinder/' ) ;
}

function createEditor2()
{    
    editor2 = CKEDITOR.replace( 'editor2' );        
    CKFinder.setupCKEditor( editor2, '../../ckfinder/' ) ;
}

function removeCKEditorInstance2(){
    if (CKEDITOR.instances['editor2']) { 
        delete CKEDITOR.instances['editor2'] 
    }
}