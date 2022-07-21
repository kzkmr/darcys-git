<script>
    $(function() {
        $elem = $('#hiddendeliverydate');
        $('div.card-body').each(function() {
            if($elem.length !== 0){
                if($(this).find('a.btn').text() == '{{ 'admin.product.preview'|trans }}'){
                    $(this).append($elem.html());
                    $elem.remove();
                }
            }
        });
    });
</script>
