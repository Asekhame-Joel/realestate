$(function(){
    $(document).on('click', '.delete-button', function(e){
        e.preventDefault();
        var form = $(this).closest('form');
        var actionUrl = form.attr('action');

        Swal.fire({
            title: 'Are you sure?',
            text: "Delete this data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        // Show the notification using SweetAlert
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                        // Optionally remove the row or reload the page
                        form.closest('tr').remove(); // Assuming this is within a table row
                        // location.reload(); // Uncomment if you prefer to reload the page
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was an error deleting your data.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
