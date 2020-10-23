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
class Output
{
    private $outputClass;

    public function __construct(OutputInterface $outputClass)
    {
        $this->outputClass = $outputClass;
    }

    public function convert($aryData)
    {
        return $this->outputClass->convert($aryData);
    }
}

/////////////////////////////////////////////////////////////////////////////////
/// 実際に使う場面
$content = [
    'hoge' => 'ホゲ',
    'foo'  => 'フー',
];

$output = new Output(new JsonStringOutput);
var_dump($output->convert($content)); //結果：string(44) "{"hoge":"\u30db\u30b2","foo":"\u30d5\u30fc"}"
