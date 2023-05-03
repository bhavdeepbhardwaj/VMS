(function($) {

    var form = $("#signup-form");
    const myname = $('#name').val();

    if (myname == 0) {
        // console.log(myname == '');
        if (myname == '') {
            // $("#suc_msg").removeClass("hide");
            // $("#suc_msg").html("fill the name");
            // alert("fill the name");
        }
    }
    form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        labels: {
            previous: 'Previous',
            next: 'Next',
            finish: 'Finish',
            current: ''
        },
        titleTemplate: '<h3 class="title">#title#</h3>',
        // onStepChanging: function(event, currentIndex, newIndex) {
        //     // const myname = $('#name').val();
        //     // alert(myname);
        //     // console.log(currentIndex);
        //     // alert(event);
        //     // alert(currentIndex);
        //     // alert(newIndex);
        //     // if (currentIndex == 0) {
        //     //     const myname = $('#name').val();
        //     //     // console.log(myname == '');
        //     //     if (myname == '') {
        //     //         $("#suc_msg").removeClass("hide");
        //     //         $("#suc_msg").html("fill the name");

        //     //         alert("fill the name");
        //     //     }
        //     // }
        //     // alert('xyz');
        // },

        onFinished: function(event, currentIndex) {

            var form = $(this);
            // console.log(form);
            // alert(form);

            // Submit form input
            form.submit();

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // $.ajax({
            //     type: "POST",
            //     url: '/uservisitor/store',
            //     data: $(this).serialize(),
            //     success: function(result) {
            //         // console.log(result)
            //         swal("Thank You", "Check Out", "success");
            //         form.trigger("reset");

            //     },
            //     error: function(error) {
            //         console.log(error)
            //     },
            // });
        },
    });

    $(".toggle-password").on('click', function() {

        $(this).toggleClass("zmdi-eye zmdi-eye-off");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

})(jQuery);
