<?php
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';

// DIでさらに依存性を低くしたパターン
///////////////////////////////////////////////////////////////////
/// TODO: インターフェースを追加

interface switchInterface {
    public function __construct(gameSoftInterface $game);
    public function run();
}

///////////////////////////////////////////////////////////////////
class NindendoSwitch implements switchInterface
{
    // スイッチで遊ぶゲームのオブジェクト
    protected $game;

    // 外部からゲームのオブジェクトを注入
    public function __construct(gameSoftInterface $game)
    {
        print 'Switchが起動しました。<br>';

        $this->game = $game;
    }

    public function run()
    {
        print '<br>ゲームを起動します。<br>';
        $this->game->display();
    }
}

class NindendoSwitchLite implements switchInterface
{
    // スイッチで遊ぶゲームのオブジェクト
    protected $game;

    // 外部からゲームのオブジェクトを注入
    public function __construct(gameSoftInterface $game)
    {
        print 'SwitchLiteが起動しました。<br>';

        $this->game = $game;
    }

    public function run()
    {
        print '<br>ゲームを起動します。<br>';
        $this->game->display();
    }
}

///////////////////////////////////////////////////////////////////

interface gameSoftInterface {
    public function display();
}

///////////////////////////////////////////////////////////////////

class SmashBros implements gameSoftInterface
{
    public function __construct()
    {
        print '<br>ソフトが起動しました。<br><br>';
    }

    public function display()
    {
        print <<< EOF
================<br>
== SMASH BROS ==<br>
================<br>
EOF;
    }
}

class MarioKart implements gameSoftInterface
{
    public function __construct()
    {
        print '<br>ソフトが起動しました。<br><br>';
    }

    public function display()
    {
        print <<< EOF
================<br>
== MARIO KART ==<br>
================<br>
EOF;
    }
}

///////////////////////////////////////////////////////////////////
/// ContainerDefine.php

$container = new \Pimple\Container();
$container['gameSoftInterface'] = $container->factory(function ($c) {
    // $cはDIコンテナです
    return new MarioKart();
});

$container['switchInterface'] = $container->factory(function ($c) {
    // $cはDIコンテナです
    return new NindendoSwitchLite($c['gameSoftInterface']);
});

///////////////////////////////////////////////////////////////////
/// ConsoleController.php

// ソフトのインスタンス化が不要に。
// $game = new SmashBros();
// $game = new MarioKart();
// TODO:コンソール自体もコンテナで作成
//$consoleEbina     = new NindendoSwitch($container['gameSoftInterface']);
//$consoleKishimoto = new NindendoSwitch($container['gameSoftInterface']);
//$consoleKuge      = new NindendoSwitch($container['gameSoftInterface']);
//$consoleShirakawa = new NindendoSwitch($container['gameSoftInterface']);

$ConsoleEbina     = $container['switchInterface'];
$consoleKishimoto = $container['switchInterface'];
$consoleKuge      = $container['switchInterface'];
$consoleShirakawa = $container['switchInterface'];
//ゲームを開始
$ConsoleEbina->run();
$consoleKishimoto->run();
$consoleKuge->run();
$consoleShirakawa->run();