<?php
/* レクサスRX専門高価買取JP 無料査定フォーム送信ハンドラ
   POST(JSON) → carshopglory.yasuda@gmail.com 宛にメール送信 */
header('Content-Type: application/json; charset=utf-8');

$TO      = 'carshopglory.yasuda@gmail.com';
$SUBJECT = '【レクサスRX査定依頼】無料査定フォーム';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['ok' => false, 'error' => 'method']); exit;
}

$raw  = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) { $data = $_POST; }

// 必須チェック
$required = ['year','mileage_range','smoking','sell_timing','name','tel','email','contact_method'];
foreach ($required as $k) {
  if (empty($data[$k])) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'required:'.$k]); exit;
  }
}
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo json_encode(['ok' => false, 'error' => 'email']); exit;
}

// ラベル定義
$labels = [
  'grade'=>'グレード','equipment'=>'装備','equipment_other'=>'その他装備',
  'year'=>'年式','month'=>'月','mileage_range'=>'走行距離','mileage_exact'=>'走行距離(正確)',
  'color'=>'車体カラー','other_estimate'=>'他社査定額','hope_price'=>'希望金額',
  'purchase_condition'=>'購入時の状態','repair'=>'修復歴','damage_detail'=>'ダメージ詳細',
  'smoking'=>'喫煙状態','sell_timing'=>'売却予定時期',
  'name'=>'お名前','kana'=>'フリガナ','tel'=>'電話番号','email'=>'メールアドレス',
  'contact_method'=>'希望連絡方法','message'=>'備考',
];

$lines = [];
foreach ($labels as $key => $label) {
  if (!isset($data[$key]) || $data[$key] === '' || $data[$key] === []) continue;
  $v = $data[$key];
  if (is_array($v)) $v = implode(' / ', $v);
  $lines[] = $label.'：'.$v;
}
$body = "レクサスRX査定依頼フォームより送信されました。\n\n".implode("\n", $lines)."\n";

// ヘッダ
$from     = 'no-reply@'.($_SERVER['SERVER_NAME'] ?? 'localhost');
$headers  = "From: レクサスRX専門高価買取JP <{$from}>\r\n";
$headers .= "Reply-To: ".$data['email']."\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

mb_language('Japanese');
mb_internal_encoding('UTF-8');

$ok = @mb_send_mail($TO, $SUBJECT, $body, $headers);
if ($ok) {
  echo json_encode(['ok' => true]);
} else {
  http_response_code(500);
  echo json_encode(['ok' => false, 'error' => 'mail']);
}
