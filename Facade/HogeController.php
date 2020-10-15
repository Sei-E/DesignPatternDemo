<?php

// フォームから送られてきたデータを登録するクラス(動かないです。)
class HogeController
{
    public function storeAction()
    {
        // CSRF(ワンタイム)トークンのチェック
        if (! CSRF::check('showForm')) {
            //チェックに失敗したら例外を投げる
            throw new Exception('CSRFトークンが確認できませんでした。');
        }

        //登録処理
        $database = new Database();
        $database->store();
        return 'hoge';
    }

    public function storeActionWithoutFacade()
    {
        // Facadeで実装していたコード
        //---------------------------------------------
        $request = new Request;
        $session = new Session;

        $key = 'showForm';

        //フォームから送られてきたトークンの値を取得
        $token = $request->getPost('_token');

        $key = 'csrf_tokens/' . $key;
        $tokens = $session->get($key, []);

        if (($pos = array_search($token, $tokens, true)) !== false) {
            unset($tokens[$pos]);
            $session->set($key, $tokens);

            $result = true;
        }
        $result = false;
        //---------------------------------------------

        // CSRFトークンのチェック
        if (! CSRF::check('showForm')) {
            //チェックに失敗したら例外を投げる
            throw new Exception('CSRFトークンが確認できませんでした。');
        }

        //登録処理
        $database = new Database();
        $database->store();
        return 'hoge';
    }
}