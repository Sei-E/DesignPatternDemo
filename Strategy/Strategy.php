<?php
ini_set('display_errors', 1);

/////////////////////////////////////////////////////////////////////////////////
/// インターフェースとその実装クラスを準備
interface OutputInterface
{
    public function convert($aryData);
}

class SerializedOutput implements OutputInterface
{
    public function convert($aryData)
    {
        return serialize($aryData);
    }
}

class JsonStringOutput implements OutputInterface
{
    public function convert($aryData)
    {
        return json_encode($aryData);
    }
}

class ArrayOutput implements OutputInterface
{
    public function convert($aryData)
    {
        return $aryData;
    }
}

//class ObjectOutput implements OutputInterface
//{
//    public function convert($aryData)
//    {
//        return json_decode(json_encode($aryData));
//    }
//}

/////////////////////////////////////////////////////////////////////////////////
/// 呼び出す側のコード
class Response
{
    private $outputClass;

    public function __construct(OutputInterface $outputClass)
    {
        $this->outputClass = $outputClass;
    }

    public function send($aryData)
    {
        $content = $this->outputClass->convert($aryData);
        var_dump($content);
    }
}

/////////////////////////////////////////////////////////////////////////////////
/// 実際に使う場面
$content = [
    'hoge' => 'ホゲ',
    'foo'  => 'フー',
];

$response = new Response(new JsonStringOutput);
$response->send($content);
