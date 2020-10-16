<?php
ini_set('display_errors', 1);

// DIを使ったパターン
///////////////////////////////////////////////////////////////////
class NindendoSwitch
{
    // スイッチで遊ぶゲームのオブジェクト
    protected $game;

    // 外部からスマブラのオブジェクトを注入
    public function __construct(SmashBros $smashBros)
    {
        print '起動中...<br>';

        // $this->game = new SmashBros();
        $this->game = $smashBros;

        print 'Switchが起動しました。<br>';
    }

    public function run()
    {
        $this->game->display();
    }
}

///////////////////////////////////////////////////////////////////

class SmashBros
{
    public function display()
    {
        print  <<< EOF
==================<br>
= SMASH BROTHERS =<br>
==================<br>
EOF;
    }
}

///////////////////////////////////////////////////////////////////

//スイッチを起動
$gameConsole = new NindendoSwitch(new SmashBros());
//ゲームを開始
$gameConsole->run();