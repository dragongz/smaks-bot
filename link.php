<?php
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 5aace87230515a79f04adb22acd82f12e1a3f362
require '/etc/phpmyadmin/conf.d/vendor/autoload.php';

$url = "";
$url = $_POST['url'];

start($url);

function start($url){
    $web_page = @file_get_contents($url);
    preg_match_all("/((http:\/\/www\..*)| (https:\/\/www\..*))/iU", $url, $matches);     // for getting the base url
    $base_url = $matches[2][0]; 
    $links;
    link_grab($links,$web_page);                                                                      // all the links found
    $all_links = array();
    array_push($all_links, $url);
    link_filter($links,$url,$base_url,$all_links);
    link_traverse($all_links,$web_page,$url);
    }
function link_grab(&$links,&$web_page){
    preg_match_all("/<a\s*\S*.*href=\"(.*)\"/siU", $web_page, $matches);                          // filtering urls
    $links = $matches[1];
}

function link_filter(&$links, $url, $base_url, &$all_links){
     
    for ($i=0; $i < count($links); $i++) { 
        if($links[$i][0] == ".")
        {
            $links[$i] = substr($links[$i], 1);
        }
        if($links[$i][0] != "/")                                                        // adding the initial "/"
        {
            if(!preg_match("/http.*/iU",$links[$i]))                                     // don't put / if it's a complete link.
            $links[$i] = "/".$links[$i];
        }
        else
        {
            $links[$i] = $base_url.$links[$i];
        }
        if($links[$i][1] != "#" && !preg_match('/(.*javascript:void.*)|(.*mailto:.*)/iU', $links[$i]))                                                       // ignoring the same pages
        {
            if(preg_match("/http.*/iU",$links[$i]))                                      // 
            {
                if(!in_array($links[$i],$all_links)){
                    array_push($all_links, $links[$i]);
                }
            }
            else
            {
                if(!in_array($links[$i],$all_links)){
                    array_push($all_links, $url.$links[$i]);
                }
            }
        }else if(preg_match_all('/\/MAILTO:(.*)/iU', $links[$i],$matches))
        {
            $email = substr($links[$i], 8);     //entry
<<<<<<< HEAD
=======
=======
$url = $_POST['url'];
start($url);

//pass the arguments
// testing git hub

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
>>>>>>> f5f4e90de13a41589a2982d8875d40bc02d6054c
>>>>>>> 5aace87230515a79f04adb22acd82f12e1a3f362
        }    
    }
}


<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 5aace87230515a79f04adb22acd82f12e1a3f362

function link_traverse(&$all_links,&$web,$url){
    preg_match("/<title>(.*)<\/title>/siU", $web, $matches);
    $title = $matches[1];
    //$title = mb_split("\W", $title);
    //$url_keys = preg_split("/[\s_\-\/\.]+/", $url);    
    $meta = get_meta_tags($url);
    //************************************************************
    $xml = new DOMDocument();
    @$xml->loadHTML($web);
    $links = array();
    
    $i = 0;
    foreach($xml->getElementsByTagName('a') as $link) {
    
    $linkurl[$i] = $link->getAttribute('href');
    //$linkurl[$i] = mb_split("http\:\/\/www\.|https\:\/\/www\.|\.|\/|_|http\:\/\/|\-|https\:\/\/", $linkurl[$i]);
    //array_filter($linkurl[$i]);
    $linktext[$i] = $link->nodeValue;
    //$linktext[$i] = preg_replace("/\n|\r|/", "", $linktext[$i]);
    array_filter($linktext);
    //$linktext[$i] = mb_split("\W", $linktext[$i]);
    //array_filter($linktext[$i]);
    $i++;
    }

    $title = preg_replace("/\W/", " ", $title);
    $conn = new MongoDB\Client;
    $db = $conn->segn;
    $db = $db->crawler;
    $db->updateOne(

        [$title => $url],
        ['$set' => [$title => $url]],
        ['upsert' => true]
    );    
    
    
}

    

<<<<<<< HEAD
?>
=======
?>
=======
function link_traverse(&$all_links){
    for ($i=0; $i < count($all_links); $i++) {
        echo $all_links[$i]."<br>";
    }    
}

?>
>>>>>>> f5f4e90de13a41589a2982d8875d40bc02d6054c
>>>>>>> 5aace87230515a79f04adb22acd82f12e1a3f362
