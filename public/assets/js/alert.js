var Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: function (toast) {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

function deleteItem(url) {
    var SwalMixinButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-info btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1"
        },
        buttonsStyling: false
    });

    SwalMixinButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then(function (result) {
        if (result.isConfirmed) {
            deleteNow();
        }
    });

    function deleteNow() {
        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => { 
            if (data.success) { 
                Toast.fire({ icon: "success", title: data.success });
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else if (data.error) {
                Toast.fire({ icon: "error", title: data.error });
            } else {
                Toast.fire({ icon: "error", title: 'Something is wrong' });
            }
        })
        .catch(error => {
            Toast.fire({ icon: "error", title: 'Something is wrong' });
        });
        
    }
}

function approveItem(url) {
    var SwalMixinButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-label-info btn-wide mx-1",
            denyButton: "btn btn-label-secondary btn-wide mx-1",
            cancelButton: "btn btn-label-danger btn-wide mx-1"
        },
        buttonsStyling: false
    });

    SwalMixinButtons.fire({
        title: "Are you sure?",
        text: "This user completed all training?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, complete it!"
    }).then(function (result) {
        if (result.isConfirmed) {
            approveNow();
        }
    });

    function approveNow() {
        fetch(url, {
            method: 'get',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => { 
            if (data.success) { 
                Toast.fire({ icon: "success", title: data.success });
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else if (data.error) {
                Toast.fire({ icon: "error", title: data.error });
            } else {
                Toast.fire({ icon: "error", title: 'Something is wrong' });
            }
        })
        .catch(error => {
            Toast.fire({ icon: "error", title: 'Something is wrong' });
        });
        
    }
}


