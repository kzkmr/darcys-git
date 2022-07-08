<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'offshore2022_wp2' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'offshore2022_wp2' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', '2c4aq5mqz0' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'localhost' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '?<5 mg2>`_$6bE.D.HfC-[fs|T {r`0cOj~$kihMOM| eImK{>6tMP>Oa]a+J:0<');
define('SECURE_AUTH_KEY',  'jedsO|OXPLwJv;BZ(*7wxok?<O5Y4qVS-8I,H1ZKr.MD1K}JZn4I,0?X>p2kq7rh');
define('LOGGED_IN_KEY',    'mOeV}5o+iS_uU%wdI[h]6Ul+2&Z__N-M&i_YU#RQ5cbb:SeSKU:T+e.SoQu=ojNk');
define('NONCE_KEY',        '+_Sg;$xIZ)mr}2fhdJ5w^q$!hKSPK(Gjf0$>J~! q?t!3b@hffdT`<k3=IiJJBCe');
define('AUTH_SALT',        '~ms;!5I^LZYR-HVkub:6_);rUcFr^^vZ:]*bs-{Lb,McVjz2XM$91:Ysg.,1w%, ');
define('SECURE_AUTH_SALT', 'gT&o>#41DsWk3C3B(7k4T7^a%1c$,|M|*_3Z;^&)0(oAb[Dg!yo*2([f[V0cPu]i');
define('LOGGED_IN_SALT',   'BK1Z-lnf+B9j|]0~;!X?#t+X^s}$uyexxfoju7e{2].#T%W91^.RpL//E4+KdsU9');
define('NONCE_SALT',       'Ro<}1OeVD%CDPw)&(|vcaISx5yNP2~P^/,_{aVIMJ<Eo=*>%aoZ*2p9KIMdGu6~6');
/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY',true);
ini_set('display_errors',1);
error_reporting(E_ALL);

/* カスタム値は、この行と「編集が必要なのはここまでです」の行の間に追加してください。 */



/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
