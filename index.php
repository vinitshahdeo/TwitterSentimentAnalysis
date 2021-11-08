<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="en">
<meta name="description" content="A web app to perform sentiment analysis on tweets fetched based upon hashtags.">
<meta name="author" content="Vinit Shahdeo">

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


<title>Twitter Sentiment Analysis</title>
<link href="https://fonts.googleapis.com/css?family=Allerta+Stencil|Montserrat" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<h1 class="heading">Twitter <i class="fa fa-twitter twitter" aria-hidden="true"></i> Sentiment Analysis</h1>
    <p>Type your <strong>#Hashtags</strong> below to perform Sentiment Analysis on Twitter Results.<br> Click <b>Fetch Tweets</b> and wait for while to view the results.<br><strong><a class="author" href="https://github.com/vinitshahdeo">
        <div class="row">By : vinitshahdeo </div><i class="fa fa-github git" aria-hidden="true"></i></a></strong></p>
<form method="GET">
    <input type="text" name="q" required="required"/> <br>
    <input type="submit" value="Fetch Tweets"/>
</form>

<?php

if(isset($_GET['q']) && $_GET['q']!='') {
    include_once(dirname(__FILE__).'/config.php');
    include_once(dirname(__FILE__).'/lib/TwitterSentimentAnalysis.php');

    $TwitterSentimentAnalysis = new TwitterSentimentAnalysis(DATUMBOX_API_KEY,TWITTER_CONSUMER_KEY,TWITTER_CONSUMER_SECRET,TWITTER_ACCESS_KEY,TWITTER_ACCESS_SECRET);

    //Search Tweets parameters as described at https://dev.twitter.com/docs/api/1.1/get/search/tweets
    $twitterSearchParams=array(
        'q'=>$_GET['q'],
        'lang'=>'en',
        'count'=>20,
    );
    $results=$TwitterSentimentAnalysis->sentimentAnalysis($twitterSearchParams);
    $pos=0;
    $neg=0;
    $neu=0;
    foreach($results as $tweet){
        if($tweet['sentiment']=='positive') {
                $pos++;
            }
            else if($tweet['sentiment']=='negative') {
                $neg++;
            }
            else if($tweet['sentiment']=='neutral') {
                $neu++;
            }
    }
    $total = $pos+$neg+$neu;

    ?>
    <h3>Results for "<?php echo $_GET['q']; ?>"</h3>
    <p class="res"><span class="pos">Positive Tweets: <?php echo round(($pos/$total)*100);?>%</span> | <span class="neu">Neutral Tweets: <?php echo round(($neu/$total)*100);?>%</span> | <span class="neg"> Negative Tweets: <?php echo round(($neg/$total)*100);?>%</span> </p>
    <div class="aa_htmlTable">
    <table class="table" border="1">
        <tr class="title">
            <th>USER</th>
            <th>TWEET</th>
            <th>LINK</th>
            <th>SENTIMENT</th>
        </tr>
        <?php
        foreach($results as $tweet) {
            
            $color=NULL;
            if($tweet['sentiment']=='positive') {
                $color='#7fff7f';
            }
            else if($tweet['sentiment']=='negative') {
                $color='#ffb2b2';
            }
            else if($tweet['sentiment']=='neutral') {
                $color='#6666';
            }
            ?>
            <tr style="background:<?php echo $color; ?>;">
                <td><strong><?php echo $tweet['user']; ?></strong></td>
                <td><?php echo $tweet['text']; ?></td>
                <td><a href="<?php echo $tweet['url']; ?>" target="_blank"><i class="fa fa-2x fa-twitter-square" aria-hidden="true"></i></a></td>
                <td><strong><?php echo $tweet['sentiment']; ?></strong></td>
            </tr>
            <?php
        }
        ?>    
    </table></div><i class="fa fa-code" aria-hidden="true"></i> with <i class="fa fa-heart" aria-hidden="true"></i> by <strong>Vinit Shahdeo</strong>
    <?php
}

?>

</body>
<!-- Made with love by Vinit Shahdeo -->
<!-- View more @ https://github.com/vinitshahdeo/ -->
</html>
