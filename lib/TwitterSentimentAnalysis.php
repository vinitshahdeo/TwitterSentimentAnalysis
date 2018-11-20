<?php
include_once(dirname(__FILE__).'/DatumboxAPI.php');
include_once(dirname(__FILE__).'/twitter-client.php');
class TwitterSentimentAnalysis {
    
    protected $datumbox_api_key; 
    
    protected $consumer_key; 
    protected $consumer_secret; 
    protected $access_key;
    protected $access_secret; 
    
    
    
    public function __construct($datumbox_api_key, $consumer_key, $consumer_secret, $access_key, $access_secret){
        $this->datumbox_api_key=$datumbox_api_key;
        
        $this->consumer_key=$consumer_key;
        $this->consumer_secret=$consumer_secret;
        $this->access_key=$access_key;
        $this->access_secret=$access_secret;
    }
    
   
    public function sentimentAnalysis($twitterSearchParams) {
        $tweets=$this->getTweets($twitterSearchParams);
        
        return $this->findSentiment($tweets);
    }
    
  
    protected function getTweets($twitterSearchParams) {
        $Client = new TwitterApiClient(); //Use the TwitterAPIClient
        $Client->set_oauth ($this->consumer_key, $this->consumer_secret, $this->access_key, $this->access_secret);

        $tweets = $Client->call('search/tweets', $twitterSearchParams, 'GET' ); //call the service and get the list of tweets
        
        unset($Client);
        
        return $tweets;
    }
    
    protected function findSentiment($tweets) {
        $DatumboxAPI = new DatumboxAPI($this->datumbox_api_key); //initialize the DatumboxAPI client
        
        $results=array();
        foreach($tweets['statuses'] as $tweet) { //foreach of the tweets that we received
            if(isset($tweet['metadata']['iso_language_code']) && $tweet['metadata']['iso_language_code']=='en') { //perform sentiment analysis only for the English Tweets
                $sentiment=$DatumboxAPI->TwitterSentimentAnalysis($tweet['text']); //call Datumbox service to get the sentiment
                
                if($sentiment!=false) { //if the sentiment is not false, the API call was successful.
                    $results[]=array( //add the tweet message in the results
                        'id'=>$tweet['id_str'],
                        'user'=>$tweet['user']['name'],
                        'text'=>$tweet['text'],
                        'url'=>'https://twitter.com/'.$tweet['user']['name'].'/status/'.$tweet['id_str'],
                        
                        'sentiment'=>$sentiment,
                    );
                }
            }
            
        }
        
        unset($tweets);
        unset($DatumboxAPI);
        
        return $results;
    }
}

  
