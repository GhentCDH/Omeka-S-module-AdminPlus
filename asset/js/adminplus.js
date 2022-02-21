(function ($) {
    $(document).on('click','.tablesaw th[data-sort_by]', function() {
        item = $(this);
        let sortOrder = $("select[name='sort_order']");
        let sortBy = $("select[name='sort_by']");

        sortBy.val(item.data('sort_by')).change();
        if ( item.hasClass('sort-active') ) {
            sortOrder.val( sortOrder.val() === 'desc' ? 'asc' : 'desc' ).change();
        }
        $("form.sorting").submit();
    });
})(jQuery);
