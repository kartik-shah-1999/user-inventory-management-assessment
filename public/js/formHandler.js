$(document).ready(function () {
    const method = {
        get: 'GET',
        post: 'POST',
        patch: 'PATCH',
        put: 'PUT',
        delete: 'DELETE'
    }

    let csrfToken = $('meta[name="csrf-token"]').attr('content');

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
            },
            error: (response) => {
                console.error(response)
            }
        });
    }

    $(".logout").on("click",function(e){
        e.preventDefault()
        let url = $(this).data('url');
        formHandler(method.post, url);
    })
});