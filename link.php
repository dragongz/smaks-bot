<?php
$url = $_POST['url'];
start($url);

//pass the arguments

function start($url){
    $web_page = @file_get_contents($url);
    preg_match_all("/(http:\/\/www\.(.*)\/| https:\/\/www\.(.*)\/)/U", $url, $matches);     // for getting the base url 
    $base_url = $matches[2][0]; 
    preg_match_all("/<a\s.*href=\"(.*)\"/U", $web_page, $matches);                          // filtering urls
    $links = $matches[1];                                                                   // all the links found
    $all_links = array();
    link_filter($links,$url,$base_url,$all_links);
    link_traverse($all_links);
}


function link_filter($links, $url, $base_url, &$all_links){
     
    for ($i=0; $i < count($links); $i++) { 
        
        if($links[$i][strlen($links[$i])-1]!="/")
        {
            $links[$i] = $links[$i]."/";
        }

        if($links[$i][0] == "/")                                                        // removing the initial "/"
        {
            $links[$i] = substr($links[$i], 1);
            array_push($all_links, $url.$links[$i]);
        }

        if($links[$i][0] != "#" && preg_match("/.*".($base_url).".*/U", $links[$i]))
        {
            if(preg_match("/http.*/U", $links[$i]))
                {
                    array_push($all_links, $links[$i]);
                }
                else
                {
                    array_push($all_links, $url.$links[$i]);
                }
        }    
    }
}


function link_traverse(&$all_links){
    for ($i=0; $i < count($all_links); $i++) {
        echo $all_links[$i]."<br>";
    }    
}

?>
