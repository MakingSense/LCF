<?php
/**
 * Extensions to the plugin
 *
 * @package splendid-addons
 */


/**
 * Get recent tweets
 * @param string $username
 * @param string $consumer_key
 * @param string $consumer_secret
 * @param string $access_token
 * @param string $access_token_secret
 * @param int $cache_time cache time in seconds
 * @return array/boolean
 */
function ts_get_recent_tweets($username, $consumer_key, $consumer_secret, $access_token, $access_token_secret, $cache_time = 3600) {
	
	if (empty($username))
	{
		return '';
	}
	$cache = get_option('theme-recent-tweets');
	
	//display from cache, skip cache if username is changed
	if (is_array($cache) && $cache['username'] == $username && ((int)$cache['time'] + intval($cache_time)) > time())
	{
		if (isset($cache['tweets']) && !empty($cache['tweets'])) {
			return $cache;
		}
		return false;
	}
	//get fromt twitter
	else
	{
		require_once RS_ROOT .'/extras/class/tmhOAuth.php';
		require_once RS_ROOT .'/extras/class/tmhUtilities.php';
		$tmhOAuth = new tmhOAuth(array(
			'consumer_key'    => $consumer_key,
			'consumer_secret' => $consumer_secret,
			'user_token'      => $access_token,
			'user_secret'     => $access_token_secret,
			'curl_ssl_verifypeer'   => false
		));

		$code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array(
		  'screen_name' => $username));
		$response = $tmhOAuth->response;

		$tweets = null;
		if ($response['code'] == 200 && isset($response['response']) && !empty($response['response'])) {
			$tweets = json_decode($response['response']);
	
		} else {
			$tweets = json_decode($response['response']);
			
			return array(
				'is_error' => true,
				'error' => (isset($tweets -> errors[0] -> message) ? $tweets -> errors[0] -> message : 'Unknown error')
			);
			
		}
		
		if ($response['code'] == 200) {
			
			if (is_array($tweets) && count($tweets) > 0) {

				$data = array(
						'time' => time(),
						'username' => $username,
						'tweets' => $response['response'],
						'is_error' => false
				);
				
			} else {

				$data = array(
					'time' => time(),
					'username' => $username,
					'tweets' => '',
					'is_error' => false
				);
			}
			update_option('theme-recent-tweets',$data);
			return $data;
		}
	}
}

/**
 * Replace urls, hashtags, mentions with html tags in tweet
 * @param type $tweet
 * @return null
 */
function ts_replace_in_tweets($tweet) {
	
	if (!is_object($tweet)) {
		return null;
	}
	
	$tweet_text = $tweet->text;
	
	// check if any entites exist and if so, replace then with hyperlinked versions
	if (!empty($tweet->entities->urls) || !empty($tweet->entities->hashtags) || !empty($tweet->entities->user_mentions)) {
		
		$tweet_text = ts_replace_urls_with_html($tweet_text);

		foreach ($tweet->entities->hashtags as $hashtag) {
			$find = '#'.$hashtag->text;
			$replace = '<a href="http://twitter.com/#!/search/%23'.$hashtag->text.'" target="_blank">'.$find.'</a>';
			$tweet_text = str_replace($find,$replace,$tweet_text);
		}

		foreach ($tweet->entities->user_mentions as $user_mention) {
			$find = "@".$user_mention->screen_name;
			$replace = '<a href="http://twitter.com/'.$user_mention->screen_name.'" target="_blank">'.$find.'</a>';
			$tweet_text = str_ireplace($find,$replace,$tweet_text);
		}
	}
	
	return html_entity_decode($tweet_text);
}

/**
 * Replace urls with html 
 * @param string $text
 * @return string
 */
function ts_replace_urls_with_html($text) {
	
	if (!is_string($text)) {
		return $text;
	}
	
	$rexProtocol = '(https?://)?';
	$rexDomain   = '((?:[-a-zA-Z0-9]{1,63}\.)+[-a-zA-Z0-9]{2,63}|(?:[0-9]{1,3}\.){3}[0-9]{1,3})';
	$rexPort     = '(:[0-9]{1,5})?';
	$rexPath     = '(/[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]*?)?';
	$rexQuery    = '(\?[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
	$rexFragment = '(#[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
	
	return preg_replace_callback("&\\b$rexProtocol$rexDomain$rexPort$rexPath$rexQuery$rexFragment(?=[?.!,;:\"]?(\s|$))&", 'ts_replace_urls_with_html_callback', htmlspecialchars($text));
}

/**
 * Replace urls with html callback
 * @param type $match
 * @return type
 */
function ts_replace_urls_with_html_callback($match) {
    // Prepend http:// if no protocol specified
    $completeUrl = $match[1] ? $match[0] : "http://{$match[0]}";

    return '<a href="' . esc_url($completeUrl) . '">'
        . $completeUrl . '</a>';
	
}

/**
 * Convert datetime to x hours/months ago
 * @param type $datetime
 * @param type $full
 * @return type
 */
function ts_time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => esc_html__('year','splendid-addons'),
        'm' => esc_html__('month','splendid-addons'),
        'w' => esc_html__('week','splendid-addons'),
        'd' => esc_html__('day','splendid-addons'),
        'h' => esc_html__('hour','splendid-addons'),
        'i' => esc_html__('minute','splendid-addons'),
        's' => esc_html__('second','splendid-addons'),
    );
	
	$plural = array(
        'y' => esc_html__('years','splendid-addons'),
        'm' => esc_html__('months','splendid-addons'),
        'w' => esc_html__('weeks','splendid-addons'),
        'd' => esc_html__('days','splendid-addons'),
        'h' => esc_html__('hours','splendid-addons'),
        'i' => esc_html__('minutes','splendid-addons'),
        's' => esc_html__('seconds','splendid-addons'),
    );
	
	foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . ($diff->$k > 1 ? $plural[$k] : $v);
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' '.esc_html__('ago', 'splendid-addons') : esc_html__('just now', 'splendid-addons');
}