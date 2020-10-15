<?php
ini_set('display_errors', 1);

// DIじゃないパターン

///////////////////////////////////////////////////////////////////
class NindendoSwitch
{
    // スイッチで遊ぶゲームのオブジェクト
    protected $game;

    public function __construct()
    {
        print 'Switchが起動しました。<br>';

        $this->game = new SmashBros();
    }

    public function run()
    {
        $this->game->display();
    }
}

///////////////////////////////////////////////////////////////////
// ゲームソフト
class SmashBros
{
    public function __construct()
    {
        print '<br>ソフトが起動しました。<br>';
    }

    public function display()
    {
        print <<< EOF
==================<br>
= SMASH BROTHERS =<br>
==================<br>
EOF;
    }
}

///////////////////////////////////////////////////////////////////

//スイッチを起動
$gameConsole = new NindendoSwitch();
//ゲームを開始
$gameConsole->run();