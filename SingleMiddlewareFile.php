<?php
////////////////////////////////////////////////////
/// 入出力を定義

//入力----------------------------------
interface RequestInterface
{
}

class Request implements RequestInterface
{
}

//出力-------------------------------------

interface ResponseInterface
{
}

class Response implements ResponseInterface
{
}

////////////////////////////////////////////////////
/// ハンドラ(コントローラ)とミドルウェアを定義

// ハンドラ-----------------------------------------

// ハンドラのインターフェース
interface HttpHandlerInterface
{
    // リクエストからレスポンスを作成する処理を実行。レスポンスを返す。
    function handle(RequestInterface $request): ResponseInterface;
}

// ハンドラの具象クラス(所謂コントローラ)
class HttpHandler implements HttpHandlerInterface
{
    public function handle(RequestInterface $request): ResponseInterface
    {
        print 'コントローラ<br>';

        return new Response();
    }
}

// ミドルウェア--------------------------------------

// インターフェース
interface MiddlewareInterface
{
    public function process(RequestInterface $request, HttpHandlerInterface $next): ResponseInterface;
}

// ハンドラより前に実行するミドルウェア
class BeforeMiddleware implements MiddlewareInterface
{
    public function process(RequestInterface $request, HttpHandlerInterface $next): ResponseInterface
    {
        // ハンドラより先に実行したい場合は$next->handle($request)より前に処理を記述
        print '⬇BeforeMiddleware 通過<br>';

        // 次のMiddlewareHandler(後述)を呼び出す。
        return $next->handle($request);
    }
}

// ハンドラより後に実行するミドルウェア
class AfterMiddleware implements MiddlewareInterface
{
    public function process(RequestInterface $request, HttpHandlerInterface $next): ResponseInterface
    {
        // 自身が処理を行う前に次のMiddlewareHandler(後述)を呼び出す
        $response = $next->handle($request);

        // ハンドラより後に実行したい場合は$next->handle($request)の後に処理を記述
        print '⬇AfterMiddleware 通過<br>';
        return $response;
    }
}


////////////////////////////////////////////////////
/// ミドルウェアとハンドラのアダプタクラスを定義

//middlewareとhttpHandler(処理アクション)のインターフェースを変換して
//どちらもハンドラのインターフェースで同列に扱えるようにするアダプタクラス
class MiddlewareHandler implements HttpHandlerInterface
{
    /**
     * このインスタンスで実行するミドルウェア
     *
     * @var MiddlewareInterface
     */
    private $middleware;

    /**
     * この次に実行したいミドルウェアとハンドラが詰まったパイプライン
     * ミドルウェア内の$nextの中身
     *
     * @var HttpHandlerInterface Kernelで関数合成されたハンドラとミドルウェア
     */
    private $pipeline;

    public function __construct(MiddlewareInterface $middleware, HttpHandlerInterface $pipleline)
    {
        $this->middleware = $middleware;
        $this->pipeline = $pipleline;
    }

    /**
     * ミドルウェアを実行するとともに次に実行するパイプライン($this->pipeline)を渡す。
     * ミドルウェア内での$next->handleの実体
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    function handle(RequestInterface $request): ResponseInterface
    {
        return $this->middleware->process($request, $this->pipeline);
    }
}

////////////////////////////////////////////////////
/// 入出力を定義

class Kernel
{
    protected $_middlewares;

    //==============================================================================
    //処理
    //==============================================================================

    public function __construct()
    {
        //実行するミドルウェアを登録
        $this->_bootstrap();
    }

    protected function _bootstrap() {
        $this->_middlewares = [
            BeforeMiddleware::class,
            AfterMiddleware::class,
        ];
    }


    public function build(): HttpHandlerInterface
    {
        //配列とは逆の順番でミドルウェアが実行されるため、事前に配列を反転させて、記入した順に実行されるようにする。
        $middlewares = array_reverse($this->_middlewares);
        //初期化式
        $pipeline = new HttpHandler;
        //関数合成を行う
        //MiddlewareHandlerの中にMiddlewareとMiddlewareHandler($pipeline)を入れることを繰り返す。
        foreach ($middlewares as $middleware) {
            $objMiddleware = new $middleware;
            $pipeline = new MiddlewareHandler($objMiddleware, $pipeline);
        }
        return $pipeline;
    }

    public function handle(RequestInterface $request, HttpHandlerInterface $pipeline):ResponseInterface
    {
        // MiddlewareHandlerのhandleメソッドを実行
        return $pipeline->handle($request);
    }

}

////////////////////////////////////////////////////
/// クライアントコード
$request = new Request();

$kernel = new Kernel();
// ミドルウェアとハンドラの一連の流れを作成
$pipeline = $kernel->build();

// ミドルウェアとハンドラの処理が次々と実行される。
$request = $kernel->handle($request, $pipeline);
