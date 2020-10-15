<?php
class Singleton {
    /** @type  Singleton */
    private static $instance;


    // コンストラクタをprivateにすることで、他のクラスが勝手にインスタンスを作ることを不可能にする。
    private function __construct() {
        echo '初回のインスタンス化<br>';
    }

    // クラスメソッドでインスタンス化して、オブジェクトを返す
    public static function getInstance() {
        if ( ! isset( static::$instance ) ) {
            static::$instance = new Singleton();
        }

        return static::$instance;
    }

    public function describe() {
        echo 'object_id: ' . spl_object_hash( $this ) . '<br>';
    }
}
//////////////////////////////////////////////////////////////////////////

$obj1 = Singleton::getInstance();
$obj2 = Singleton::getInstance();
$obj3 = Singleton::getInstance();

/// 3つとも同じオブジェクトIDを持つ
$obj1->describe();
$obj2->describe();
$obj3->describe();