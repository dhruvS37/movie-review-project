
$(document).ready(function () {
   
    function hideSelected(value) {
        if (value && !value.selected) {
            return $('<span>' + value.text + '</span>');
        }
    }
    $('#castAndCrewInput').select2({
        placeholder: "Select a cast",
        width: 'resolve',
        templateResult: hideSelected
    });
    
    $('#ratingInput').select2({
        placeholder: "Select a rating",
    });

    $('#reset').click(function (event) {
        event.preventDefault();

        $("#movieNameInput").val(null);
        $('.checkInput').prop("checked", false)
        $('#castAndCrewInput').val(null).trigger('change');
        $('#ratingInput').val(null).trigger('change');
    })

    $('#myForm').keypress(function(event){
        if(event.key == 'Enter')
            $('#submit').trigger('click')
    })
    
    $('.deleteBtn').click(function(){
        const id = $(this).data('id');
        $.ajax({
            url: `/home/${id}`,
            type:'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                id: id
            },
            success: function (response) {
                if(response.status==200){
                    window.location.href="http://127.0.0.1:8000/home";
                    
                }
            }
        })
    })
})