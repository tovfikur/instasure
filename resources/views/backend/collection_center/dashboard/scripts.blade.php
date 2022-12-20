<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    /* Ajax request for updating */
    $('body').on('submit', '#edit_form', function(event) {
        event.preventDefault();
        let url = $(this).attr('action');
        const form_data = $(this).serialize();

        /* start */
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((data) => {

            if (data.isConfirmed) {
                /* Ajax request */
                $.ajax({
                    url: url,
                    method: 'post',
                    data: form_data,
                    dataType: 'json',
                    success: function(result) {

                        if (result.success == true) {
                            /* Toast alert on success */
                            toastr.success(result.message);
                            /* End: Toast alert on success */
                            location.reload();

                        } else {
                            toastr.error(result.message);

                        }
                    },
                    error: function(error) {
                        const err = error.responseJSON.errors;
                        for (const item in err) {
                            const message = err[item][0];
                            toastr.error(message.replace('id', ''));
                        }

                    }
                });

                /* End: Ajax request */
            }
        })
        /* end */

    });
    /* End: Ajax request for updating */
</script>
