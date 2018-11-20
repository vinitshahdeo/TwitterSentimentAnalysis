<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="en">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


<title>Twitter Sentiment Analysis</title>
<style>
body{
  display: table;
  width: 100%;
  background: #dedede;
  text-align: center;
  font-family: 'Montserrat', sans-serif;
  color: #191919;
  overflow-x: hidden;
  
}
*{ 
  -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
  -moz-box-sizing: border-box;    /* Firefox, other Gecko */
  box-sizing: border-box;         /* Opera/IE 8+ */
}

.aa_h2{
  font:100 5rem/1 Roboto;
  text-transform: uppercase;
}
table{
   background: #fff;
}
table,thead,tbody,tfoot,tr, td,th{
  text-align: center;
  margin: auto;
  border:1px solid #dedede;
  padding: 1rem;
  width: 50%;
}
.table    { display: table; width: 80%; }
.tr       { display: table-row;  }
.thead    { display: table-header-group }
.tbody    { display: table-row-group }
.tfoot    { display: table-footer-group }
.col      { display: table-column }
.colgroup { display: table-column-group }
.td, .th   { display: table-cell; width: auto; }
.caption  { display: table-caption }

.table,
.thead,
.tbody,
.tfoot,
.tr,
.td,
.th{
  text-align: center;
  margin: auto;
  padding: 1rem;
}
.table{
  background: #fff;
  margin: auto;
  border:2px solid teal;
  padding: 0;
  margin-bottom: 5rem;
  border-collapse: collapse;
}

.th{
  font-weight:900;
  color: teal;
  border:2px solid teal;
  &:nth-child(odd){
    border-right:none;
  }
}
.td{
  font-weight: 300;
  border:1px solid teal;
  border-top:none;
  &:nth-child(odd){
    border-right:none;
  }
}

.aa_htmlTable{
  font-family: 'Montserrat', sans-serif;
  padding: 3rem;
  display: table;
  width: 100%;
  height: 100vh;
  border-collapse: collapse;
  vertical-align: middle;
}



.heading{
       font-family: 'Allerta Stencil', sans-serif; 
    color:teal;
    }

input[type=text] {
    width: 20%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid teal;
    border-radius: 4px;
}

 input[type=submit] {
    background-color: transparent; /* Green */
    border: 2px solid teal;
    border-radius: 6%;
    color: teal;
    padding: 12px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}



input[type=submit]:hover {
    background-color: teal;
    color: white;
}
    .fa{
        color:teal;
    }
    .title{
        color:teal;
        font-weight: bolder;
       border:2px solid teal;
    }
</style>
<link href="https://fonts.googleapis.com/css?family=Allerta+Stencil|Montserrat" rel="stylesheet">
</head>
<body>
<h1 class="heading">Twitter <i class="fa fa-twitter" aria-hidden="true"></i> Sentiment Analysis</h1>
    <p>Type your <strong>#Hashtags</strong> below to perform Sentiment Analysis on Twitter Results.<br> Click <b>Fetch Tweets</b> and wait for while to view the results.<br><strong><a href="https://github.com/vinitshahdeo"><i class="fa fa-github" aria-hidden="true"></i></a></strong></p>
<form method="GET">
    <input type="text" name="q" /> <br>
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


    ?>
    <h3>Results for "<?php echo $_GET['q']; ?>"</h3>
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
                $color='#FFFFFF';
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
    </table></div>
    <?php
}

?>

</body>
</html>
