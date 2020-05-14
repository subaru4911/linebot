<?php 
$accessToken = 'FgIlQZDhdAs7CA+FQuLV/3I/Z9VBhgwQ64235f3EFbTCrf4qCP1DwLoAFpVCEWrG2aUFA3zYzBN+g6vIPqqHOb4/QqvrKV9uGFub7OvRjeUBSR3z4cArQjxGZW6sNGa8eskbENuGq5bFj31pOEqR/wdB04t89/1O/w1cDnyilFU='; 
$jsonString = file_get_contents('php://input'); error_log($jsonString); 
$jsonObj = json_decode($jsonString); 
$message = $jsonObj->{"events"}[0]->{"message"}; 
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

$type = $jsonObj->{'events'}[0]->{'type'};

// 送られてきたメッセージの中身からレスポンスのタイプを選択 
if ($message->{"text"} == 'クイズ') {
	$kuizu = rand(1,5);
	if ($kuizu == 1) {
		$q1 = '上腕二頭筋の作用は？';
		$ans1 = '肘関節屈曲';
		$num1 = 1; 
		$ans2 = '肘関節伸展';
		$num2 = 0; 
		$ans3 = '前腕回内';
		$num3 = 0; 
		$ans4 = '手関節掌屈';
		$num4 = 0; 
	}elseif ($kuizu == 2) {
		$q1 = '三角筋の作用は？';
		$ans1 = '肩関節屈曲';
		$num1 = 1; 
		$ans2 = '肩関節内転';
		$num2 = 0; 
		$ans3 = '頸部屈曲';
		$num3 = 0; 
		$ans4 = '肩甲骨内転';
		$num4 = 0; 
	}elseif ($kuizu == 3) {
		$q1 = '前鋸筋の作用は？';
		$ans1 = '肩甲骨上方回旋';
		$num1 = 1; 
		$ans2 = '肩甲骨下方回旋';
		$num2 = 0; 
		$ans3 = '肩甲骨内転';
		$num3 = 0; 
		$ans4 = '肩甲骨下制';
		$num4 = 0; 
	}elseif ($kuizu == 4) {
		$q1 = '大臀筋の作用は？';
		$ans1 = '股関節屈曲';
		$num1 = 0; 
		$ans2 = '股関節伸展';
		$num2 = 1; 
		$ans3 = '膝関節伸展';
		$num3 = 0; 
		$ans4 = '足関節背屈';
		$num4 = 0; 
	}else{
		$q1 = '前脛骨筋の作用は？';
		$ans1 = '足関節背屈';
		$num1 = 1; 
		$ans2 = '足関節底屈';
		$num2 = 0; 
		$ans3 = '膝関節進展';
		$num3 = 0; 
		$ans4 = '股関節進展';
		$num4 = 0; 
	}
	
	$messageData = [ 
		'type' => 'template', 
		'altText' => '確認ダイアログ', 
		'template' => [ 'type' => 'buttons', 'text' => $q1, 
		'actions' => [
		[ 'type' => 'postback', 'label' => $ans1, 'data' => 'ans=' . $ans1 . '&num=' . $num1 ],
		[ 'type' => 'postback', 'label' => $ans2, 'data' => 'ans=' . $ans2 . '&num=' . $num2 ],
		[ 'type' => 'postback', 'label' => $ans3, 'data' => 'ans=' . $ans3 . '&num=' . $num3 ],
		[ 'type' => 'postback', 'label' => $ans4, 'data' => 'ans=' . $ans4 . '&num=' . $num4 ],
		] 
		]
	]; 


} elseif ($message->{"text"} == '豆知識') { 
	// ボタンタイプ 
	$messageData = ['type' => 'template',
			'altText' => 'ボタン', 
			'template' => 
			['type' => 'buttons','title' => 'タイトルです','text' => '選択してね', 
			'actions' => 
			[
			['type' => 'postback', 'label' => 'webhookにpost送信', 'data' => 'value' ],
			['type' => 'uri','label' => 'googleへ移動', 'uri' => 'https://google.com' ]
			]
			] 
			]; 
} elseif ($message->{"text"} == 'トレーニング') {
	// カルーセルタイプ 
	$messageData = [ 
		'type' => 'template', 
		'altText' => 'カルーセル', 
		'template' => [
		'type' => 'carousel', 
		'columns' => [ 
		[ 
		'title' => '体幹トレーニング', 
		'text' => '体幹トレーニングです！',
		'actions' => [
		[
		'type' => 'postback',
		'label' => 'webhookにpost送信',
		'data' => 'value'
		],
		[ 
		'type' => 'uri', 
		'label' => '美容の口コミ広場を見る',
		'uri' => 'http://clinic.e-kuchikomi.info/'
		] 
		] 
		],
		[ 
		'title' => '下肢トレーニング', 
		'text' => '下肢トレーニングです！', 
		'actions' => [ 
		[
		'type' => 'postback', 
		'label' => 'webhookにpost送信', 
		'data' => 'value' 
		], 
		[ 
		'type' => 'uri', 
		'label' => '女美会を見る', 
		'uri' => 'https://jobikai.com/' 
		] 
		] 
		], 
		[ 
		'title' => '上肢トレーニング', 
		'text' => '上肢トレーニングです！', 
		'actions' => [ 
		[
		'type' => 'postback', 
		'label' => 'webhookにpost送信', 
		'data' => 'value' 
		], 
		[ 
		'type' => 'uri', 
		'label' => '女美会を見る', 
		'uri' => 'https://jobikai.com/' 
		] 
		] 
		], 
		] 
		] 
		];
} else {
	$messageData = [ 'type' => 'text', 'text' => 'その操作はできません。メニューから選択してください。' ]; 
} 
if ($type == 'postback') {
	$postback = $jsonObj->{"events"}[0]->{"postback"}->{"data"};
	parse_str($postback, $data);
	$answer = $data["ans"];
	$number = $data["num"];
	if ($number == 1) {
		$messageData = [ 'type' => 'text', 'text' => $answer . '『正解』です！！！' ]; 
	}else{
		$messageData = [ 'type' => 'text', 'text' => $answer . 'むむ、、『不正解』です。' ]; 
	}
}
$response = [ 'replyToken' => $replyToken, 'messages' => [$messageData] ]; 
error_log(json_encode($response)); 
$ch = curl_init('https://api.line.me/v2/bot/message/reply'); 
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response)); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json; charser=UTF-8', 'Authorization: Bearer ' . $accessToken )); 
$result = curl_exec($ch); error_log($result); 
curl_close($ch);

?>
