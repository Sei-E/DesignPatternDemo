<?php
/////////////////////////////////////////////////////////////////////////////////
/// 呼び出す側のコード
class Response
{
    const SERIALIZED_RESPONSE = '01';
    const JSON_RESOPONSE      = '02';
    const ARRAY_RESPONSE      = '03';
    const OBJECT_RESPONSE     = '04';

    private $outputType;

    public function __construct($outputType)
    {
        //出力形式を設定
        $this->outputType = $outputType;
    }

    public function send($aryData)
    {
        if ($this->outputType == self::SERIALIZED_RESPONSE) {
            //シリアル化する場合
            $content = serialize($aryData);

        } elseif ($this->outputType == self::JSON_RESOPONSE) {
            // JSONレスポンスの場合
            $content = json_encode($aryData);

        } elseif ($this->outputType == self::ARRAY_RESPONSE) {
            // 配列で返す場合
            $content = $aryData;
        }
//        elseif ($this->outputType == self::OBJECT_RESPONSE) {
//            $content = json_decode(json_encode($aryData));
//        }

        var_dump($content);
    }
}

/////////////////////////////////////////////////////////////////////////////////
/// 実際に使う場面
$content = [
    'hoge' => 'ホゲ',
    'foo'  => 'フー',
];

$response = new Response('03');
$response->send($content);

