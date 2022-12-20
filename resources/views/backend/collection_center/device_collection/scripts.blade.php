<script src="//cdn.datatables.net/plug-ins/1.11.5/pagination/input.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    /* Remove modal from dom when it hides from window */

    $('body').on('hide.bs.modal', '.modal', function(event) {
        $(this).remove();
    });

    /* End: Remove modal from dom when it hides from window */
</script>

<script>
    /* Find device insurance using policy number/mobile/imei (ajax) */
    $('body').on('submit', '#device_insurance_find_form', function(event) {
        event.preventDefault();
        let url = $(this).attr('action');
        let form_data = $(this).serialize();
        var csrfToken = $("input[name='_token']").val();
        console.log(form_data);
        fetch(url, {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                },
                redirect: 'follow',
                referrerPolicy: 'no-referrer',
                body: JSON.stringify(form_data)

            })
            .then(response => response.json())
            .then(result => {
                console.log(result);
            })
    });


    /* End: Dispaly add modal using fetch API (ajax) */
</script>

<script>
    /* Find device insurance using policy number/mobile/imei (ajax) */

    $('body').on('click', '#btn_create', function(event) {
        event.preventDefault();
        let url = $(this).attr('href');

        fetch(url)
            .then(response => response.text())
            .then(html => {
                $('body').append(html);
                $('#create_modal').modal('show');
            })
    });

    /* End: Dispaly add modal using fetch API (ajax) */
</script>


<script>
    /* Device collection list on datatables using ajax request */
    $(function() {
        $('#datatable_index').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            pagingType: "input",
            aLengthMenu: [
                [5, 10, 25, 50, 100, 200, 400, 500, -1],
                [5, 10, 25, 50, 100, 200, 400, 500]
            ],
            'iDisplayLength': 10,
            ajax: '{{ route('collection_center.device_collection_datatable') }}',
            columns: [{
                    "title": "SL",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    searching: false,
                    orderable: false,

                },
                {
                    data: 'customer_id',
                    name: 'customer_id'
                },
                {
                    data: 'device_insurance_id',
                    name: 'device_insurance_id'
                },
                {
                    data: 'collection_center_id',
                    name: 'collection_center_id'
                },
                {
                    data: 'mobile_health_details',
                    name: 'mobile_health_details',
                    searching: false,
                    orderable: false,
                },
                {
                    data: 'customer_will_pay',
                    name: 'customer_will_pay',
                    searching: false,
                    orderable: false,
                },

                {
                    data: 'status',
                    name: 'status'
                },

                {
                    data: 'actions',
                    name: 'actions',
                    searching: false,
                    orderable: false,
                    class: 'text-center'
                }
            ]
        });
    });
    /* End: Device collection list on datatables using ajax request */
</script>
