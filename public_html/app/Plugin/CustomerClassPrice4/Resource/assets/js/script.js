/*
 * This file is part of CustomerClassPrice4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 *  https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

(function (window, undefined) {
  if (window.ccp === undefined) {
    window.ccp = {};
  }

  let ccp = window.ccp;

  window.ccp = ccp;

  /**
   * 規格2のプルダウンを設定する.
   */
  ccp.setCustomerClassPrices = function ($form, product_id, $sele1, $sele2) {
    if ($sele1 && $sele1.length) {
      if ($sele2 && $sele2.length) {
        ccp.changePrice($form, product_id, $sele1.val() ? $sele1.val() : '',
          $sele2.val() ? $sele2.val() : '');
      }
    }
  };

  /**
   * 規格の選択状態に応じて, フィールドを設定する.
   */
  let price_origin = [];
  ccp.changePrice = function ($form, product_id, classcat_id1, classcat_id2) {

    classcat_id2 = classcat_id2 ? classcat_id2 : '';

    let classcat2;

    // 会員価格
    const $prices = $form.parent().find('.ec-customerClassPrice');
    $prices.each(function (i, element) {
      let customer_class_id = element.dataset.id;
      let $price = element.innerText;

      if (ccp.hasOwnProperty('productCustomerClassPrices')) {
        classcat2 = ccp.productCustomerClassPrices[product_id][customer_class_id][classcat_id1]['#' + classcat_id2];
      } else {
        if (typeof ccp.customerClassPrices[customer_class_id][classcat_id1] !== 'undefined') {
          classcat2 = ccp.customerClassPrices[customer_class_id][classcat_id1]['#' + classcat_id2];
        }
      }

      if (typeof price_origin[customer_class_id] === 'undefined') {
        // 初期値を保持
        price_origin[customer_class_id] = $price;
      }

      if (typeof classcat2 === 'undefined') {
        element.innerText = price_origin[customer_class_id];
      } else {
        if (classcat2 && typeof classcat2.customer_class_price_inc_tax !== 'undefined' && String(classcat2.customer_class_price_inc_tax).length >= 1) {
          element.innerText = '￥' + classcat2.customer_class_price_inc_tax;
        } else {
          element.innerText = price_origin[customer_class_id];
        }
      }
    });
  };
})(window)

$(function () {
  // 規格1選択時
  $('select[name=classcategory_id1]').change(function () {
    const $form = $(this).parents('form');
    const product_id = $form.find('input[name=product_id]').val();
    const $sele1 = $(this);
    const $sele2 = $form.find('select[name=classcategory_id2]');

    // 規格1のみの場合
    if (!$sele2.length) {
      ccp.changePrice($form, product_id, $sele1.val(), null);
      // 規格2ありの場合
    } else {
      ccp.setCustomerClassPrices($form, product_id, $sele1, $sele2);
    }
  });
  // 規格2選択時
  $('select[name=classcategory_id2]').change(function () {
    const $form = $(this).parents('form');
    const product_id = $form.find('input[name=product_id]').val();
    const $sele1 = $form.find('select[name=classcategory_id1]');
    const $sele2 = $(this);

    ccp.changePrice($form, product_id, $sele1.val(), $sele2.val());
  });
});
