# デザインパターンデモ
## 動かす場合の注意
DI, Middleware, Singleton, State, Strategyは動かせます。

ただしDIの4と5を動かすためにはPimpleのインストールが必要です。
```
$ composer install
$ composer dump-autoload
```
で導入をお願いします。

Facadeは動きません。