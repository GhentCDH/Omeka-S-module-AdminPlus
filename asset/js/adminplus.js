(function ($) {
    $(document).on('click','.tablesaw th[data-sort_by]', function(e) {
        let realTarget = document.elementFromPoint(e.clientX, e.clientY);
        if ( realTarget.tagName !== 'TH' ) {
            return;
        }
        let item = $(this);
        let sortOrder = $("select[name='sort_order']");
        let sortBy = $("select[name='sort_by']");

        sortBy.val(item.data('sort_by')).change();
        if ( item.hasClass('sort-active') ) {
            sortOrder.val( sortOrder.val() === 'desc' ? 'asc' : 'desc' ).change();
        }
        $("form.sorting").submit();
    });

    $(document).on('click', '.sortable-down', function() {
        let block = $(this).closest('.block');
        block.insertAfter(block.next());
    });

    $(document).on('click', '.sortable-up', function() {
        let block = $(this).closest('.block');
        block.insertBefore(block.prev());
    })

    // $('.block-options-icon').on('click', function(e) {
    //     e.preventDefault();
    //     console.log('ola')
    //     $(this).closest('.block').find('.block-options').toggleClass('active')
    // })
})(jQuery);
