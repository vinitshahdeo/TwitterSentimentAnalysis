<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="en">
<meta name="description" content="A web app to perform sentiment analysis on tweets fetched based upon hashtags.">
<meta name="author" content="Vinit Shahdeo">
<title>Twitter Sentiment Analysis</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
              <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>

              <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="#">Support</a>
              </nav>
            </div>

            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
              <h1 class="display-4 fw-normal">Twitter Sentiment Analysis</h1>
              <p>Type your <strong>#Hashtags</strong> below to perform Sentiment Analysis on Twitter Results.<br> Click <b>Fetch Tweets</b> and wait for while to view the results.<br><strong><a href="https://github.com/vinitshahdeo"><i class="fa fa-github" aria-hidden="true"></i></a></strong></p>
            </div>
      </header>

      <main>

        
            <div class="container">
                <div class="row align-items-start">
                    <div class="col">
                    </div>    
                    <div class="col text-center">
                        <form method="GET">
                            <input name="q" type="text" class="form-control" required ><br>
                            <button type="submit" class="btn btn-primary">Fetch Tweets</button>
                        </form>
                    </div>
                    <div class="col">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <?php

if (isset($_GET['q']) && $_GET['q']!='') {
    include_once(dirname(__FILE__).'/config.php');
    include_once(dirname(__FILE__).'/lib/TwitterSentimentAnalysis.php');

    $TwitterSentimentAnalysis = new TwitterSentimentAnalysis(DATUMBOX_API_KEY, TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, TWITTER_ACCESS_KEY, TWITTER_ACCESS_SECRET);

    //Search Tweets parameters as described at https://dev.twitter.com/docs/api/1.1/get/search/tweets
    $twitterSearchParams=[
        'q'=>$_GET['q'],
        'lang'=>'en',
        'count'=>20,
    ];
    $results=$TwitterSentimentAnalysis->sentimentAnalysis($twitterSearchParams);
    $pos=0;
    $neg=0;
    $neu=0;
    foreach ($results as $tweet) {
        if ($tweet['sentiment']=='positive') {
            $pos++;
        } elseif ($tweet['sentiment']=='negative') {
            $neg++;
        } elseif ($tweet['sentiment']=='neutral') {
            $neu++;
        }
    }
    $total = $pos+$neg+$neu; ?>
    <h3>Results for "<?php echo $_GET['q']; ?>"</h3>
    <p class="res"><span class="pos">Positive Tweets: <?php echo round(($pos/$total)*100); ?>%</span> | <span class="neu">Neutral Tweets: <?php echo round(($neu/$total)*100); ?>%</span> | <span class="neg"> Negative Tweets: <?php echo round(($neg/$total)*100); ?>%</span> </p>
    <div class="aa_htmlTable">
    <table class="table" border="1">
        <tr class="title">
            <th>USER</th>
            <th>TWEET</th>
            <th>LINK</th>
            <th>SENTIMENT</th>
        </tr>
        <?php
        foreach ($results as $tweet) {
            $color=null;
            if ($tweet['sentiment']=='positive') {
                $color='#7fff7f';
            } elseif ($tweet['sentiment']=='negative') {
                $color='#ffb2b2';
            } elseif ($tweet['sentiment']=='neutral') {
                $color='#FFFFFF';
            } ?>
            <tr style="background:<?php echo $color; ?>;">
                <td><strong><?php echo $tweet['user']; ?></strong></td>
                <td><?php echo $tweet['text']; ?></td>
                <td><a href="<?php echo $tweet['url']; ?>" target="_blank"><i class="fa fa-2x fa-twitter-square" aria-hidden="true"></i></a></td>
                <td><strong><?php echo $tweet['sentiment']; ?></strong></td>
            </tr>
            <?php
        } ?>    
    </table></div><i class="fa fa-code" aria-hidden="true"></i> with <i class="fa fa-heart" aria-hidden="true"></i> by <strong>Vinit Shahdeo</strong>
    <?php
}

?>
                    </div>    
                </div>    
            </div>

        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
<!-- Made with love by Vinit Shahdeo -->
<!-- View more @ https://github.com/vinitshahdeo/ -->
</html>
