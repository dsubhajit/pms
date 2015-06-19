<?php
class Youtube {
    protected $link_id;
    protected $thumbnail_link;
    protected $embed_link;
    
    function __construct($link='') {
        if(strlen($link) > 0){
            parseYoutubeLink($link);            
        }
    }
    
    private function parseYoutubeLink($link){
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $match)) {
            $this->link_id = $match[1];
        }
        else $this->link_id =NULL;
    }
    
    private function collectThumbnailLink(){
        if($this->link_id!=NULL)
            $this->thumbnail_link = 'http://img.youtube.com/vi/'.$this->link_id.'/mqdefault.jpg';        
    }
    
    public function getThumbnailImg(){
        return $this->thumbnail_link;
    }
    
    public function getEmbedLink(){        
        return $this->embed_link;
    }
    
    public function getEmbedHTMLCode(){
        return $this->embed_link;
    }
}
?>
