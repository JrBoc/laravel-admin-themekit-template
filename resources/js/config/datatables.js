$.extend($.fn.dataTable.defaults, {
    responsive: true,
    pagingType: 'input',
    searching: false,
    lengthChange: false,
    language: {
        paginate: {
            next: `<span class="page-link" type="button"><i class="ik ik-chevron-right"></i></span>`,
            previous: `<span class="page-link" type="button"><i class="ik ik-chevron-left"></i></span>`,
            last: `<span class="page-link last" type="button"><i class="ik ik-chevrons-right"></i></span>`,
            first: `<span class="page-link first" type="button"><i class="ik ik-chevrons-left"></i></span>`
        },
        processing: "<i class='fas fa-spinner fa-pulse'></i> Please wait..."
    },
    dom:
        "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    orderMulti: false,
    filtering: false
});

$('table').on('draw.dt', function() {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body',
        boundary: 'window'
    });

    $(document)
        .find('.dataTables_paginate')
        .addClass('pagination justify-content-center justify-content-md-end');

    let spanIndex = 0;

    $(document)
        .find('.dataTables_paginate')
        .children()
        .each(function() {
            let span = $(this);

            if ([2, 4, 5].includes(spanIndex)) {
                span.addClass('pt-10');

                if (spanIndex == 5) {
                    span.addClass('pl-1');
                }
            }

            if (spanIndex == 6) {
                span.removeClass('page-item');
            }

            spanIndex++;
        });
});
