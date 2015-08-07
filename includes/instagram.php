<?php

class instagramPhp{

    /*
     * Attributes
     */
    private $username, //Instagram username
            $access_token, //Your access token
            $userid; //Instagram userid

    /*
     * Constructor
     */
    function __construct($username='',$access_token='') {
        if(empty($username) || empty($access_token)){
            $this->error('empty username or access token');
        } else {
            $this->username=$username;
            $this->access_token = $access_token;
        }
    }

    /*
     * The api works mostly with user ids, but it's easier for users to use their username.
     * This function gets the userid corresponding to the username
     */
    public function getUserIDFromUserName(){
        if(strlen($this->username)>0 && strlen($this->access_token)>0){
            //Search for the username
            $useridquery = $this->queryInstagram('https://api.instagram.com/v1/users/search?q='.$this->username.'&access_token='.$this->access_token);
            if(!empty($useridquery) && $useridquery->meta->code=='200' && $useridquery->data[0]->id>0){
                //Found
                $this->userid=$useridquery->data[0]->id;
            } else {
                //Not found
                $this->error('getUserIDFromUserName');
            }
        } else {
            $this->error('empty username or access token');
        }
    }

    /*
     * Get the most recent media published by a user.
     * you can use the $args array to pass the attributes that are used by the GET/users/user-id/media/recent method
     */
    public function getUserMedia($args=array()){
        if($this->userid<=0){
            //If no user id, get user id
            $this->getUserIDFromUserName();
        }
        if($this->userid>0 && strlen($this->access_token)>0){
            $qs='';
            if(!empty($args)){ $qs = '&'.http_build_query($args); } //Adds query string if any args are specified
            $shots = $this->queryInstagram('https://api.instagram.com/v1/users/'.(int)$this->userid.'/media/recent?access_token='.$this->access_token.$qs); //Get shots
            if($shots->meta->code=='200'){
                return $shots;
            } else {
                $this->error('getUserMedia');
            }
        } else {
            $this->error('empty username or access token');
        }
    }

    /*
     * Method that simply displays the shots in a ul.
     * Used for simplicity and demo purposes
     * You should probably move the markup out of this class to use it directly in your page markup
     */
    public function simpleDisplay($shots){
        $simpleDisplay = '';
        if(!empty($shots->data)){
            $simpleDisplay.='<ul class="instagram_shots"><div class="instagram--tags" id="instagram--tagsempty">#svlife</div>';
                foreach($shots->data as $istg){
                    //The image
                    $istg_thumbnail = $istg->{'images'}->{'standard_resolution'}->{'url'}; //Thumbnail
                    //If you want to display another size, you can use 'low_resolution', or 'standard_resolution' in place of 'thumbnail'

                    //The link
                    $istg_link = $istg->{'link'}; //Link to the picture's instagram page, to link to the picture image only, use $istg->{'images'}->{'standard_resolution'}->{'url'}

                    //The caption
                    $istg_caption = $istg->{'caption'}->{'text'};


                    //The markup
                    $simpleDisplay.='<li><div class="instagram--tags">#'.$istg_caption.'</div><a class="instalink" href="'.$istg_link.'" target="_blank"><span></span><img src="'.$istg_thumbnail.'" alt="'.$istg_caption.'" title="'.$istg_caption.'" /><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">

<path id="instagram-icon" d="M341.205,197.143H460.93v183.795c0,44.77-36.292,81.062-81.062,81.062H132.133   c-44.769,0-81.062-36.293-81.062-81.062V197.143H170.26c-12.2,17.141-19.399,38.087-19.399,60.729   c0,57.919,46.953,104.872,104.873,104.872c57.919,0,104.872-46.953,104.872-104.872   C360.605,235.229,353.405,214.283,341.205,197.143z M460.93,131.062v53.239H330.447c-19.022-19.315-45.465-31.302-74.714-31.302   c-29.251,0-55.693,11.986-74.714,31.302H51.07v-53.239c0-27.322,13.532-51.469,34.245-66.154v87.289h16.62v-96.36   c3.77-1.516,7.679-2.752,11.704-3.691v100.052h16.621V50.047c0.625-0.015,1.245-0.047,1.873-0.047h9.598v102.196h16.62V50h221.517   C424.638,50,460.93,86.292,460.93,131.062z M423.879,96.897c0-7.181-5.822-13.002-13.003-13.002h-43.821   c-7.183,0-13.003,5.821-13.003,13.002v44.785c0,7.181,5.82,13.002,13.003,13.002h43.821c7.181,0,13.003-5.821,13.003-13.002V96.897z    M174.938,257.872c0-24.188,10.698-45.909,27.593-60.729c5.926-5.197,12.613-9.539,19.875-12.842   c10.169-4.625,21.447-7.224,33.327-7.224c11.881,0,23.157,2.599,33.326,7.224c7.263,3.303,13.95,7.645,19.876,12.842   c16.895,14.82,27.592,36.542,27.592,60.729c0,44.55-36.243,80.794-80.794,80.794C211.183,338.666,174.938,302.422,174.938,257.872z    M196.286,257.872c0,32.979,26.735,59.712,59.714,59.712c32.979,0,59.713-26.733,59.713-59.712c0-32.98-26.733-59.713-59.713-59.713   C223.021,198.159,196.286,224.892,196.286,257.872z"/>

</svg></a></li>';
                }
            $simpleDisplay.='<ul>';
        } else {
            $this->error('simpleDisplay');
        }
        return $simpleDisplay;
    }

    /*
     * Common mechanism to query the instagram api
     */
    public function queryInstagram($url){
        //prepare caching
        $cachefolder = __DIR__.'/';
        $cachekey = md5($url);
        $cachefile = $cachefolder.$cachekey.'_'.date('i').'.txt'; //cached for one minute

        //If not cached, -> instagram request
        if(!file_exists($cachefile)){
            //Request
            $request='error';
            if(!extension_loaded('openssl')){ $request = 'This class requires the php extension open_ssl to work as the instagram api works with httpS.'; }
            else { $request = file_get_contents($url); }

            //remove old caches
            $oldcaches = glob($cachefolder.$cachekey."*.txt");
            if(!empty($oldcaches)){foreach($oldcaches as $todel){
              unlink($todel);
            }}
            
            //Cache result
            $rh = fopen($cachefile,'w+');
            fwrite($rh,$request);
            fclose($rh);
        }
        //Execute and return query
        $query = json_decode(file_get_contents($cachefile));
        return $query;
    }

    /*
     * Error
     */
    public function error($src=''){
        echo '/!\ error '.$src.'. ';
    }

}

?>
