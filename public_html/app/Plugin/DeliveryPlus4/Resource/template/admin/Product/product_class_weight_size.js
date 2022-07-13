<script>
    $(function() {
        var index = 9;
        $('th').each(function(i) {
            if($(this).text().match(/{{'admin.product.delivery_duration'|trans}}/)){
                index = i;
            }
        });
        $('table tr').each(function(i) {
            if (i != 0) {
                $elem = $('#deliveryplus_size_' + i);
                $('td:eq('+index+')', this).before('<td class="align-middle">' + $elem.html() + '</td>');
                $elem.remove();
                $elem = $('#deliveryplus_weight_' + i);
                $('td:eq('+index+')', this).before('<td class="align-middle">' + $elem.html() + '</td>');
                $elem.remove();
            } else {
                $elem = $('#deliveryplus_size_th');
                $('th:eq('+index+')').before('<th class="pt-2 pb-2">' + $elem.text() + '</th>');
                $elem.remove();
                $elem = $('#deliveryplus_weight_th');
                $('th:eq('+index+')').before('<th class="pt-2 pb-2">' + $elem.text() + '</th>');
                $elem.remove();
            }
        });

        // 1行目をコピーボタン
        $('#copy').click(function() {
            var weight = $('#product_class_matrix_product_classes_0_deliveryplus_weight').val();
            $('input[id$=_deliveryplus_weight]').val(weight);

            var size = $('#product_class_matrix_product_classes_0_deliveryplus_size').val();
            $('input[id$=_deliveryplus_size]').val(size);
        });
    });
</script>



