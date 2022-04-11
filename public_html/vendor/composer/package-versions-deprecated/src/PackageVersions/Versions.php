<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'ec-cube/ec-cube';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'composer/ca-bundle' => '1.2.10@9fdb22c2e97a614657716178093cd1da90a64aa8',
  'composer/composer' => '2.1.3@fc5c4573aafce3a018eb7f1f8f91cea423970f2e',
  'composer/metadata-minifier' => '1.0.0@c549d23829536f0d0e984aaabbf02af91f443207',
  'composer/package-versions-deprecated' => '1.11.99.2@c6522afe5540d5fc46675043d3ed5a45a740b27c',
  'composer/semver' => '3.2.5@31f3ea725711245195f62e54ffa402d8ef2fdba9',
  'composer/spdx-licenses' => '1.5.5@de30328a7af8680efdc03e396aad24befd513200',
  'composer/xdebug-handler' => '2.0.1@964adcdd3a28bf9ed5d9ac6450064e0d71ed7496',
  'defuse/php-encryption' => 'v2.3.1@77880488b9954b7884c25555c2a0ea9e7053f9d2',
  'doctrine/annotations' => '1.13.1@e6e7b7d5b45a2f2abc5460cc6396480b2b1d321f',
  'doctrine/cache' => '1.12.1@4cf401d14df219fa6f38b671f5493449151c9ad8',
  'doctrine/collections' => '1.6.7@55f8b799269a1a472457bd1a41b4f379d4cfba4a',
  'doctrine/common' => '2.13.3@f3812c026e557892c34ef37f6ab808a6b567da7f',
  'doctrine/data-fixtures' => '1.3.3@f0ee99c64922fc3f863715232b615c478a61b0a3',
  'doctrine/dbal' => '2.13.2@8dd39d2ead4409ce652fd4f02621060f009ea5e4',
  'doctrine/deprecations' => 'v0.5.3@9504165960a1f83cc1480e2be1dd0a0478561314',
  'doctrine/doctrine-bundle' => '1.12.13@85460b85edd8f61a16ad311e7ffc5d255d3c937c',
  'doctrine/doctrine-cache-bundle' => '1.4.0@6bee2f9b339847e8a984427353670bad4e7bdccb',
  'doctrine/doctrine-fixtures-bundle' => '3.4.0@870189619a7770f468ffb0b80925302e065a3b34',
  'doctrine/doctrine-migrations-bundle' => 'v1.3.2@49fa399181db4bf4f9f725126bd1cb65c4398dce',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'doctrine/inflector' => '1.3.1@ec3a55242203ffa6a4b27c58176da97ff0a7aec1',
  'doctrine/instantiator' => '1.4.0@d56bf6102915de5702778fe20f2de3b2fe570b5b',
  'doctrine/lexer' => '1.0.2@1febd6c3ef84253d7c815bed85fc622ad207a9f8',
  'doctrine/migrations' => 'v1.8.1@215438c0eef3e5f9b7da7d09c6b90756071b43e6',
  'doctrine/orm' => '2.7.5@01187c9260cd085529ddd1273665217cae659640',
  'doctrine/persistence' => '1.3.8@7a6eac9fb6f61bba91328f15aa7547f4806ca288',
  'doctrine/reflection' => '1.2.2@fa587178be682efe90d005e3a322590d6ebb59a5',
  'easycorp/easy-log-handler' => 'v1.0.9@224e1dfcf9455aceee89cd0af306ac097167fac1',
  'ec-cube/api' => '2.1.3@',
  'ec-cube/coupon4' => '4.1.1@',
  'ec-cube/customerclassprice4' => '2.0.0@',
  'ec-cube/customergroup' => '2.0.0@',
  'ec-cube/customergroupentry' => '2.0.0@',
  'ec-cube/kokokaraselect' => '2.1.0@',
  'ec-cube/plugin-installer' => '2.0.1@2cb574d0fda477af98b6199ddcb99e1a2c7e228a',
  'ec-cube/zeuspayment4' => '1.1.1@',
  'egulias/email-validator' => '2.1.25@0dbf5d78455d4d6a41d186da50adc1122ec066f4',
  'exercise/htmlpurifier-bundle' => 'v3.1.0@32f4709006e810efd8a72466a8e9d0672df4bc24',
  'ezyang/htmlpurifier' => 'v4.13.0@08e27c97e4c6ed02f37c5b2b20488046c8d90d75',
  'friendsofphp/php-cs-fixer' => 'v2.19.0@d5b8a9d852b292c2f8a035200fa6844b1f82300b',
  'friendsofphp/proxy-manager-lts' => 'v1.0.5@006aa5d32f887a4db4353b13b5b5095613e0611f',
  'guzzlehttp/guzzle' => '6.5.5@9d4290de1cfd701f38099ef7e183b64b4b7b0c5e',
  'guzzlehttp/promises' => '1.5.1@fe752aedc9fd8fcca3fe7ad05d419d32998a06da',
  'guzzlehttp/psr7' => '1.8.5@337e3ad8e5716c15f9657bd214d16cc5e69df268',
  'jdorn/sql-formatter' => 'v1.2.17@64990d96e0959dff8e059dfcdc1af130728d92bc',
  'justinrainbow/json-schema' => '5.2.10@2ba9c8c862ecd5510ed16c6340aa9f6eadb4f31b',
  'knplabs/knp-components' => 'v1.3.10@fc1755ba2b77f83a3d3c99e21f3026ba2a1429be',
  'knplabs/knp-paginator-bundle' => 'v2.8.0@f4ece5b347121b9fe13166264f197f90252d4bd2',
  'kylekatarnls/update-helper' => '1.2.1@429be50660ed8a196e0798e5939760f168ec8ce9',
  'laminas/laminas-code' => '3.4.1@1cb8f203389ab1482bf89c0e70a04849bacd7766',
  'laminas/laminas-eventmanager' => '3.2.1@ce4dc0bdf3b14b7f9815775af9dfee80a63b4748',
  'laminas/laminas-zendframework-bridge' => '1.1.1@6ede70583e101030bcace4dcddd648f760ddf642',
  'lcobucci/jwt' => '3.4.6@3ef8657a78278dfeae7707d51747251db4176240',
  'league/event' => '2.2.0@d2cc124cf9a3fab2bb4ff963307f60361ce4d119',
  'league/oauth2-server' => '7.4.0@2eb1cf79e59d807d89c256e7ac5e2bf8bdbd4acf',
  'mobiledetect/mobiledetectlib' => '2.8.37@9841e3c46f5bd0739b53aed8ac677fa712943df7',
  'monolog/monolog' => '1.26.1@c6b00f05152ae2c9b04a448f99c7590beb6042f5',
  'nesbot/carbon' => '1.39.1@4be0c005164249208ce1b5ca633cd57bdd42ff33',
  'nikic/php-parser' => 'v4.11.0@fe14cf3672a149364fb66dfe11bf6549af899f94',
  'nyholm/psr7' => '1.5.0@1461e07a0f2a975a52082ca3b769ca912b816226',
  'paragonie/random_compat' => 'v9.99.100@996434e5492cb4c3edcb9168db6fbb1359ef965a',
  'php-cs-fixer/diff' => 'v1.3.1@dbd31aeb251639ac0b9e7e29405c1441907f5759',
  'php-http/message-factory' => 'v1.0.2@a478cb11f66a6ac48d8954216cfed9aa06a501a1',
  'pimple/pimple' => 'v1.1.1@2019c145fe393923f3441b23f29bbdfaa5c58c4d',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'react/promise' => 'v2.8.0@f3cff96a19736714524ca0dd1d4130de73dbbbc4',
  'robthree/twofactorauth' => '1.8.0@30a38627ae1e7c9399dae67e265063cd6ec5276c',
  'seld/jsonlint' => '1.8.3@9ad6ce79c342fbd44df10ea95511a1b24dee5b57',
  'seld/phar-utils' => '1.1.1@8674b1d84ffb47cc59a101f5d5a3b61e87d23796',
  'sensio/framework-extra-bundle' => 'v5.5.7@6c0fa4e0e6dc3be90f7b40fa832aa47ec7dd801a',
  'setasign/fpdi' => 'v2.3.6@6231e315f73e4f62d72b73f3d6d78ff0eed93c31',
  'setasign/fpdi-tcpdf' => 'v2.3.0@f6711a95cba64db16e1a63e1b6195827a2150c93',
  'skorp/detect-incompatible-samesite-useragents' => '1.0.1@e3277efe3c12ac618af4536ba1bdb55c33c1ef80',
  'suncat/mobile-detect-bundle' => 'v1.1.1@06007fec624587fd90e8963b796fc84fff64d4d8',
  'swiftmailer/swiftmailer' => 'v6.2.7@15f7faf8508e04471f666633addacf54c0ab5933',
  'symfony/asset' => 'v4.4.25@a6b30fd4a9c992667b38d6f13efb20446761980a',
  'symfony/cache' => 'v4.4.26@fcdbaf8af546939eeed5e32399656da2ad371aaf',
  'symfony/cache-contracts' => 'v1.1.10@8d5489c10ef90aa7413e4921fc3c0520e24cbed7',
  'symfony/config' => 'v4.4.26@1cb26cdb8a9834d8494cadd284602fa0647b73e5',
  'symfony/console' => 'v4.4.26@9aa1eb46c1b12fada74dc0c529e93d1ccef22576',
  'symfony/css-selector' => 'v4.4.25@c1e29de6dc893b130b45d20d8051efbb040560a9',
  'symfony/debug' => 'v4.4.25@a8d2d5c94438548bff9f998ca874e202bb29d07f',
  'symfony/debug-bundle' => 'v4.4.20@1e136a4c6d8c2364b77e31c5bf124660cff6d084',
  'symfony/debug-pack' => 'v1.0.9@cfd5093378e9cafe500f05c777a22fe8a64a9342',
  'symfony/dependency-injection' => 'v4.4.26@a944d2f8e903dc99f5f1baf3eb74081352f0067f',
  'symfony/deprecation-contracts' => 'v2.5.0@6f981ee24cf69ee7ce9736146d1c57c2780598a8',
  'symfony/doctrine-bridge' => 'v4.4.25@6b88860981116fcddb2ff91043dfc8ad458e5e14',
  'symfony/dom-crawler' => 'v4.4.25@41d15bb6d6b95d2be763c514bb2494215d9c5eef',
  'symfony/dotenv' => 'v4.4.25@744c09920fbf1850860f399112e82ced4d19aed0',
  'symfony/error-handler' => 'v4.4.26@4001f01153d0eb5496fe11d8c76d1e56b47fdb88',
  'symfony/event-dispatcher' => 'v4.4.25@047773e7016e4fd45102cedf4bd2558ae0d0c32f',
  'symfony/event-dispatcher-contracts' => 'v1.1.9@84e23fdcd2517bf37aecbd16967e83f0caee25a7',
  'symfony/expression-language' => 'v4.4.25@4515f7d3fa614a23c7acc1162d7ef069c165d7af',
  'symfony/filesystem' => 'v4.4.26@a501126eb6ec9288a3434af01b3d4499ec1268a0',
  'symfony/finder' => 'v4.4.25@ed33314396d968a8936c95f5bd1b88bd3b3e94a3',
  'symfony/flex' => 'v1.13.3@2597d0dda8042c43eed44a9cd07236b897e427d7',
  'symfony/form' => 'v4.4.26@c0b7a80561f45b2970f77c4a7958224189c126c0',
  'symfony/framework-bundle' => 'v4.4.26@fb29db31d6a1bb69271009c47ce19d59c6fef25a',
  'symfony/http-client-contracts' => 'v1.1.10@7e86f903f9720d0caa7688f5c29a2de2d77cbb89',
  'symfony/http-foundation' => 'v4.4.26@8759ed5c27c2a8a47cb60f367f4be6727f08d58b',
  'symfony/http-kernel' => 'v4.4.26@e08b2fb8a6eedd81c70522e514bad9b2c1fff881',
  'symfony/inflector' => 'v4.4.25@fc695ab721136b27aa84427a0fa80189761266ef',
  'symfony/intl' => 'v4.4.25@1a9d799a68e7f1caad20bfb0fae5b2d44871cf71',
  'symfony/maker-bundle' => 'v1.33.0@f093d906c667cba7e3f74487d9e5e55aaf25a031',
  'symfony/mime' => 'v5.2.1@de97005aef7426ba008c46ba840fc301df577ada',
  'symfony/monolog-bridge' => 'v4.4.26@f399c9d13a20ce3385e750fbe18e91b6ea8044d3',
  'symfony/monolog-bundle' => 'v3.7.0@4054b2e940a25195ae15f0a49ab0c51718922eb4',
  'symfony/options-resolver' => 'v4.4.25@2e607d627c70aa56284a02d34fc60dfe3a9a352e',
  'symfony/orm-pack' => 'v1.0.8@c9bcc08102061f406dc908192c0f33524a675666',
  'symfony/polyfill-ctype' => 'v1.23.0@46cd95797e9df938fdd2b03693b5fca5e64b01ce',
  'symfony/polyfill-iconv' => 'v1.23.0@63b5bb7db83e5673936d6e3b8b3e022ff6474933',
  'symfony/polyfill-intl-icu' => 'v1.23.0@4a80a521d6176870b6445cfb469c130f9cae1dda',
  'symfony/polyfill-intl-idn' => 'v1.25.0@749045c69efb97c70d25d7463abba812e91f3a44',
  'symfony/polyfill-intl-normalizer' => 'v1.25.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.25.0@0abb51d2f102e00a4eefcf46ba7fec406d245825',
  'symfony/polyfill-php70' => 'v1.20.0@5f03a781d984aae42cebd18e7912fa80f02ee644',
  'symfony/polyfill-php72' => 'v1.25.0@9a142215a36a3888e30d0a9eeea9766764e96976',
  'symfony/polyfill-php73' => 'v1.23.0@fba8933c384d6476ab14fb7b8526e5287ca7e010',
  'symfony/polyfill-php80' => 'v1.25.0@4407588e0d3f1f52efb65fbe92babe41f37fe50c',
  'symfony/polyfill-php81' => 'v1.23.0@e66119f3de95efc359483f810c4c3e6436279436',
  'symfony/process' => 'v4.4.26@7e812c84c3f2dba173d311de6e510edf701685a8',
  'symfony/profiler-pack' => 'v1.0.5@29ec66471082b4eb068db11eb4f0a48c277653f7',
  'symfony/property-access' => 'v4.4.25@3af7c21b4128eadbace0800b51054a81bff896c6',
  'symfony/proxy-manager-bridge' => 'v4.4.25@1b3ca99d59d210cf159d165b301a9a9492d93bd4',
  'symfony/psr-http-message-bridge' => 'v1.3.0@9d3e80d54d9ae747ad573cad796e8e247df7b796',
  'symfony/routing' => 'v4.4.25@3a3c2f197ad0846ac6413225fc78868ba1c61434',
  'symfony/security' => 'v4.4.26@64b34827d764ef3cd2c86f3f6a3c56742efbfde5',
  'symfony/security-bundle' => 'v4.4.26@48329a558dcfdc9ccb27dc08fc53ac72c4bdfd35',
  'symfony/serializer' => 'v4.4.26@24f5f3024401c97b0c6f1874568369bdd1a378d9',
  'symfony/service-contracts' => 'v1.1.9@b776d18b303a39f56c63747bcb977ad4b27aca26',
  'symfony/stopwatch' => 'v4.4.25@80d9ae0c8a02bd291abf372764c0fc68cbd06c42',
  'symfony/swiftmailer-bundle' => 'v3.5.2@6b72355549f02823a2209180f9c035e46ca3f178',
  'symfony/templating' => 'v4.4.25@7b280e4252aeb029db4084b6a76531d8a8cd58f7',
  'symfony/translation' => 'v4.4.26@2f7fa60b8d10ca71c30dc46b0870143183a8f131',
  'symfony/translation-contracts' => 'v1.1.10@84180a25fad31e23bebd26ca09d89464f082cacc',
  'symfony/twig-bridge' => 'v4.4.26@9d02487374439164ef508824977ecdd146b9509f',
  'symfony/twig-bundle' => 'v4.4.26@1aab630e70f0ab1b77529e7f061c9e5f1f11dca7',
  'symfony/validator' => 'v4.4.26@1f20bad74b6d62f1a5779eeed47e91f3fa476094',
  'symfony/var-dumper' => 'v4.4.26@a586efdf2aa832d05b9249e9115d24f6a2691160',
  'symfony/var-exporter' => 'v4.4.26@ac8cd05f3a70ee2805070ebdf7a0e0ddea574f91',
  'symfony/web-profiler-bundle' => 'v4.4.26@686ce278ef5f37358e829bd6d9ab12a67352d363',
  'symfony/web-server-bundle' => 'v4.4.26@7aaea9666309f7d6375d2f07ef53c4777f16950c',
  'symfony/workflow' => 'v4.4.25@a37e3c105070b2f9cdf0ebf0226c0e8ff5430fd0',
  'symfony/yaml' => 'v4.4.26@e096ef4b4c4c9a2f72c2ac660f54352cd31c60f8',
  'tecnickcom/tcpdf' => '6.4.1@5ba838befdb37ef06a16d9f716f35eb03cb1b329',
  'trikoder/oauth2-bundle' => 'v2.1.1@119fa85c91c1b487583cd7c9b31a9a821b2eb87c',
  'twig/extensions' => 'v1.5.4@57873c8b0c1be51caa47df2cdb824490beb16202',
  'twig/twig' => 'v2.13.1@57e96259776ddcacf1814885fc3950460c8e18ef',
  'vlucas/phpdotenv' => 'v2.4.0@3cc116adbe4b11be5ec557bf1d24dc5e3a21d18c',
  'webonyx/graphql-php' => 'v14.11.5@ffa431c0821821839370a68dab3c2597c06bf7f0',
  'behat/gherkin' => 'v4.7.3@d5ae4616aeaa91daadbfb8446d9d17aae8d43cf7',
  'bheller/images-generator' => '1.0.1@50b61fe1dcf1b72b6a830debec4db22afd1e8ee1',
  'captbaritone/mailcatcher-codeception-module' => '1.2.1@75ba9aa803d81780ee7e9b5c36bb5b8f9139d972',
  'codeception/codeception' => '4.1.21@c25f20d842a7e3fa0a8e6abf0828f102c914d419',
  'codeception/lib-asserts' => '1.13.2@184231d5eab66bc69afd6b9429344d80c67a33b6',
  'codeception/lib-innerbrowser' => '1.5.0@4b0d89b37fe454e060a610a85280a87ab4f534f1',
  'codeception/module-asserts' => '1.3.1@59374f2fef0cabb9e8ddb53277e85cdca74328de',
  'codeception/module-phpbrowser' => '1.0.2@770a6be4160a5c0c08d100dd51bff35f6056bbf1',
  'codeception/module-rest' => '1.3.1@293a0103d5257b7c884ef276147a9a06914e878f',
  'codeception/module-webdriver' => '1.2.1@ebbe729c630415e8caf6b0087e457906f0c6c0c6',
  'codeception/phpunit-wrapper' => '7.8.2@cafed18048826790c527843f9b85e8cc79b866f1',
  'codeception/stub' => '3.0.0@eea518711d736eab838c1274593c4568ec06b23d',
  'dama/doctrine-test-bundle' => 'v5.0.5@a60b0712f4659eab710c49783713b4b43e3c3149',
  'fzaninotto/faker' => 'v1.9.2@848d8125239d7dbf8ab25cb7f054f1a630e68c2e',
  'mikey179/vfsstream' => 'v1.6.9@2257e326dc3d0f50e55d0a90f71e37899f029718',
  'myclabs/deep-copy' => '1.10.2@776f831124e9c62e1a2c601ecc52e776d8bb7220',
  'phar-io/manifest' => '1.0.3@7761fcacf03b4d4f16e7ccb606d4879ca431fcf4',
  'phar-io/version' => '2.0.1@45a2ec53a73c70ce41d55cedef9063630abaf1b6',
  'php-webdriver/webdriver' => '1.11.1@da16e39968f8dd5cfb7d07eef91dc2b731c69880',
  'phpdocumentor/reflection-common' => '2.1.0@6568f4687e5b41b054365f9ae03fcb1ed5f2069b',
  'phpdocumentor/reflection-docblock' => '4.3.4@da3fd972d6bafd628114f7e7e036f45944b62e9c',
  'phpdocumentor/type-resolver' => '1.0.1@2e32a6d48972b2c1976ed5d8967145b6cec4a4a9',
  'phpspec/prophecy' => 'v1.10.3@451c3cd1418cf640de218914901e51b064abb093',
  'phpstan/phpstan' => '0.12.92@64d4c5dc8ea96972bc18432d137a330239a5d2b2',
  'phpunit/php-code-coverage' => '6.1.4@807e6013b00af69b6c5d9ceb4282d0393dbb9d8d',
  'phpunit/php-file-iterator' => '2.0.4@28af674ff175d0768a5a978e6de83f697d4a7f05',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.3@2454ae1765516d20c4ffe103d85a58a9a3bd5662',
  'phpunit/php-token-stream' => '3.1.2@472b687829041c24b25f475e14c2f38a09edf1c2',
  'phpunit/phpunit' => '7.5.20@9467db479d1b0487c99733bb1e7944d32deded2c',
  'sebastian/code-unit-reverse-lookup' => '1.0.2@1de8cd5c010cb153fcd68b8d0f64606f523f7619',
  'sebastian/comparator' => '3.0.3@1071dfcef776a57013124ff35e1fc41ccd294758',
  'sebastian/diff' => '3.0.3@14f72dd46eaf2f2293cbe79c93cc0bc43161a211',
  'sebastian/environment' => '4.2.4@d47bbbad83711771f167c72d4e3f25f7fcc1f8b0',
  'sebastian/exporter' => '3.1.3@6b853149eab67d4da22291d36f5b0631c0fd856e',
  'sebastian/global-state' => '2.0.0@e8ba02eed7bbbb9e59e43dedd3dddeff4a56b0c4',
  'sebastian/object-enumerator' => '3.0.4@e67f6d32ebd0c749cf9d1dbd9f226c727043cdf2',
  'sebastian/object-reflector' => '1.1.2@9b8772b9cbd456ab45d4a598d2dd1a1bced6363d',
  'sebastian/recursion-context' => '3.0.1@367dcba38d6e1977be014dc4b22f47a484dac7fb',
  'sebastian/resource-operations' => '2.0.2@31d35ca87926450c44eae7e2611d45a7a65ea8b3',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'softcreatr/jsonpath' => '0.7.5@008569bf80aa3584834f7890781576bc7b65afa7',
  'symfony/browser-kit' => 'v4.4.25@729b1f0eca3ef18ea4e1a29b166145aff75d8fa1',
  'symfony/phpunit-bridge' => 'v4.4.26@279ffbf294759a57839afc884ccabef9a1155b23',
  'theseer/tokenizer' => '1.1.3@11336f6f84e16a720dae9d8e6ed5019efa85a0f9',
  'webmozart/assert' => '1.9.1@bafc69caeb4d49c39fd0779086c03a3738cbb389',
  'ec-cube/ec-cube' => 'dev-master@4b7b7f3934288c2a818dd8589b31e59447eea7d5',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!class_exists(InstalledVersions::class, false) || !(method_exists(InstalledVersions::class, 'getAllRawData') ? InstalledVersions::getAllRawData() : InstalledVersions::getRawData())) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (class_exists(InstalledVersions::class, false) && (method_exists(InstalledVersions::class, 'getAllRawData') ? InstalledVersions::getAllRawData() : InstalledVersions::getRawData())) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}
