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
//define('WP_CACHE', true);
//define( 'WPCACHEHOME', '/home/benechantest/darcys-factory.co.jp/public_html/shop/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'offshore2022_wp1' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'offshore2022_wp1' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'jqy46do3ca' );

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
define('AUTH_KEY',         '?APi=^DK.U#*d$CVe/2g7 L ZO[{+;&UzE-;<@qNY%HoJbcikd62`Z%/e/D#^f|L');
define('SECURE_AUTH_KEY',  '|F)n[4l0fiq!3WK(WuCD7q)xIbL!M8X4VkVo+d?eRC#qDJ>Zr)=`><AU66c`|{lH');
define('LOGGED_IN_KEY',    ':l;SS,07[XQr|ISeJ698=(79/znb-jRxO~^dTPRT8LJ#X/-d7iE+|8|u6Fw)e06,');
define('NONCE_KEY',        '<EeEhK)7|#kZNcSTc+@[fHpoX-ZLq|?|-+tlR8Z ~->OI9?* AC?|++h()SLRn]z');
define('AUTH_SALT',        'yg4u+Yyqf4eH=RTFmKcYT{H(~#k-l}9Tb4;%5+HPSE1|htZ}*Hq&1XTMU-i=]~op');
define('SECURE_AUTH_SALT', '?)h<>fy.D{<q+UeD_~ak$!cp?l;4`!n;m*6>pLq$#a{Ikq@m!~hNv4(j+ObXtLR,');
define('LOGGED_IN_SALT',   'YBk|l2Z#SgV/=ZEIeO0A;{~|&}fk([;a$PtSM3BrB9s]-{hv,W]<)Q&[b1YXoxrf');
define('NONCE_SALT',       'j=%3BM56u!J)Y7g/ 3Nc1lx=Ro-|O}A=kOV7 WNE^!CY/:f6fWwAUuCq;I,X-K+n');

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
