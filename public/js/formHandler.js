$(document).ready(function () {
    /*
     *  methods for formHandler
     */
    const method = {
        get: 'GET',
        post: 'POST',
        patch: 'PATCH',
        put: 'PUT',
        delete: 'DELETE'
    }

    /*
     *  type of alert class based on message
     */
    const alertType = {
        error: 'danger',
        success: 'success'
    }

    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    const alertMessage = (message, type='warning') => {
        const alert = `<div class="alert alert-${type} text-center alert-dismissible fade show" role="alert">${message}</div>`
        return alert
    }

    /**
     * form submission handler based on different requests
     * 
     * @param {string} method 
     * @param {string} url 
     * @param {object || null} data 
     */
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
                    $('.confirmation-message').html(alertMessage(response.success,alertType.success));
                }
            },
            error: (response) => {
                console.error(response)
                if(response.error){
                    $('.confirmation-message').html(alertMessage(response.success,alertType.error));
                }
            }
        });
    }

    /*
    * logout event
    */
    $(".logout").on("click",function(e){
        e.preventDefault()
        let url = $(this).data('url');
        formHandler(method.post, url);
    })

    /**
     *  delete event
     * 
     *  triggers a modal for confirmation before deleting 
     */
    $(".delete-product").on("click",function(e){
        e.preventDefault()
        let id = $(this).data('id');
        let url = $(this).data('url');

        //triggers the actual delete operation after reciving confirmation
        $(".confirm-delete").on("click",function(){
           formHandler(method.delete, url, {'id': id})
           $('#confirmationModal').modal('hide')
           $(".products").html()
        })
    })
});