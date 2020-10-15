<?php
ini_set('display_errors', 1);

// DIでさらに依存性を低くしたパターン

///////////////////////////////////////////////////////////////////
class NindendoSwitch
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
        print 'ゲームを起動します。<br>';
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

//スイッチを起動
$game = new SmashBros();
//$game = new MarioKart();
$console = new NindendoSwitch($game);
//ゲームを開始
$console->run();