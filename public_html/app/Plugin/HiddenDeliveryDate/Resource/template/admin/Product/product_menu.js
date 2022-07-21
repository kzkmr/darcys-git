<script>
    $(function() {
        $('table tr').each(function(i) {
            $elem = $('#hiddendeliverydate_' + i);
            if($elem.length !== 0){
                $(this).find('td.align-middle.pr-3 > div.text-right').append($elem.html());
                $elem.remove();
            }
        });
    });
</script>
