$(document).on('click', '#delete', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed == true) {
            deletedata(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function deletedata(id) {
    var protocol = $(location).attr('protocol');
    var host = $(location).attr('host');
    var url = $(location).attr('href').split('/');
    var value = url[3].split('?');
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: value[0] +'/delete?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Deleted!',
            'Your data is deleted from the servers',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#delete_inbound', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed == true) {
            deleteinbound(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function deleteinbound(id) {
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: 'inbound/delete?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Deleted!',
            'Your data is deleted from the servers',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#delete_outbound', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed == true) {
            deleteoutbound(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function deleteoutbound(id) {
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: 'outbound/delete?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Deleted!',
            'Your data is deleted from the servers',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}




