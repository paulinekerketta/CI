<?php

// API access key from Google API's Console
define('FIREBASE_API_KEY', 'AAAADEOR3CQ:APA91bEPBZbWljBsITYLGTVsnFtBWdjMpFUnNQNfZ8A2B3gQqL8iwGnE0mCOvvNWTnv5LeEMAIezE8vlCa9Vd8xB8cUt7LS2S_uHRVp_Sj-Wbin0ifdAgMfsZ7449e83pvWB01l69v7G');

$id = "ecnc0JI07fE:APA91bGkA6VIJcoiDkpGlTbYpct-2JzRtduOhL-z39kpG0uwqrCVOK7V3JD2Inhl1FlnLOOar9Q2LyqDjwirQewkQslqbVgi8kIUv8AjwnDag11qyCg_8A7FYd5F7hSzemC2WvZpuHUh";
$registrationIds = array($id);

// prep the bundle
$msg = array
(
	'message' 	=> 'here is a message. message',
	'title'		=> 'This is a title. title',
	'subtitle'	=> 'This is a subtitle. subtitle',
	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
);

$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . ecnc0JI07fE:APA91bGkA6VIJcoiDkpGlTbYpct-2JzRtduOhL-z39kpG0uwqrCVOK7V3JD2Inhl1FlnLOOar9Q2LyqDjwirQewkQslqbVgi8kIUv8AjwnDag11qyCg_8A7FYd5F7hSzemC2WvZpuHUh,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );

echo $result;