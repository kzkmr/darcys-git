cd /home/icecream/public_html

trait の実装ができたら、 bin/console eccube:generate:proxies コマンドで Proxy クラスを生成します。
[root@dzx-shop public_html]# php bin/console eccube:generate:proxies

## 作成した Proxy クラスを確実に認識できるようキャッシュを削除
[root@dzx-shop public_html]# php bin/console cache:clear --no-warmup

## 実行する SQL を確認
[root@dzx-shop public_html]# php bin/console doctrine:schema:update --dump-sql

## SQL を実行
[root@dzx-shop public_html]# php bin/console doctrine:schema:update --dump-sql --force
