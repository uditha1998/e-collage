
$(document).ready(function () {

    $('#create').click(function (event) {
        event.preventDefault();


        if (!$('#class_type').val() || $('#class_type').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter class type..!",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        } else if (!$('#subject').val() || $('#subject').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter  subject name..!",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        } else if (!$('#start_date').val() || $('#start_date').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter start date..!",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        } else if (!$('#start_time').val() || $('#start_time').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter Start time..!",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        } else if (!$('#duration').val() || $('#duration').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter duration..!",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        } else {
            var formData = new FormData($('#form-data')[0]);
            $.ajax({
                url: "ajax/post-and-get/lecture_class.php",
                type: "POST",
                data: formData,
                async: false,
                dataType: 'json',
                success: function (result) {

                    swal({
                        title: "Success!",
                        text: "Your data was saved successfully!.....",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }, function () {
                        setTimeout(function () {
                            window.location.replace("create-lecture-class.php");
                        }, 1500);
                    });


                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });


    $('#update').click(function (event) {
        event.preventDefault();
        var formData = new FormData($('#form-data')[0]);

        $.ajax({
            url: "ajax/post-and-get/lecture_subject.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (result) {

                swal({
                    title: "Success!",
                    text: "Your data was saved successfully!.....",
                    type: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }, function () {
                    setTimeout(function () {
                        window.location.reload();

                    }, 1500);
                });


            },
            cache: false,
            contentType: false,
            processData: false
        });
    });


});

