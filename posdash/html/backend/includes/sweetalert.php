<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function showSuccess(message, redirect = "")
{
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: message,
        confirmButtonColor: '#32bdea',
        confirmButtonText: 'OK'
    }).then(() => {
        if (redirect != "")
        {
            window.location = redirect;
        }
    });
}

function showRegisterSuccess(message, redirect = "")
{
    Swal.fire({
        icon: 'success',
        title: 'Registered Successfully!',
        text: message,
        confirmButtonColor: '#28a745',
        confirmButtonText: 'OK'
    }).then(() => {
        if (redirect != "")
        {
            window.location = redirect;
        }
    });
}

function showUpdateSuccess(message, redirect = "")
{
    Swal.fire({
        icon: 'success',
        title: 'Updated Successfully!',
        text: message,
        confirmButtonColor: '#007bff',
        confirmButtonText: 'OK'
    }).then(() => {
        if (redirect != "")
        {
            window.location = redirect;
        }
    });
}

function showDeleteSuccess(message, redirect = "")
{
    Swal.fire({
        icon: 'success',
        title: 'Deleted Successfully!',
        text: message,
        confirmButtonColor: '#d33',
        confirmButtonText: 'OK'
    }).then(() => {
        if (redirect != "")
        {
            window.location = redirect;
        }
    });
}

function showError(message)
{
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: message,
        confirmButtonColor: '#d33'
    });
}

function showWarning(message)
{
    Swal.fire({
        icon: 'warning',
        title: 'Warning!',
        text: message,
        confirmButtonColor: '#f39c12'
    });
}

function confirmDelete(url, title='Delete Record?', text='This record will be permanently deleted.')
{
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {

        if(result.isConfirmed)
        {
            window.location.href = url;
        }

    });

    return false;
}

</script>