$(document).ready(function () {
    const method = {
        get: 'GET',
        post: 'POST',
        patch: 'PATCH',
        put: 'PUT',
        delete: 'DELETE'
    }

    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    const alertMessage = (message, type='warning') => {
        const alert = `<div class="alert alert-${type} text-center alert-dismissible fade show" role="alert">${message}</div>`
        return alert
    }

    const formHandler = (method, url, data=null) => {
        $.ajax({
            type: method,
            url: url,
            data: data,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: (response) => {
                if(response.redirectUrl){
                    window.location.href = response.redirectUrl
                }
                if(response.success){
                    $('.confirmation-message').html(alertMessage(response.success,'success'));
                }
            },
            error: (response) => {
                console.error(response)
                $('.confirmation-message').html(alertMessage(response.success,'danger'));
            }
        });
    }

    $(".logout").on("click",function(e){
        e.preventDefault()
        let url = $(this).data('url');
        formHandler(method.post, url);
    })

    $(".delete-product").on("click",function(e){
        e.preventDefault()
        let id = $(this).data('id');
        let url = $(this).data('url');
        $(".confirm-delete").on("click",function(){
           formHandler(method.delete, url, {'id': id})
           $('#confirmationModal').modal('hide')
           $(".products").html()
        })
    })
});