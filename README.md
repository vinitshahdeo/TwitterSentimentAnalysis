# Twitter Sentiment Analysis

[![Open Source Love](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)](https://github.com/vinitshahdeo/) 
[![GitHub license](https://img.shields.io/github/license/vinitshahdeo/TwitterSentimentAnalysis.svg)](https://github.com/vinitshahdeo/TwitterSentimentAnalysis/blob/master/LICENSE)


A web app to search the keywords(**Hashtags**) on Twitter and analyze the sentiments of it. The source code is written in PHP and it performs Sentiment Analysis on Tweets by using the Datumbox API.

[![Sentiment Analysis](https://img.shields.io/badge/Sentiment-Analysis-orange.svg?style=for-the-badge)](https://github.com/vinitshahdeo/TwitterSentimentAnalysis/) [![Twitter API](https://img.shields.io/badge/Twitter-API-blue.svg?style=for-the-badge)](https://github.com/vinitshahdeo/TwitterSentimentAnalysis/)

## APIs Used

- [Datumbox API 1.0v](http://www.datumbox.com/users/register/)
- [Twitter API](https://dev.twitter.com/apps)

## Useful Links

- Sign-up for free API Key: http://www.datumbox.com/users/register/

- View your API Key: http://www.datumbox.com/apikeys/view/

- PHP Twitter API Client: https://github.com/timwhitlock/php-twitter-api


## Instructions

 - Open **config.php** and configure your **Datumbox API** Key. Get yours at http://www.datumbox.com/apikeys/view/ 
 
 - Get **Twitter API** key for your application at https://dev.twitter.com/apps
 
 - Replace **XXXXXXXXXXXXXXXXXX** with your API keys

```php

define('DATUMBOX_API_KEY', 'XXXXXXXXXXXXXXXXXX');

define('TWITTER_CONSUMER_KEY', 'XXXXXXXXXXXXXXXXXX');
define('TWITTER_CONSUMER_SECRET', 'XXXXXXXXXXXXXXXXXX');
define('TWITTER_ACCESS_KEY', 'XXXXXXXXXXXXXXXXXX');
define('TWITTER_ACCESS_SECRET', 'XXXXXXXXXXXXXXXXXX'); 

```

 - Run `localhost/index.php`
 
 - Wait a while after entering the hashtags. It may take one minute to fetch the tweets. Make sure that your system is connected with internet.
 
## Oh, Thanks!

Thank you for being here!
For any kind of help in running this project, feel free to contact me @ [vinitshahdeo@gmail.com](https://mail.google.com/mail/)

[![saythanks](https://img.shields.io/badge/say-thanks-ff69b4.svg)](https://facebook.com/vinit.shahdeo) 
[![Twitter](https://img.shields.io/twitter/url/https/github.com/vinitshahdeo/TwitterSentimentAnalysis.svg?style=social)](https://twitter.com/intent/tweet?text=Twitter%20Sentiment%20Analysis%20by%20@Vinit_Shahdeo%20:&url=https%3A%2F%2Fgithub.com%2Fvinitshahdeo%2FTwitterSentimentAnalysis)

 
## License

MIT &copy; [Vinit Shahdeo](https://github.com/vinitshahdeo/)

[![forthebadge](https://forthebadge.com/images/badges/built-with-love.svg)](https://github.com/vinitshahdeo)