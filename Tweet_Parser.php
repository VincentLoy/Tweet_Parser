<?php
	
	/* FOR EXAMPLE PURPOSE HERE */
	//I personaly used https://gist.github.com/planetoftheweb/5914179 to get my last tweet.

	//Your Twitter API Request with a JSON return.
    $tweetJSON = file_get_contents('HERE_YOUR_LINK_TO_API_REQUEST_WITH_JSON_FILE');

    //Turn JSON into Array.
    $tweetArray = json_decode($tweetJSON);

    //Select last tweet (this is a String type).
    $tweet = $tweetArray[0]->text;

    /* *********************** SCRIPT ********************** */
    //You'll have to change $tweet value by your own variable containing your tweet.

    //ULR regex
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    //If the tweet contain an url
    if(preg_match($reg_exUrl, $tweet, $url)){

       $tweet = preg_replace($reg_exUrl, '<a href="'.$url[0].'" class="tweet_link" target="_blank">'.$url[0].'</a>', $tweet);

    }

    //if user(s) are mentionned in a tweet
    if(preg_match_all("/@(\w+)/", $tweet, $twitter_user)){

       	$userLength = count($twitter_user[0]);

        for($i=0; $i< $userLength; $i++){
            $tweet = str_replace($twitter_user[0][$i], '<a href="https://twitter.com/'.$twitter_user[1][$i].'" class="twitter_user" target="_blank">'.$twitter_user[0][$i].'</a>', $tweet);
        }

    }
    
    //if the Tweet contains hashtags
    if(preg_match_all("/#(\w+)/", $tweet, $hashtag)){

        $hashtagLength = count($hashtag[0]);

        for($i=0; $i< $hashtagLength; $i++){
            $tweet = str_replace($hashtag[0][$i], '<a href="https://twitter.com/search?q='.$hashtag[1][$i].'" class="hashtag" target="_blank">'.$hashtag[0][$i].'</a>', $tweet);
        }
        
    }
?>