<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5df13c662a6b2b2693f055c17f1b8540
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc2734\\WP_View_Controller\\' => 27,
            'Inc2734\\WP_Share_Buttons\\' => 25,
            'Inc2734\\WP_SEO\\' => 15,
            'Inc2734\\WP_Pure_CSS_Gallery\\' => 28,
            'Inc2734\\WP_Profile_Box\\' => 23,
            'Inc2734\\WP_Plugin_View_Controller\\' => 34,
            'Inc2734\\WP_Page_Speed_Optimization\\' => 35,
            'Inc2734\\WP_OGP\\' => 15,
            'Inc2734\\WP_OEmbed_Blog_Card\\' => 28,
            'Inc2734\\WP_Like_Me_Box\\' => 23,
            'Inc2734\\WP_Helper\\' => 18,
            'Inc2734\\WP_Google_Fonts\\' => 24,
            'Inc2734\\WP_GitHub_Theme_Updater\\' => 32,
            'Inc2734\\WP_Customizer_Framework\\' => 32,
            'Inc2734\\WP_Custom_CSS_To_Editor\\' => 32,
            'Inc2734\\WP_Contents_Outline\\' => 28,
            'Inc2734\\WP_Breadcrumbs\\' => 23,
            'Inc2734\\WP_Basis\\' => 17,
            'Inc2734\\WP_Awesome_Widgets\\' => 27,
            'Inc2734\\WP_Awesome_Components\\' => 30,
            'Inc2734\\WP_Adsense\\' => 19,
        ),
        'F' => 
        array (
            'Framework\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc2734\\WP_View_Controller\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-view-controller/src',
        ),
        'Inc2734\\WP_Share_Buttons\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-share-buttons/src',
        ),
        'Inc2734\\WP_SEO\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-seo/src',
        ),
        'Inc2734\\WP_Pure_CSS_Gallery\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-pure-css-gallery/src',
        ),
        'Inc2734\\WP_Profile_Box\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-profile-box/src',
        ),
        'Inc2734\\WP_Plugin_View_Controller\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-plugin-view-controller/src',
        ),
        'Inc2734\\WP_Page_Speed_Optimization\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-page-speed-optimization/src',
        ),
        'Inc2734\\WP_OGP\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-ogp/src',
        ),
        'Inc2734\\WP_OEmbed_Blog_Card\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-oembed-blog-card/src',
        ),
        'Inc2734\\WP_Like_Me_Box\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-like-me-box/src',
        ),
        'Inc2734\\WP_Helper\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-helper/src',
        ),
        'Inc2734\\WP_Google_Fonts\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-google-fonts/src',
        ),
        'Inc2734\\WP_GitHub_Theme_Updater\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-github-theme-updater/src',
        ),
        'Inc2734\\WP_Customizer_Framework\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-customizer-framework/src',
        ),
        'Inc2734\\WP_Custom_CSS_To_Editor\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-custom-css-to-editor/src',
        ),
        'Inc2734\\WP_Contents_Outline\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-contents-outline/src',
        ),
        'Inc2734\\WP_Breadcrumbs\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-breadcrumbs/src',
        ),
        'Inc2734\\WP_Basis\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-basis/src',
        ),
        'Inc2734\\WP_Awesome_Widgets\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-awesome-widgets/src',
        ),
        'Inc2734\\WP_Awesome_Components\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-awesome-components/src',
        ),
        'Inc2734\\WP_Adsense\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-adsense/src',
        ),
        'Framework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Framework',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5df13c662a6b2b2693f055c17f1b8540::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5df13c662a6b2b2693f055c17f1b8540::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5df13c662a6b2b2693f055c17f1b8540::$classMap;

        }, null, ClassLoader::class);
    }
}
