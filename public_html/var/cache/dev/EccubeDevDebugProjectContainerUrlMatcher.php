<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class EccubeDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = [];
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        if (0 === strpos($pathinfo, '/_')) {
            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => '_twig_error_test']), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not__twig_error_test;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, '_twig_error_test', key($requiredSchemes)));
                }

                return $ret;
            }
            not__twig_error_test:

            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => '_wdt']), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not__wdt;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, '_wdt', key($requiredSchemes)));
                }

                return $ret;
            }
            not__wdt:

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not__profiler_home;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', '_profiler_home'));
                    }

                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not__profiler_home;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, '_profiler_home', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not__profiler_home:

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        $ret = array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not__profiler_search;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, '_profiler_search', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not__profiler_search:

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        $ret = array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not__profiler_search_bar;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, '_profiler_search_bar', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not__profiler_search_bar:

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not__profiler_phpinfo;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, '_profiler_phpinfo', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not__profiler_phpinfo:

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_search_results']), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not__profiler_search_results;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, '_profiler_search_results', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not__profiler_search_results:

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not__profiler_open_file;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, '_profiler_open_file', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not__profiler_open_file:

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler']), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not__profiler;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, '_profiler', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not__profiler:

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_router']), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not__profiler_router;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, '_profiler_router', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not__profiler_router:

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_exception']), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not__profiler_exception;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, '_profiler_exception', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not__profiler_exception:

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_exception_css']), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not__profiler_exception_css;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, '_profiler_exception_css', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not__profiler_exception_css:

            }

        }

        elseif (0 === strpos($pathinfo, '/administrator')) {
            // admin_login
            if ('/administrator/login' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\AdminController::login',  '_route' => 'admin_login',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_admin_login;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_login', key($requiredSchemes)));
                }

                return $ret;
            }
            not_admin_login:

            // admin_homepage
            if ('/administrator' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\AdminController::index',  '_route' => 'admin_homepage',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_admin_homepage;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'admin_homepage'));
                }

                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_admin_homepage;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_homepage', key($requiredSchemes)));
                }

                return $ret;
            }
            not_admin_homepage:

            if (0 === strpos($pathinfo, '/administrator/s')) {
                // admin_homepage_sale
                if ('/administrator/sale_chart' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\AdminController::sale',  '_route' => 'admin_homepage_sale',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_homepage_sale;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_homepage_sale', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_homepage_sale:

                if (0 === strpos($pathinfo, '/administrator/se')) {
                    // admin_homepage_nonstock
                    if ('/administrator/search_nonstock' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\AdminController::searchNonStockProducts',  '_route' => 'admin_homepage_nonstock',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_homepage_nonstock;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_homepage_nonstock', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_homepage_nonstock:

                    // admin_homepage_customer
                    if ('/administrator/search_customer' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\AdminController::searchCustomer',  '_route' => 'admin_homepage_customer',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_homepage_customer;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_homepage_customer', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_homepage_customer:

                    if (0 === strpos($pathinfo, '/administrator/setting/shop')) {
                        // admin_setting_shop_csv
                        if (0 === strpos($pathinfo, '/administrator/setting/shop/csv') && preg_match('#^/administrator/setting/shop/csv(?:/(?P<id>\\d+))?$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_shop_csv']), array (  'id' => 3,  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\CsvController::index',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_setting_shop_csv;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_csv', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_setting_shop_csv:

                        if (0 === strpos($pathinfo, '/administrator/setting/shop/delivery')) {
                            // admin_setting_shop_delivery
                            if ('/administrator/setting/shop/delivery' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\DeliveryController::index',  '_route' => 'admin_setting_shop_delivery',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_delivery;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_delivery', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_delivery:

                            // admin_setting_shop_delivery_new
                            if ('/administrator/setting/shop/delivery/new' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\DeliveryController::edit',  '_route' => 'admin_setting_shop_delivery_new',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_delivery_new;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_delivery_new', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_delivery_new:

                            // admin_setting_shop_delivery_edit
                            if (preg_match('#^/administrator/setting/shop/delivery/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_shop_delivery_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\DeliveryController::edit',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_delivery_edit;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_delivery_edit', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_delivery_edit:

                            // admin_setting_shop_delivery_delete
                            if (preg_match('#^/administrator/setting/shop/delivery/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_shop_delivery_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\DeliveryController::delete',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['DELETE'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['DELETE']);
                                    }
                                    goto not_admin_setting_shop_delivery_delete;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_delivery_delete;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_delivery_delete', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_delivery_delete:

                            // admin_setting_shop_delivery_visibility
                            if (preg_match('#^/administrator/setting/shop/delivery/(?P<id>\\d+)/visibility$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_shop_delivery_visibility']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\DeliveryController::visibility',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['PUT'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['PUT']);
                                    }
                                    goto not_admin_setting_shop_delivery_visibility;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_delivery_visibility;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_delivery_visibility', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_delivery_visibility:

                            // admin_setting_shop_delivery_sort_no_move
                            if ('/administrator/setting/shop/delivery/sort_no/move' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\DeliveryController::moveSortNo',  '_route' => 'admin_setting_shop_delivery_sort_no_move',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['POST'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['POST']);
                                    }
                                    goto not_admin_setting_shop_delivery_sort_no_move;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_delivery_sort_no_move;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_delivery_sort_no_move', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_delivery_sort_no_move:

                        }

                        elseif (0 === strpos($pathinfo, '/administrator/setting/shop/mail')) {
                            // admin_setting_shop_mail
                            if ('/administrator/setting/shop/mail' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\MailController::index',  '_route' => 'admin_setting_shop_mail',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_mail;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_mail', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_mail:

                            // admin_setting_shop_mail_edit
                            if (preg_match('#^/administrator/setting/shop/mail/(?P<id>\\d+)$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_shop_mail_edit']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\MailController::index',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_mail_edit;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_mail_edit', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_mail_edit:

                            // admin_setting_shop_mail_preview
                            if ('/administrator/setting/shop/mail/preview' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\MailController::preview',  '_route' => 'admin_setting_shop_mail_preview',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_mail_preview;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_mail_preview', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_mail_preview:

                        }

                        elseif (0 === strpos($pathinfo, '/administrator/setting/shop/payment')) {
                            // admin_setting_shop_payment
                            if ('/administrator/setting/shop/payment' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\PaymentController::index',  '_route' => 'admin_setting_shop_payment',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_payment;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_payment', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_payment:

                            // admin_setting_shop_payment_new
                            if ('/administrator/setting/shop/payment/new' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\PaymentController::edit',  '_route' => 'admin_setting_shop_payment_new',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_payment_new;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_payment_new', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_payment_new:

                            // admin_setting_shop_payment_edit
                            if (preg_match('#^/administrator/setting/shop/payment/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_shop_payment_edit']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\PaymentController::edit',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_payment_edit;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_payment_edit', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_payment_edit:

                            // admin_payment_image_add
                            if ('/administrator/setting/shop/payment/image/add' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\PaymentController::imageAdd',  '_route' => 'admin_payment_image_add',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_payment_image_add;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_payment_image_add', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_payment_image_add:

                            // admin_setting_shop_payment_delete
                            if (preg_match('#^/administrator/setting/shop/payment/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_shop_payment_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\PaymentController::delete',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['DELETE'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['DELETE']);
                                    }
                                    goto not_admin_setting_shop_payment_delete;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_payment_delete;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_payment_delete', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_payment_delete:

                            // admin_setting_shop_payment_visible
                            if (preg_match('#^/administrator/setting/shop/payment/(?P<id>\\d+)/visible$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_shop_payment_visible']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\PaymentController::visible',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['PUT'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['PUT']);
                                    }
                                    goto not_admin_setting_shop_payment_visible;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_payment_visible;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_payment_visible', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_payment_visible:

                            // admin_setting_shop_payment_sort_no_move
                            if ('/administrator/setting/shop/payment/sort_no/move' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\PaymentController::moveSortNo',  '_route' => 'admin_setting_shop_payment_sort_no_move',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['POST'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['POST']);
                                    }
                                    goto not_admin_setting_shop_payment_sort_no_move;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_payment_sort_no_move;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_payment_sort_no_move', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_payment_sort_no_move:

                        }

                        // admin_setting_shop
                        if ('/administrator/setting/shop' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\ShopController::index',  '_route' => 'admin_setting_shop',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_setting_shop;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_setting_shop:

                        if (0 === strpos($pathinfo, '/administrator/setting/shop/tax')) {
                            // admin_setting_shop_tax
                            if ('/administrator/setting/shop/tax' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\TaxRuleController::index',  '_route' => 'admin_setting_shop_tax',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_tax;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_tax', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_tax:

                            // admin_setting_shop_tax_new
                            if ('/administrator/setting/shop/tax/new' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\TaxRuleController::index',  '_route' => 'admin_setting_shop_tax_new',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_tax_new;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_tax_new', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_tax_new:

                            // admin_setting_shop_tax_delete
                            if (preg_match('#^/administrator/setting/shop/tax/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_shop_tax_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\Shop\\TaxRuleController::delete',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['DELETE'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['DELETE']);
                                    }
                                    goto not_admin_setting_shop_tax_delete;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_shop_tax_delete;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_shop_tax_delete', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_shop_tax_delete:

                        }

                    }

                    elseif (0 === strpos($pathinfo, '/administrator/setting/system')) {
                        // admin_setting_system_authority
                        if ('/administrator/setting/system/authority' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\AuthorityController::index',  '_route' => 'admin_setting_system_authority',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_setting_system_authority;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_authority', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_setting_system_authority:

                        // admin_setting_system_log
                        if ('/administrator/setting/system/log' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\LogController::index',  '_route' => 'admin_setting_system_log',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_setting_system_log;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_log', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_setting_system_log:

                        if (0 === strpos($pathinfo, '/administrator/setting/system/masterdata')) {
                            // admin_setting_system_masterdata
                            if ('/administrator/setting/system/masterdata' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\MasterdataController::index',  '_route' => 'admin_setting_system_masterdata',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_masterdata;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_masterdata', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_masterdata:

                            // admin_setting_system_masterdata_view
                            if (preg_match('#^/administrator/setting/system/masterdata/(?P<entity>[^/]++)/edit$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_system_masterdata_view']), array (  'entity' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\MasterdataController::index',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_masterdata_view;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_masterdata_view', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_masterdata_view:

                            // admin_setting_system_masterdata_edit
                            if ('/administrator/setting/system/masterdata/edit' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\MasterdataController::edit',  '_route' => 'admin_setting_system_masterdata_edit',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_masterdata_edit;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_masterdata_edit', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_masterdata_edit:

                        }

                        elseif (0 === strpos($pathinfo, '/administrator/setting/system/member')) {
                            // admin_setting_system_member
                            if ('/administrator/setting/system/member' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\MemberController::index',  '_route' => 'admin_setting_system_member',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_member;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_member', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_member:

                            // admin_setting_system_member_new
                            if ('/administrator/setting/system/member/new' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\MemberController::create',  '_route' => 'admin_setting_system_member_new',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_member_new;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_member_new', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_member_new:

                            // admin_setting_system_member_edit
                            if (preg_match('#^/administrator/setting/system/member/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_system_member_edit']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\MemberController::edit',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_member_edit;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_member_edit', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_member_edit:

                            // admin_setting_system_member_up
                            if (preg_match('#^/administrator/setting/system/member/(?P<id>\\d+)/up$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_system_member_up']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\MemberController::up',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['PUT'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['PUT']);
                                    }
                                    goto not_admin_setting_system_member_up;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_member_up;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_member_up', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_member_up:

                            // admin_setting_system_member_down
                            if (preg_match('#^/administrator/setting/system/member/(?P<id>\\d+)/down$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_system_member_down']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\MemberController::down',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['PUT'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['PUT']);
                                    }
                                    goto not_admin_setting_system_member_down;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_member_down;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_member_down', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_member_down:

                            // admin_setting_system_member_delete
                            if (preg_match('#^/administrator/setting/system/member/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_setting_system_member_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\MemberController::delete',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['DELETE'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['DELETE']);
                                    }
                                    goto not_admin_setting_system_member_delete;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_member_delete;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_member_delete', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_member_delete:

                        }

                        // admin_setting_system_security
                        if ('/administrator/setting/system/security' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\SecurityController::index',  '_route' => 'admin_setting_system_security',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_setting_system_security;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_security', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_setting_system_security:

                        if (0 === strpos($pathinfo, '/administrator/setting/system/system')) {
                            // admin_setting_system_system
                            if ('/administrator/setting/system/system' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\SystemController::index',  '_route' => 'admin_setting_system_system',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_system;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_system', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_system:

                            // admin_setting_system_system_phpinfo
                            if ('/administrator/setting/system/system/phpinfo' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Setting\\System\\SystemController::phpinfo',  '_route' => 'admin_setting_system_system_phpinfo',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_setting_system_system_phpinfo;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_setting_system_system_phpinfo', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_setting_system_system_phpinfo:

                        }

                    }

                }

                elseif (0 === strpos($pathinfo, '/administrator/shipping')) {
                    // admin_shipping_update_order_status
                    if (preg_match('#^/administrator/shipping/(?P<id>\\d+)/order_status$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_shipping_update_order_status']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\OrderController::updateOrderStatus',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['PUT'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['PUT']);
                            }
                            goto not_admin_shipping_update_order_status;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_shipping_update_order_status;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_shipping_update_order_status', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_shipping_update_order_status:

                    // admin_shipping_update_tracking_number
                    if (preg_match('#^/administrator/shipping/(?P<id>\\d+)/tracking_number$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_shipping_update_tracking_number']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\OrderController::updateTrackingNumber',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['PUT'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['PUT']);
                            }
                            goto not_admin_shipping_update_tracking_number;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_shipping_update_tracking_number;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_shipping_update_tracking_number', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_shipping_update_tracking_number:

                    // admin_shipping_edit
                    if (preg_match('#^/administrator/shipping/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_shipping_edit']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\ShippingController::index',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_shipping_edit;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_shipping_edit', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_shipping_edit:

                    // admin_shipping_preview_notify_mail
                    if (0 === strpos($pathinfo, '/administrator/shipping/preview_notify_mail') && preg_match('#^/administrator/shipping/preview_notify_mail/(?P<id>\\d+)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_shipping_preview_notify_mail']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\ShippingController::previewShippingNotifyMail',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_shipping_preview_notify_mail;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_shipping_preview_notify_mail', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_shipping_preview_notify_mail:

                    // admin_shipping_notify_mail
                    if (0 === strpos($pathinfo, '/administrator/shipping/notify_mail') && preg_match('#^/administrator/shipping/notify_mail/(?P<id>\\d+)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_shipping_notify_mail']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\ShippingController::notifyMail',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['PUT'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['PUT']);
                            }
                            goto not_admin_shipping_notify_mail;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_shipping_notify_mail;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_shipping_notify_mail', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_shipping_notify_mail:

                }

                elseif (0 === strpos($pathinfo, '/administrator/store/plugin')) {
                    if (0 === strpos($pathinfo, '/administrator/store/plugin/api')) {
                        if (0 === strpos($pathinfo, '/administrator/store/plugin/api/search')) {
                            // admin_store_plugin_owners_search
                            if ('/administrator/store/plugin/api/search' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\OwnerStoreController::search',  '_route' => 'admin_store_plugin_owners_search',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_store_plugin_owners_search;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_owners_search', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_store_plugin_owners_search:

                            // admin_store_plugin_owners_search_page
                            if (0 === strpos($pathinfo, '/administrator/store/plugin/api/search/page') && preg_match('#^/administrator/store/plugin/api/search/page(?:/(?P<page_no>\\d+))?$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_store_plugin_owners_search_page']), array (  'page_no' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Store\\OwnerStoreController::search',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_store_plugin_owners_search_page;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_owners_search_page', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_store_plugin_owners_search_page:

                        }

                        // admin_store_plugin_api_schema_update
                        if ('/administrator/store/plugin/api/schema_update' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\OwnerStoreController::apiSchemaUpdate',  '_route' => 'admin_store_plugin_api_schema_update',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['POST'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['POST']);
                                }
                                goto not_admin_store_plugin_api_schema_update;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_store_plugin_api_schema_update;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_api_schema_update', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_store_plugin_api_schema_update:

                        if (0 === strpos($pathinfo, '/administrator/store/plugin/api/install')) {
                            // admin_store_plugin_install_confirm
                            if (preg_match('#^/administrator/store/plugin/api/install/(?P<id>\\d+)/confirm$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_store_plugin_install_confirm']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\OwnerStoreController::doConfirm',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_store_plugin_install_confirm;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_install_confirm', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_store_plugin_install_confirm:

                            // admin_store_plugin_api_install
                            if ('/administrator/store/plugin/api/install' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\OwnerStoreController::apiInstall',  '_route' => 'admin_store_plugin_api_install',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['POST'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['POST']);
                                    }
                                    goto not_admin_store_plugin_api_install;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_store_plugin_api_install;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_api_install', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_store_plugin_api_install:

                        }

                        // admin_store_plugin_api_uninstall
                        if (0 === strpos($pathinfo, '/administrator/store/plugin/api/delete') && preg_match('#^/administrator/store/plugin/api/delete/(?P<id>\\d+)/uninstall$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_store_plugin_api_uninstall']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\OwnerStoreController::apiUninstall',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['DELETE'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['DELETE']);
                                }
                                goto not_admin_store_plugin_api_uninstall;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_store_plugin_api_uninstall;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_api_uninstall', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_store_plugin_api_uninstall:

                        if (0 === strpos($pathinfo, '/administrator/store/plugin/api/upgrade')) {
                            // admin_store_plugin_api_upgrade
                            if ('/administrator/store/plugin/api/upgrade' === $pathinfo) {
                                $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\OwnerStoreController::apiUpgrade',  '_route' => 'admin_store_plugin_api_upgrade',);
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                                if (!in_array($requestMethod, ['POST'])) {
                                    if ($hasRequiredScheme) {
                                        $allow = array_merge($allow, ['POST']);
                                    }
                                    goto not_admin_store_plugin_api_upgrade;
                                }
                                if (!$hasRequiredScheme) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_store_plugin_api_upgrade;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_api_upgrade', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_store_plugin_api_upgrade:

                            // admin_store_plugin_update_confirm
                            if (preg_match('#^/administrator/store/plugin/api/upgrade/(?P<id>\\d+)/confirm$#sD', $pathinfo, $matches)) {
                                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_store_plugin_update_confirm']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\OwnerStoreController::doUpdateConfirm',));
                                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                                if (!isset($requiredSchemes[$context->getScheme()])) {
                                    if ('GET' !== $canonicalMethod) {
                                        goto not_admin_store_plugin_update_confirm;
                                    }

                                    return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_update_confirm', key($requiredSchemes)));
                                }

                                return $ret;
                            }
                            not_admin_store_plugin_update_confirm:

                        }

                        // admin_store_plugin_api_update
                        if ('/administrator/store/plugin/api/update' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\OwnerStoreController::apiUpdate',  '_route' => 'admin_store_plugin_api_update',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['POST'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['POST']);
                                }
                                goto not_admin_store_plugin_api_update;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_store_plugin_api_update;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_api_update', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_store_plugin_api_update:

                    }

                    // admin_store_plugin
                    if ('/administrator/store/plugin' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\PluginController::index',  '_route' => 'admin_store_plugin',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_plugin;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_plugin:

                    // admin_store_plugin_update
                    if (preg_match('#^/administrator/store/plugin/(?P<id>\\d+)/update$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_store_plugin_update']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\PluginController::update',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['POST'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['POST']);
                            }
                            goto not_admin_store_plugin_update;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_plugin_update;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_update', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_plugin_update:

                    // admin_store_plugin_enable
                    if (preg_match('#^/administrator/store/plugin/(?P<id>\\d+)/enable$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_store_plugin_enable']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\PluginController::enable',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['POST'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['POST']);
                            }
                            goto not_admin_store_plugin_enable;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_plugin_enable;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_enable', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_plugin_enable:

                    // admin_store_plugin_disable
                    if (preg_match('#^/administrator/store/plugin/(?P<id>\\d+)/disable$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_store_plugin_disable']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\PluginController::disable',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['POST'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['POST']);
                            }
                            goto not_admin_store_plugin_disable;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_plugin_disable;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_disable', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_plugin_disable:

                    // admin_store_plugin_uninstall
                    if (preg_match('#^/administrator/store/plugin/(?P<id>\\d+)/uninstall$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_store_plugin_uninstall']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\PluginController::uninstall',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['DELETE'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['DELETE']);
                            }
                            goto not_admin_store_plugin_uninstall;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_plugin_uninstall;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_uninstall', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_plugin_uninstall:

                    // admin_store_plugin_install
                    if ('/administrator/store/plugin/install' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\PluginController::install',  '_route' => 'admin_store_plugin_install',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_plugin_install;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_plugin_install', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_plugin_install:

                    // admin_store_authentication_setting
                    if ('/administrator/store/plugin/authentication_setting' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\PluginController::authenticationSetting',  '_route' => 'admin_store_authentication_setting',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_authentication_setting;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_authentication_setting', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_authentication_setting:

                }

                elseif (0 === strpos($pathinfo, '/administrator/store/template')) {
                    // admin_store_template
                    if ('/administrator/store/template' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\TemplateController::index',  '_route' => 'admin_store_template',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_template;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_template', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_template:

                    // admin_store_template_download
                    if (preg_match('#^/administrator/store/template/(?P<id>\\d+)/download$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_store_template_download']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\TemplateController::download',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_template_download;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_template_download', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_template_download:

                    // admin_store_template_delete
                    if (preg_match('#^/administrator/store/template/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_store_template_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\TemplateController::delete',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['DELETE'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['DELETE']);
                            }
                            goto not_admin_store_template_delete;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_template_delete;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_template_delete', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_template_delete:

                    // admin_store_template_install
                    if ('/administrator/store/template/install' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Store\\TemplateController::install',  '_route' => 'admin_store_template_install',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_store_template_install;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_store_template_install', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_store_template_install:

                }

            }

            elseif (0 === strpos($pathinfo, '/administrator/c')) {
                // admin_change_password
                if ('/administrator/change_password' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\AdminController::changePassword',  '_route' => 'admin_change_password',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_change_password;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_change_password', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_change_password:

                if (0 === strpos($pathinfo, '/administrator/content')) {
                    if (0 === strpos($pathinfo, '/administrator/content/block')) {
                        // admin_content_block
                        if ('/administrator/content/block' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\BlockController::index',  '_route' => 'admin_content_block',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_block;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_block', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_block:

                        // admin_content_block_new
                        if ('/administrator/content/block/new' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\BlockController::edit',  '_route' => 'admin_content_block_new',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_block_new;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_block_new', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_block_new:

                        // admin_content_block_edit
                        if (preg_match('#^/administrator/content/block/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_content_block_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Content\\BlockController::edit',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_block_edit;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_block_edit', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_block_edit:

                        // admin_content_block_delete
                        if (preg_match('#^/administrator/content/block/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_content_block_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\BlockController::delete',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['DELETE'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['DELETE']);
                                }
                                goto not_admin_content_block_delete;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_block_delete;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_block_delete', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_block_delete:

                    }

                    // admin_content_cache
                    if ('/administrator/content/cache' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\CacheController::index',  '_route' => 'admin_content_cache',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_content_cache;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_cache', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_content_cache:

                    // admin_content_css
                    if ('/administrator/content/css' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\CssController::index',  '_route' => 'admin_content_css',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_content_css;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_css', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_content_css:

                    if (0 === strpos($pathinfo, '/administrator/content/file_')) {
                        // admin_content_file
                        if ('/administrator/content/file_manager' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\FileController::index',  '_route' => 'admin_content_file',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_file;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_file', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_file:

                        // admin_content_file_view
                        if ('/administrator/content/file_view' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\FileController::view',  '_route' => 'admin_content_file_view',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_file_view;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_file_view', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_file_view:

                        // admin_content_file_delete
                        if ('/administrator/content/file_delete' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\FileController::delete',  '_route' => 'admin_content_file_delete',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['DELETE'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['DELETE']);
                                }
                                goto not_admin_content_file_delete;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_file_delete;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_file_delete', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_file_delete:

                        // admin_content_file_download
                        if ('/administrator/content/file_download' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\FileController::download',  '_route' => 'admin_content_file_download',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_file_download;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_file_download', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_file_download:

                    }

                    // admin_content_js
                    if ('/administrator/content/js' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\JsController::index',  '_route' => 'admin_content_js',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_content_js;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_js', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_content_js:

                    if (0 === strpos($pathinfo, '/administrator/content/layout')) {
                        // admin_content_layout
                        if ('/administrator/content/layout' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\LayoutController::index',  '_route' => 'admin_content_layout',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_layout;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_layout', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_layout:

                        // admin_content_layout_delete
                        if (preg_match('#^/administrator/content/layout/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_content_layout_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\LayoutController::delete',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['DELETE'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['DELETE']);
                                }
                                goto not_admin_content_layout_delete;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_layout_delete;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_layout_delete', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_layout_delete:

                        // admin_content_layout_new
                        if ('/administrator/content/layout/new' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\LayoutController::edit',  '_route' => 'admin_content_layout_new',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_layout_new;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_layout_new', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_layout_new:

                        // admin_content_layout_edit
                        if (preg_match('#^/administrator/content/layout/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_content_layout_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Content\\LayoutController::edit',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_layout_edit;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_layout_edit', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_layout_edit:

                        // admin_content_layout_view_block
                        if ('/administrator/content/layout/view_block' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\LayoutController::viewBlock',  '_route' => 'admin_content_layout_view_block',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($canonicalMethod, ['GET'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['GET']);
                                }
                                goto not_admin_content_layout_view_block;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_layout_view_block;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_layout_view_block', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_layout_view_block:

                        // admin_content_layout_preview
                        if (preg_match('#^/administrator/content/layout/(?P<id>\\d+)/preview$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_content_layout_preview']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\LayoutController::preview',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_layout_preview;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_layout_preview', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_layout_preview:

                    }

                    // admin_content_maintenance
                    if ('/administrator/content/maintenance' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\MaintenanceController::index',  '_route' => 'admin_content_maintenance',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_content_maintenance;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_maintenance', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_content_maintenance:

                    if (0 === strpos($pathinfo, '/administrator/content/news')) {
                        // admin_content_news
                        if ('/administrator/content/news' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\NewsController::index',  '_route' => 'admin_content_news',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_news;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_news', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_news:

                        // admin_content_news_page
                        if (0 === strpos($pathinfo, '/administrator/content/news/page') && preg_match('#^/administrator/content/news/page(?:/(?P<page_no>\\d+))?$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_content_news_page']), array (  'page_no' => 1,  '_controller' => 'Eccube\\Controller\\Admin\\Content\\NewsController::index',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_news_page;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_news_page', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_news_page:

                        // admin_content_news_new
                        if ('/administrator/content/news/new' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\NewsController::edit',  '_route' => 'admin_content_news_new',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_news_new;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_news_new', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_news_new:

                        // admin_content_news_edit
                        if (preg_match('#^/administrator/content/news/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_content_news_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Content\\NewsController::edit',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_news_edit;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_news_edit', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_news_edit:

                        // admin_content_news_delete
                        if (preg_match('#^/administrator/content/news/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_content_news_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\NewsController::delete',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['DELETE'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['DELETE']);
                                }
                                goto not_admin_content_news_delete;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_news_delete;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_news_delete', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_news_delete:

                    }

                    elseif (0 === strpos($pathinfo, '/administrator/content/page')) {
                        // admin_content_page
                        if ('/administrator/content/page' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\PageController::index',  '_route' => 'admin_content_page',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_page;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_page', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_page:

                        // admin_content_page_new
                        if ('/administrator/content/page/new' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Content\\PageController::edit',  '_route' => 'admin_content_page_new',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_page_new;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_page_new', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_page_new:

                        // admin_content_page_edit
                        if (preg_match('#^/administrator/content/page/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_content_page_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Content\\PageController::edit',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_page_edit;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_page_edit', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_page_edit:

                        // admin_content_page_delete
                        if (preg_match('#^/administrator/content/page/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_content_page_delete']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Content\\PageController::delete',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['DELETE'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['DELETE']);
                                }
                                goto not_admin_content_page_delete;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_content_page_delete;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_content_page_delete', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_content_page_delete:

                    }

                }

                elseif (0 === strpos($pathinfo, '/administrator/customer')) {
                    // admin_customer
                    if ('/administrator/customer' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Customer\\CustomerController::index',  '_route' => 'admin_customer',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_customer;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_customer', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_customer:

                    // admin_customer_page
                    if (0 === strpos($pathinfo, '/administrator/customer/page') && preg_match('#^/administrator/customer/page(?:/(?P<page_no>\\d+))?$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_customer_page']), array (  'page_no' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Customer\\CustomerController::index',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_customer_page;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_customer_page', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_customer_page:

                    // admin_customer_resend
                    if (preg_match('#^/administrator/customer/(?P<id>\\d+)/resend$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_customer_resend']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Customer\\CustomerController::resend',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_customer_resend;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_customer_resend', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_customer_resend:

                    // admin_customer_delete
                    if (preg_match('#^/administrator/customer/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_customer_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Customer\\CustomerController::delete',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['DELETE'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['DELETE']);
                            }
                            goto not_admin_customer_delete;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_customer_delete;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_customer_delete', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_customer_delete:

                    // admin_customer_export
                    if ('/administrator/customer/export' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Customer\\CustomerController::export',  '_route' => 'admin_customer_export',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_customer_export;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_customer_export', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_customer_export:

                    // admin_customer_delivery_new
                    if (preg_match('#^/administrator/customer/(?P<id>\\d+)/delivery/new$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_customer_delivery_new']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Customer\\CustomerDeliveryEditController::edit',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_customer_delivery_new;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_customer_delivery_new', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_customer_delivery_new:

                    // admin_customer_delivery_edit
                    if (preg_match('#^/administrator/customer/(?P<id>\\d+)/delivery/(?P<did>\\d+)/edit$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_customer_delivery_edit']), array (  'did' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Customer\\CustomerDeliveryEditController::edit',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_customer_delivery_edit;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_customer_delivery_edit', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_customer_delivery_edit:

                    // admin_customer_delivery_delete
                    if (preg_match('#^/administrator/customer/(?P<id>\\d+)/delivery/(?P<did>\\d+)/delete$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_customer_delivery_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Customer\\CustomerDeliveryEditController::delete',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['DELETE'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['DELETE']);
                            }
                            goto not_admin_customer_delivery_delete;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_customer_delivery_delete;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_customer_delivery_delete', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_customer_delivery_delete:

                    // admin_customer_new
                    if ('/administrator/customer/new' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Customer\\CustomerEditController::index',  '_route' => 'admin_customer_new',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_customer_new;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_customer_new', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_customer_new:

                    // admin_customer_edit
                    if (preg_match('#^/administrator/customer/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_customer_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Customer\\CustomerEditController::index',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_customer_edit;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_customer_edit', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_customer_edit:

                }

            }

            elseif (0 === strpos($pathinfo, '/administrator/order')) {
                // admin_shipping_csv_import
                if ('/administrator/order/shipping_csv_upload' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\CsvImportController::csvShipping',  '_route' => 'admin_shipping_csv_import',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_shipping_csv_import;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_shipping_csv_import', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_shipping_csv_import:

                // admin_shipping_csv_template
                if ('/administrator/order/csv_template' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\CsvImportController::csvTemplate',  '_route' => 'admin_shipping_csv_template',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_shipping_csv_template;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_shipping_csv_template', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_shipping_csv_template:

                // admin_order_new
                if ('/administrator/order/new' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\EditController::index',  '_route' => 'admin_order_new',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_order_new;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_new', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_order_new:

                // admin_order_edit
                if (preg_match('#^/administrator/order/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_order_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Order\\EditController::index',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_order_edit;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_edit', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_order_edit:

                if (0 === strpos($pathinfo, '/administrator/order/search')) {
                    if (0 === strpos($pathinfo, '/administrator/order/search/customer/html')) {
                        // admin_order_search_customer_html
                        if ('/administrator/order/search/customer/html' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\EditController::searchCustomerHtml',  '_route' => 'admin_order_search_customer_html',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_order_search_customer_html;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_search_customer_html', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_order_search_customer_html:

                        // admin_order_search_customer_html_page
                        if (0 === strpos($pathinfo, '/administrator/order/search/customer/html/page') && preg_match('#^/administrator/order/search/customer/html/page(?:/(?P<page_no>[^/]++))?$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_order_search_customer_html_page']), array (  'page_no' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Order\\EditController::searchCustomerHtml',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_order_search_customer_html_page;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_search_customer_html_page', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_order_search_customer_html_page:

                    }

                    // admin_order_search_customer_by_id
                    if ('/administrator/order/search/customer/id' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\EditController::searchCustomerById',  '_route' => 'admin_order_search_customer_by_id',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['POST'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['POST']);
                            }
                            goto not_admin_order_search_customer_by_id;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_order_search_customer_by_id;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_search_customer_by_id', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_order_search_customer_by_id:

                    if (0 === strpos($pathinfo, '/administrator/order/search/product')) {
                        // admin_order_search_product
                        if ('/administrator/order/search/product' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\EditController::searchProduct',  '_route' => 'admin_order_search_product',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_order_search_product;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_search_product', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_order_search_product:

                        // admin_order_search_product_page
                        if (0 === strpos($pathinfo, '/administrator/order/search/product/page') && preg_match('#^/administrator/order/search/product/page(?:/(?P<page_no>\\d+))?$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_order_search_product_page']), array (  'page_no' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Order\\EditController::searchProduct',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_order_search_product_page;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_search_product_page', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_order_search_product_page:

                    }

                    // admin_order_search_order_item_type
                    if ('/administrator/order/search/order_item_type' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\EditController::searchOrderItemType',  '_route' => 'admin_order_search_order_item_type',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_order_search_order_item_type;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_search_order_item_type', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_order_search_order_item_type:

                }

                // admin_order_mail
                if (preg_match('#^/administrator/order/(?P<id>\\d+)/mail$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_order_mail']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\MailController::index',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_order_mail;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_mail', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_order_mail:

                // admin_order_mail_view
                if ('/administrator/order/mail/view' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\MailController::view',  '_route' => 'admin_order_mail_view',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_order_mail_view;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_mail_view', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_order_mail_view:

                // admin_order
                if ('/administrator/order' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\OrderController::index',  '_route' => 'admin_order',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_order;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_order:

                // admin_order_page
                if (0 === strpos($pathinfo, '/administrator/order/page') && preg_match('#^/administrator/order/page(?:/(?P<page_no>\\d+))?$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_order_page']), array (  'page_no' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Order\\OrderController::index',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_order_page;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_page', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_order_page:

                // admin_order_bulk_delete
                if ('/administrator/order/bulk_delete' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\OrderController::bulkDelete',  '_route' => 'admin_order_bulk_delete',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                    if (!in_array($requestMethod, ['POST'])) {
                        if ($hasRequiredScheme) {
                            $allow = array_merge($allow, ['POST']);
                        }
                        goto not_admin_order_bulk_delete;
                    }
                    if (!$hasRequiredScheme) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_order_bulk_delete;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_bulk_delete', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_order_bulk_delete:

                if (0 === strpos($pathinfo, '/administrator/order/export')) {
                    // admin_order_export_order
                    if ('/administrator/order/export/order' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\OrderController::exportOrder',  '_route' => 'admin_order_export_order',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_order_export_order;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_export_order', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_order_export_order:

                    // admin_order_export_shipping
                    if ('/administrator/order/export/shipping' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\OrderController::exportShipping',  '_route' => 'admin_order_export_shipping',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_order_export_shipping;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_export_shipping', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_order_export_shipping:

                    if (0 === strpos($pathinfo, '/administrator/order/export/pdf')) {
                        // admin_order_export_pdf
                        if ('/administrator/order/export/pdf' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\OrderController::exportPdf',  '_route' => 'admin_order_export_pdf',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_order_export_pdf;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_export_pdf', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_order_export_pdf:

                        // admin_order_pdf_download
                        if ('/administrator/order/export/pdf/download' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Order\\OrderController::exportPdfDownload',  '_route' => 'admin_order_pdf_download',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_order_pdf_download;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_order_pdf_download', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_order_pdf_download:

                    }

                }

            }

            elseif (0 === strpos($pathinfo, '/administrator/product')) {
                if (0 === strpos($pathinfo, '/administrator/product/c')) {
                    if (0 === strpos($pathinfo, '/administrator/product/category')) {
                        // admin_product_category
                        if ('/administrator/product/category' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\CategoryController::index',  '_route' => 'admin_product_category',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_category;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_category', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_category:

                        // admin_product_category_show
                        if (preg_match('#^/administrator/product/category(?:/(?P<parent_id>\\d+))?$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_category_show']), array (  'parent_id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Product\\CategoryController::index',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_category_show;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_category_show', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_category_show:

                        // admin_product_category_edit
                        if (preg_match('#^/administrator/product/category/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_category_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Product\\CategoryController::index',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_category_edit;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_category_edit', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_category_edit:

                        // admin_product_category_delete
                        if (preg_match('#^/administrator/product/category/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_category_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\CategoryController::delete',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['DELETE'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['DELETE']);
                                }
                                goto not_admin_product_category_delete;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_category_delete;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_category_delete', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_category_delete:

                        // admin_product_category_sort_no_move
                        if ('/administrator/product/category/sort_no/move' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\CategoryController::moveSortNo',  '_route' => 'admin_product_category_sort_no_move',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['POST'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['POST']);
                                }
                                goto not_admin_product_category_sort_no_move;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_category_sort_no_move;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_category_sort_no_move', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_category_sort_no_move:

                        // admin_product_category_export
                        if ('/administrator/product/category/export' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\CategoryController::export',  '_route' => 'admin_product_category_export',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_category_export;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_category_export', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_category_export:

                        // admin_product_category_csv_import
                        if ('/administrator/product/category_csv_upload' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\CsvImportController::csvCategory',  '_route' => 'admin_product_category_csv_import',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_category_csv_import;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_category_csv_import', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_category_csv_import:

                    }

                    elseif (0 === strpos($pathinfo, '/administrator/product/class_category')) {
                        // admin_product_class_category
                        if (preg_match('#^/administrator/product/class_category/(?P<class_name_id>\\d+)$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_class_category']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ClassCategoryController::index',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_class_category;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_class_category', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_class_category:

                        // admin_product_class_category_edit
                        if (preg_match('#^/administrator/product/class_category/(?P<class_name_id>\\d+)/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_class_category_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ClassCategoryController::index',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_class_category_edit;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_class_category_edit', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_class_category_edit:

                        // admin_product_class_category_delete
                        if (preg_match('#^/administrator/product/class_category/(?P<class_name_id>\\d+)/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_class_category_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ClassCategoryController::delete',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['DELETE'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['DELETE']);
                                }
                                goto not_admin_product_class_category_delete;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_class_category_delete;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_class_category_delete', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_class_category_delete:

                        // admin_product_class_category_visibility
                        if (preg_match('#^/administrator/product/class_category/(?P<class_name_id>\\d+)/(?P<id>\\d+)/visibility$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_class_category_visibility']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ClassCategoryController::visibility',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['PUT'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['PUT']);
                                }
                                goto not_admin_product_class_category_visibility;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_class_category_visibility;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_class_category_visibility', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_class_category_visibility:

                        // admin_product_class_category_sort_no_move
                        if ('/administrator/product/class_category/sort_no/move' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ClassCategoryController::moveSortNo',  '_route' => 'admin_product_class_category_sort_no_move',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['POST'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['POST']);
                                }
                                goto not_admin_product_class_category_sort_no_move;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_class_category_sort_no_move;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_class_category_sort_no_move', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_class_category_sort_no_move:

                    }

                    elseif (0 === strpos($pathinfo, '/administrator/product/class_name')) {
                        // admin_product_class_name
                        if ('/administrator/product/class_name' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ClassNameController::index',  '_route' => 'admin_product_class_name',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_class_name;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_class_name', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_class_name:

                        // admin_product_class_name_edit
                        if (preg_match('#^/administrator/product/class_name/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_class_name_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ClassNameController::index',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            if (!isset($requiredSchemes[$context->getScheme()])) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_class_name_edit;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_class_name_edit', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_class_name_edit:

                        // admin_product_class_name_delete
                        if (preg_match('#^/administrator/product/class_name/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_class_name_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ClassNameController::delete',));
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['DELETE'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['DELETE']);
                                }
                                goto not_admin_product_class_name_delete;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_class_name_delete;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_class_name_delete', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_class_name_delete:

                        // admin_product_class_name_sort_no_move
                        if ('/administrator/product/class_name/sort_no/move' === $pathinfo) {
                            $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ClassNameController::moveSortNo',  '_route' => 'admin_product_class_name_sort_no_move',);
                            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                            $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                            if (!in_array($requestMethod, ['POST'])) {
                                if ($hasRequiredScheme) {
                                    $allow = array_merge($allow, ['POST']);
                                }
                                goto not_admin_product_class_name_sort_no_move;
                            }
                            if (!$hasRequiredScheme) {
                                if ('GET' !== $canonicalMethod) {
                                    goto not_admin_product_class_name_sort_no_move;
                                }

                                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_class_name_sort_no_move', key($requiredSchemes)));
                            }

                            return $ret;
                        }
                        not_admin_product_class_name_sort_no_move:

                    }

                    // admin_product_csv_template
                    if (0 === strpos($pathinfo, '/administrator/product/csv_template') && preg_match('#^/administrator/product/csv_template/(?P<type>\\w+)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_csv_template']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\CsvImportController::csvTemplate',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_csv_template;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_csv_template', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_csv_template:

                }

                // admin_product_csv_import
                if ('/administrator/product/product_csv_upload' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\CsvImportController::csvProduct',  '_route' => 'admin_product_csv_import',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_product_csv_import;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_csv_import', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_product_csv_import:

                if (0 === strpos($pathinfo, '/administrator/product/product/class')) {
                    // admin_product_product_class
                    if (preg_match('#^/administrator/product/product/class/(?P<id>\\d+)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_product_class']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductClassController::index',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_product_class;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_product_class', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_product_class:

                    // admin_product_product_class_clear
                    if (preg_match('#^/administrator/product/product/class/(?P<id>\\d+)/clear$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_product_class_clear']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductClassController::clearProductClasses',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_product_class_clear;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_product_class_clear', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_product_class_clear:

                }

                // admin_product
                if ('/administrator/product' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::index',  '_route' => 'admin_product',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_product;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_product:

                // admin_product_page
                if (0 === strpos($pathinfo, '/administrator/product/page') && preg_match('#^/administrator/product/page(?:/(?P<page_no>\\d+))?$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_page']), array (  'page_no' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::index',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_product_page;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_page', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_product_page:

                if (0 === strpos($pathinfo, '/administrator/product/product')) {
                    // admin_product_image_add
                    if ('/administrator/product/product/image/add' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::addImage',  '_route' => 'admin_product_image_add',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['POST'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['POST']);
                            }
                            goto not_admin_product_image_add;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_image_add;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_image_add', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_image_add:

                    // admin_product_product_new
                    if ('/administrator/product/product/new' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::edit',  '_route' => 'admin_product_product_new',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_product_new;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_product_new', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_product_new:

                    // admin_product_product_edit
                    if (preg_match('#^/administrator/product/product/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_product_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::edit',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_product_edit;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_product_edit', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_product_edit:

                    // admin_product_product_delete
                    if (preg_match('#^/administrator/product/product/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_product_delete']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::delete',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['DELETE'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['DELETE']);
                            }
                            goto not_admin_product_product_delete;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_product_delete;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_product_delete', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_product_delete:

                    // admin_product_product_copy
                    if (preg_match('#^/administrator/product/product/(?P<id>\\d+)/copy$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_product_copy']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::copy',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['POST'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['POST']);
                            }
                            goto not_admin_product_product_copy;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_product_copy;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_product_copy', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_product_copy:

                    // admin_product_product_display
                    if (preg_match('#^/administrator/product/product/(?P<id>\\d+)/display$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_product_display']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::display',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_product_display;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_product_display', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_product_display:

                }

                // admin_product_classes_load
                if (0 === strpos($pathinfo, '/administrator/product/classes') && preg_match('#^/administrator/product/classes/(?P<id>\\d+)/load$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_classes_load']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::loadProductClasses',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        if ($hasRequiredScheme) {
                            $allow = array_merge($allow, ['GET']);
                        }
                        goto not_admin_product_classes_load;
                    }
                    if (!$hasRequiredScheme) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_product_classes_load;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_classes_load', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_product_classes_load:

                // admin_product_export
                if ('/administrator/product/export' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::export',  '_route' => 'admin_product_export',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_product_export;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_export', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_product_export:

                // admin_product_bulk_product_status
                if (0 === strpos($pathinfo, '/administrator/product/bulk/product-status') && preg_match('#^/administrator/product/bulk/product\\-status/(?P<id>\\d+)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_bulk_product_status']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\ProductController::bulkProductStatus',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                    if (!in_array($requestMethod, ['POST'])) {
                        if ($hasRequiredScheme) {
                            $allow = array_merge($allow, ['POST']);
                        }
                        goto not_admin_product_bulk_product_status;
                    }
                    if (!$hasRequiredScheme) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_admin_product_bulk_product_status;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_bulk_product_status', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_admin_product_bulk_product_status:

                if (0 === strpos($pathinfo, '/administrator/product/tag')) {
                    // admin_product_tag
                    if ('/administrator/product/tag' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\TagController::index',  '_route' => 'admin_product_tag',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        if (!isset($requiredSchemes[$context->getScheme()])) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_tag;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_tag', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_tag:

                    // admin_product_tag_delete
                    if (preg_match('#^/administrator/product/tag/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'admin_product_tag_delete']), array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\TagController::delete',));
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['DELETE'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['DELETE']);
                            }
                            goto not_admin_product_tag_delete;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_tag_delete;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_tag_delete', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_tag_delete:

                    // admin_product_tag_sort_no_move
                    if ('/administrator/product/tag/sort_no/move' === $pathinfo) {
                        $ret = array (  '_controller' => 'Eccube\\Controller\\Admin\\Product\\TagController::moveSortNo',  '_route' => 'admin_product_tag_sort_no_move',);
                        $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                        $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                        if (!in_array($requestMethod, ['POST'])) {
                            if ($hasRequiredScheme) {
                                $allow = array_merge($allow, ['POST']);
                            }
                            goto not_admin_product_tag_sort_no_move;
                        }
                        if (!$hasRequiredScheme) {
                            if ('GET' !== $canonicalMethod) {
                                goto not_admin_product_tag_sort_no_move;
                            }

                            return array_replace($ret, $this->redirect($rawPathinfo, 'admin_product_tag_sort_no_move', key($requiredSchemes)));
                        }

                        return $ret;
                    }
                    not_admin_product_tag_sort_no_move:

                }

            }

        }

        elseif (0 === strpos($pathinfo, '/blo')) {
            if (0 === strpos($pathinfo, '/block/cart')) {
                // block_cart
                if ('/block/cart' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Block\\CartController::index',  '_route' => 'block_cart',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_block_cart;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'block_cart', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_block_cart:

                // block_cart_sp
                if ('/block/cart_sp' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Block\\CartController::index',  '_route' => 'block_cart_sp',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_block_cart_sp;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'block_cart_sp', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_block_cart_sp:

            }

            elseif (0 === strpos($pathinfo, '/block/search_product')) {
                // block_search_product
                if ('/block/search_product' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Block\\SearchProductController::index',  '_route' => 'block_search_product',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_block_search_product;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'block_search_product', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_block_search_product:

                // block_search_product_sp
                if ('/block/search_product_sp' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Block\\SearchProductController::index',  '_route' => 'block_search_product_sp',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_block_search_product_sp;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'block_search_product_sp', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_block_search_product_sp:

            }

            // blog
            if ('/blog' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\BlogController::index',  '_route' => 'blog',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_blog;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'blog', key($requiredSchemes)));
                }

                return $ret;
            }
            not_blog:

        }

        elseif (0 === strpos($pathinfo, '/c')) {
            if (0 === strpos($pathinfo, '/cart')) {
                // cart
                if ('/cart' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\CartController::index',  '_route' => 'cart',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_cart;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'cart', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_cart:

                // cart_handle_item
                if (preg_match('#^/cart/(?P<operation>up|down|remove)/(?P<productClassId>\\d+)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'cart_handle_item']), array (  '_controller' => 'Eccube\\Controller\\CartController::handleCartItem',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                    if (!in_array($requestMethod, ['PUT'])) {
                        if ($hasRequiredScheme) {
                            $allow = array_merge($allow, ['PUT']);
                        }
                        goto not_cart_handle_item;
                    }
                    if (!$hasRequiredScheme) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_cart_handle_item;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'cart_handle_item', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_cart_handle_item:

                // cart_buystep
                if (0 === strpos($pathinfo, '/cart/buystep') && preg_match('#^/cart/buystep/(?P<cart_key>[a-zA-Z0-9]+[_][\\x20-\\x7E]+)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'cart_buystep']), array (  '_controller' => 'Eccube\\Controller\\CartController::buystep',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_cart_buystep;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'cart_buystep', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_cart_buystep:

            }

            elseif (0 === strpos($pathinfo, '/contact')) {
                // contact
                if ('/contact' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\ContactController::index',  '_route' => 'contact',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_contact;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'contact', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_contact:

                // contact_complete
                if ('/contact/complete' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\ContactController::complete',  '_route' => 'contact_complete',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_contact_complete;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'contact_complete', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_contact_complete:

            }

            // company
            if ('/company' === $pathinfo) {
                $ret = array (  '_controller' => 'Customize\\Controller\\CompanyPageController::company',  '_route' => 'company',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                if (!in_array($canonicalMethod, ['GET'])) {
                    if ($hasRequiredScheme) {
                        $allow = array_merge($allow, ['GET']);
                    }
                    goto not_company;
                }
                if (!$hasRequiredScheme) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_company;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'company', key($requiredSchemes)));
                }

                return $ret;
            }
            not_company:

        }

        elseif (0 === strpos($pathinfo, '/entry')) {
            // entry
            if ('/entry' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\EntryController::index',  '_route' => 'entry',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_entry;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'entry', key($requiredSchemes)));
                }

                return $ret;
            }
            not_entry:

            // entry_complete
            if ('/entry/complete' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\EntryController::complete',  '_route' => 'entry_complete',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_entry_complete;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'entry_complete', key($requiredSchemes)));
                }

                return $ret;
            }
            not_entry_complete:

            // entry_activate
            if (0 === strpos($pathinfo, '/entry/activate') && preg_match('#^/entry/activate/(?P<secret_key>[^/]++)(?:/(?P<qtyInCart>[^/]++))?$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'entry_activate']), array (  'qtyInCart' => NULL,  '_controller' => 'Eccube\\Controller\\EntryController::activate',));
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_entry_activate;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'entry_activate', key($requiredSchemes)));
                }

                return $ret;
            }
            not_entry_activate:

        }

        elseif (0 === strpos($pathinfo, '/forgot')) {
            // forgot
            if ('/forgot' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\ForgotController::index',  '_route' => 'forgot',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_forgot;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'forgot', key($requiredSchemes)));
                }

                return $ret;
            }
            not_forgot:

            // forgot_complete
            if ('/forgot/complete' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\ForgotController::complete',  '_route' => 'forgot_complete',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_forgot_complete;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'forgot_complete', key($requiredSchemes)));
                }

                return $ret;
            }
            not_forgot_complete:

            // forgot_reset
            if (0 === strpos($pathinfo, '/forgot/reset') && preg_match('#^/forgot/reset/(?P<reset_key>[^/]++)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'forgot_reset']), array (  '_controller' => 'Eccube\\Controller\\ForgotController::reset',));
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_forgot_reset;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'forgot_reset', key($requiredSchemes)));
                }

                return $ret;
            }
            not_forgot_reset:

        }

        elseif (0 === strpos($pathinfo, '/help')) {
            // help_tradelaw
            if ('/help/tradelaw' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\HelpController::tradelaw',  '_route' => 'help_tradelaw',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_help_tradelaw;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'help_tradelaw', key($requiredSchemes)));
                }

                return $ret;
            }
            not_help_tradelaw:

            // help_about
            if ('/help/about' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\HelpController::about',  '_route' => 'help_about',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_help_about;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'help_about', key($requiredSchemes)));
                }

                return $ret;
            }
            not_help_about:

            // help_agreement
            if ('/help/agreement' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\HelpController::agreement',  '_route' => 'help_agreement',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_help_agreement;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'help_agreement', key($requiredSchemes)));
                }

                return $ret;
            }
            not_help_agreement:

            // help_privacy
            if ('/help/privacy' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\HelpController::privacy',  '_route' => 'help_privacy',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_help_privacy;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'help_privacy', key($requiredSchemes)));
                }

                return $ret;
            }
            not_help_privacy:

        }

        // help_guide
        if ('/guide' === $pathinfo) {
            $ret = array (  '_controller' => 'Eccube\\Controller\\HelpController::guide',  '_route' => 'help_guide',);
            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
            if (!isset($requiredSchemes[$context->getScheme()])) {
                if ('GET' !== $canonicalMethod) {
                    goto not_help_guide;
                }

                return array_replace($ret, $this->redirect($rawPathinfo, 'help_guide', key($requiredSchemes)));
            }

            return $ret;
        }
        not_help_guide:

        if (0 === strpos($pathinfo, '/install')) {
            // install
            if ('/install' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\Install\\InstallController::index',  '_route' => 'install',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_install;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'install', key($requiredSchemes)));
                }

                return $ret;
            }
            not_install:

            if (0 === strpos($pathinfo, '/install/step')) {
                // install_step1
                if ('/install/step1' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Install\\InstallController::step1',  '_route' => 'install_step1',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_install_step1;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'install_step1', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_install_step1:

                // install_step2
                if ('/install/step2' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Install\\InstallController::step2',  '_route' => 'install_step2',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_install_step2;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'install_step2', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_install_step2:

                // install_step3
                if ('/install/step3' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Install\\InstallController::step3',  '_route' => 'install_step3',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_install_step3;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'install_step3', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_install_step3:

                // install_step4
                if ('/install/step4' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Install\\InstallController::step4',  '_route' => 'install_step4',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_install_step4;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'install_step4', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_install_step4:

                // install_step5
                if ('/install/step5' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Install\\InstallController::step5',  '_route' => 'install_step5',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_install_step5;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'install_step5', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_install_step5:

            }

            // install_complete
            if ('/install/complete' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\Install\\InstallController::complete',  '_route' => 'install_complete',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_install_complete;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'install_complete', key($requiredSchemes)));
                }

                return $ret;
            }
            not_install_complete:

        }

        elseif (0 === strpos($pathinfo, '/mypage')) {
            if (0 === strpos($pathinfo, '/mypage/change')) {
                // mypage_change
                if ('/mypage/change' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Mypage\\ChangeController::index',  '_route' => 'mypage_change',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_mypage_change;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_change', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_mypage_change:

                // mypage_change_complete
                if ('/mypage/change_complete' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Mypage\\ChangeController::complete',  '_route' => 'mypage_change_complete',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_mypage_change_complete;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_change_complete', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_mypage_change_complete:

            }

            elseif (0 === strpos($pathinfo, '/mypage/delivery')) {
                // mypage_delivery
                if ('/mypage/delivery' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Mypage\\DeliveryController::index',  '_route' => 'mypage_delivery',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_mypage_delivery;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_delivery', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_mypage_delivery:

                // mypage_delivery_new
                if ('/mypage/delivery/new' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Mypage\\DeliveryController::edit',  '_route' => 'mypage_delivery_new',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_mypage_delivery_new;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_delivery_new', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_mypage_delivery_new:

                // mypage_delivery_edit
                if (preg_match('#^/mypage/delivery/(?P<id>\\d+)/edit$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mypage_delivery_edit']), array (  'id' => NULL,  '_controller' => 'Eccube\\Controller\\Mypage\\DeliveryController::edit',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_mypage_delivery_edit;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_delivery_edit', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_mypage_delivery_edit:

                // mypage_delivery_delete
                if (preg_match('#^/mypage/delivery/(?P<id>[^/]++)/delete$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mypage_delivery_delete']), array (  '_controller' => 'Eccube\\Controller\\Mypage\\DeliveryController::delete',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                    if (!in_array($requestMethod, ['DELETE'])) {
                        if ($hasRequiredScheme) {
                            $allow = array_merge($allow, ['DELETE']);
                        }
                        goto not_mypage_delivery_delete;
                    }
                    if (!$hasRequiredScheme) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_mypage_delivery_delete;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_delivery_delete', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_mypage_delivery_delete:

            }

            // mypage_login
            if ('/mypage/login' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\Mypage\\MypageController::login',  '_route' => 'mypage_login',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_mypage_login;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_login', key($requiredSchemes)));
                }

                return $ret;
            }
            not_mypage_login:

            // mypage
            if ('/mypage' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\Mypage\\MypageController::index',  '_route' => 'mypage',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_mypage;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'mypage'));
                }

                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_mypage;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'mypage', key($requiredSchemes)));
                }

                return $ret;
            }
            not_mypage:

            // mypage_history
            if (0 === strpos($pathinfo, '/mypage/history') && preg_match('#^/mypage/history/(?P<order_no>[^/]++)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mypage_history']), array (  '_controller' => 'Eccube\\Controller\\Mypage\\MypageController::history',));
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_mypage_history;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_history', key($requiredSchemes)));
                }

                return $ret;
            }
            not_mypage_history:

            // mypage_order
            if (0 === strpos($pathinfo, '/mypage/order') && preg_match('#^/mypage/order/(?P<order_no>[^/]++)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mypage_order']), array (  '_controller' => 'Eccube\\Controller\\Mypage\\MypageController::order',));
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                if (!in_array($requestMethod, ['PUT'])) {
                    if ($hasRequiredScheme) {
                        $allow = array_merge($allow, ['PUT']);
                    }
                    goto not_mypage_order;
                }
                if (!$hasRequiredScheme) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_mypage_order;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_order', key($requiredSchemes)));
                }

                return $ret;
            }
            not_mypage_order:

            if (0 === strpos($pathinfo, '/mypage/favorite')) {
                // mypage_favorite
                if ('/mypage/favorite' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Mypage\\MypageController::favorite',  '_route' => 'mypage_favorite',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_mypage_favorite;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_favorite', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_mypage_favorite:

                // mypage_favorite_delete
                if (preg_match('#^/mypage/favorite/(?P<id>\\d+)/delete$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mypage_favorite_delete']), array (  '_controller' => 'Eccube\\Controller\\Mypage\\MypageController::delete',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                    if (!in_array($requestMethod, ['DELETE'])) {
                        if ($hasRequiredScheme) {
                            $allow = array_merge($allow, ['DELETE']);
                        }
                        goto not_mypage_favorite_delete;
                    }
                    if (!$hasRequiredScheme) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_mypage_favorite_delete;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_favorite_delete', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_mypage_favorite_delete:

            }

            elseif (0 === strpos($pathinfo, '/mypage/withdraw')) {
                // mypage_withdraw
                if ('/mypage/withdraw' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Mypage\\WithdrawController::index',  '_route' => 'mypage_withdraw',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_mypage_withdraw;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_withdraw', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_mypage_withdraw:

                // mypage_withdraw_complete
                if ('/mypage/withdraw_complete' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\Mypage\\WithdrawController::complete',  '_route' => 'mypage_withdraw_complete',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_mypage_withdraw_complete;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'mypage_withdraw_complete', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_mypage_withdraw_complete:

            }

        }

        elseif (0 === strpos($pathinfo, '/shopping')) {
            // shopping_nonmember
            if ('/shopping/nonmember' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\NonMemberShoppingController::index',  '_route' => 'shopping_nonmember',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_shopping_nonmember;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_nonmember', key($requiredSchemes)));
                }

                return $ret;
            }
            not_shopping_nonmember:

            // shopping_customer
            if ('/shopping/customer' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\NonMemberShoppingController::customer',  '_route' => 'shopping_customer',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_shopping_customer;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_customer', key($requiredSchemes)));
                }

                return $ret;
            }
            not_shopping_customer:

            if (0 === strpos($pathinfo, '/shopping/shipping_multiple')) {
                // shopping_shipping_multiple
                if ('/shopping/shipping_multiple' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\ShippingMultipleController::index',  '_route' => 'shopping_shipping_multiple',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_shopping_shipping_multiple;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_shipping_multiple', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_shopping_shipping_multiple:

                // shopping_shipping_multiple_edit
                if ('/shopping/shipping_multiple_edit' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\ShippingMultipleController::shippingMultipleEdit',  '_route' => 'shopping_shipping_multiple_edit',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_shopping_shipping_multiple_edit;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_shipping_multiple_edit', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_shopping_shipping_multiple_edit:

            }

            // shopping
            if ('/shopping' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\ShoppingController::index',  '_route' => 'shopping',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_shopping;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'shopping', key($requiredSchemes)));
                }

                return $ret;
            }
            not_shopping:

            // shopping_redirect_to
            if ('/shopping/redirect_to' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\ShoppingController::redirectTo',  '_route' => 'shopping_redirect_to',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                if (!in_array($requestMethod, ['POST'])) {
                    if ($hasRequiredScheme) {
                        $allow = array_merge($allow, ['POST']);
                    }
                    goto not_shopping_redirect_to;
                }
                if (!$hasRequiredScheme) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_shopping_redirect_to;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_redirect_to', key($requiredSchemes)));
                }

                return $ret;
            }
            not_shopping_redirect_to:

            if (0 === strpos($pathinfo, '/shopping/c')) {
                // shopping_confirm
                if ('/shopping/confirm' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\ShoppingController::confirm',  '_route' => 'shopping_confirm',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                    if (!in_array($requestMethod, ['POST'])) {
                        if ($hasRequiredScheme) {
                            $allow = array_merge($allow, ['POST']);
                        }
                        goto not_shopping_confirm;
                    }
                    if (!$hasRequiredScheme) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_shopping_confirm;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_confirm', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_shopping_confirm:

                // shopping_complete
                if ('/shopping/complete' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\ShoppingController::complete',  '_route' => 'shopping_complete',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_shopping_complete;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_complete', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_shopping_complete:

                // shopping_checkout
                if ('/shopping/checkout' === $pathinfo) {
                    $ret = array (  '_controller' => 'Eccube\\Controller\\ShoppingController::checkout',  '_route' => 'shopping_checkout',);
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                    if (!in_array($requestMethod, ['POST'])) {
                        if ($hasRequiredScheme) {
                            $allow = array_merge($allow, ['POST']);
                        }
                        goto not_shopping_checkout;
                    }
                    if (!$hasRequiredScheme) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_shopping_checkout;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_checkout', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_shopping_checkout:

            }

            elseif (0 === strpos($pathinfo, '/shopping/shipping')) {
                // shopping_shipping
                if (preg_match('#^/shopping/shipping/(?P<id>\\d+)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'shopping_shipping']), array (  '_controller' => 'Eccube\\Controller\\ShoppingController::shipping',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_shopping_shipping;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_shipping', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_shopping_shipping:

                // shopping_shipping_edit
                if (0 === strpos($pathinfo, '/shopping/shipping_edit') && preg_match('#^/shopping/shipping_edit/(?P<id>\\d+)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'shopping_shipping_edit']), array (  '_controller' => 'Eccube\\Controller\\ShoppingController::shippingEdit',));
                    $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                    if (!isset($requiredSchemes[$context->getScheme()])) {
                        if ('GET' !== $canonicalMethod) {
                            goto not_shopping_shipping_edit;
                        }

                        return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_shipping_edit', key($requiredSchemes)));
                    }

                    return $ret;
                }
                not_shopping_shipping_edit:

            }

            // shopping_login
            if ('/shopping/login' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\ShoppingController::login',  '_route' => 'shopping_login',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_shopping_login;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_login', key($requiredSchemes)));
                }

                return $ret;
            }
            not_shopping_login:

            // shopping_error
            if ('/shopping/error' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\ShoppingController::error',  '_route' => 'shopping_error',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_shopping_error;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'shopping_error', key($requiredSchemes)));
                }

                return $ret;
            }
            not_shopping_error:

        }

        elseif (0 === strpos($pathinfo, '/products')) {
            // product_list
            if ('/products/list' === $pathinfo) {
                $ret = array (  '_controller' => 'Eccube\\Controller\\ProductController::index',  '_route' => 'product_list',);
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_product_list;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'product_list', key($requiredSchemes)));
                }

                return $ret;
            }
            not_product_list:

            // product_detail
            if (0 === strpos($pathinfo, '/products/detail') && preg_match('#^/products/detail/(?P<id>\\d+)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'product_detail']), array (  '_controller' => 'Eccube\\Controller\\ProductController::detail',));
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                if (!in_array($canonicalMethod, ['GET'])) {
                    if ($hasRequiredScheme) {
                        $allow = array_merge($allow, ['GET']);
                    }
                    goto not_product_detail;
                }
                if (!$hasRequiredScheme) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_product_detail;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'product_detail', key($requiredSchemes)));
                }

                return $ret;
            }
            not_product_detail:

            // product_add_favorite
            if (0 === strpos($pathinfo, '/products/add_favorite') && preg_match('#^/products/add_favorite/(?P<id>\\d+)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'product_add_favorite']), array (  '_controller' => 'Eccube\\Controller\\ProductController::addFavorite',));
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                if (!isset($requiredSchemes[$context->getScheme()])) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_product_add_favorite;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'product_add_favorite', key($requiredSchemes)));
                }

                return $ret;
            }
            not_product_add_favorite:

            // product_add_cart
            if (0 === strpos($pathinfo, '/products/add_cart') && preg_match('#^/products/add_cart/(?P<id>\\d+)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'product_add_cart']), array (  '_controller' => 'Eccube\\Controller\\ProductController::addCart',));
                $requiredSchemes = array (  'https' => 0,  'http' => 1,);
                $hasRequiredScheme = isset($requiredSchemes[$context->getScheme()]);
                if (!in_array($requestMethod, ['POST'])) {
                    if ($hasRequiredScheme) {
                        $allow = array_merge($allow, ['POST']);
                    }
                    goto not_product_add_cart;
                }
                if (!$hasRequiredScheme) {
                    if ('GET' !== $canonicalMethod) {
                        goto not_product_add_cart;
                    }

                    return array_replace($ret, $this->redirect($rawPathinfo, 'product_add_cart', key($requiredSchemes)));
                }

                return $ret;
            }
            not_product_add_cart:

        }

        // homepage
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'Customize\\Controller\\CustomTopController::index',  '_route' => 'homepage',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_homepage;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'homepage'));
            }

            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
            if (!isset($requiredSchemes[$context->getScheme()])) {
                if ('GET' !== $canonicalMethod) {
                    goto not_homepage;
                }

                return array_replace($ret, $this->redirect($rawPathinfo, 'homepage', key($requiredSchemes)));
            }

            return $ret;
        }
        not_homepage:

        // user_data
        if (preg_match('#^/(?P<route>(?=([0-9a-zA-Z_\\-]+\\/?)+(?<!\\/))(?!logout|administrator/logout|install).*)$#sD', $pathinfo, $matches)) {
            $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'user_data']), array (  '_controller' => 'Customize\\Controller\\CustomUserDataController::index',));
            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
            if (!isset($requiredSchemes[$context->getScheme()])) {
                if ('GET' !== $canonicalMethod) {
                    goto not_user_data;
                }

                return array_replace($ret, $this->redirect($rawPathinfo, 'user_data', key($requiredSchemes)));
            }

            return $ret;
        }
        not_user_data:

        // admin_logout
        if ('/administrator/logout' === $pathinfo) {
            $ret = ['_route' => 'admin_logout'];
            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
            if (!isset($requiredSchemes[$context->getScheme()])) {
                if ('GET' !== $canonicalMethod) {
                    goto not_admin_logout;
                }

                return array_replace($ret, $this->redirect($rawPathinfo, 'admin_logout', key($requiredSchemes)));
            }

            return $ret;
        }
        not_admin_logout:

        // logout
        if ('/logout' === $pathinfo) {
            $ret = ['_route' => 'logout'];
            $requiredSchemes = array (  'https' => 0,  'http' => 1,);
            if (!isset($requiredSchemes[$context->getScheme()])) {
                if ('GET' !== $canonicalMethod) {
                    goto not_logout;
                }

                return array_replace($ret, $this->redirect($rawPathinfo, 'logout', key($requiredSchemes)));
            }

            return $ret;
        }
        not_logout:

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
