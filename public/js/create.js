$(document).ready(function () {
    $('#select_department').on('change', function () {
        let id = $(this).val();
        $('#select_doctor').empty();
        $('#select_doctor').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
            type: 'GET',
            url: 'getdoctors/' + id,
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response);   
                $('#select_doctor').empty();
                $('#select_doctor').append(`<option value="0" disabled selected>-- Select --</option>`);
                response.forEach(element => {
                    $('#select_doctor').append(`<option value="${element['id']}">${element['name']}</option>`);
                });

            }
        });
    });

    $('#select_doctor').on('change', function () {
        let id = $(this).val();
        $.ajax({
            type: 'GET',
            url: 'getdoctorfee/' + id,
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $('#fee').val(response[0]['fee']);
            }
        });
    });

    $('#select_doctor').on('change', function () {
        let id = $(this).val();
        let date = $('#appointment_date').val();
        $('#availabletext').empty();
        $('#availabletext').append('Cheaking Availability ...');
        $.ajax({
            type: 'GET',
            url: 'doctoravailable/' + id + '/' + date,
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $('#availabletext').empty();
                if(response < 2){
                    $('#available').val('yes');
                    $('#availabletext').append('Available');
                }else{
                    $('#available').val('no');
                    $('#availabletext').append('Not Available');
                }
            }
        });
    });
});