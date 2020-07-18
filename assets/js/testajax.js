function ref_div(x,y) {
    var form = document.getElementById(y); // contact form
   // submit button
    var alert = document.getElementById(x); // alert div for show alert message
    
    // form submit event
    form.on('submit', function(e) {
       // e.preventDefault(); // prevent default form submit
        // sending ajax request through jQuery
        $.ajax({
            url: this.action, // form action url
            type: 'POST', // form submit method get/post
            dataType: 'html', // request type html/json/xml
            data: form.serialize(), // serialize form data 
            beforeSend: function() {
                alert.fadeOut();
               // submit.html('Checking....'); // change submit button text
            },
            success: function(data) {
                alert.html(data).fadeIn(); // fade in response data
                form.trigger('reset'); // reset form
               // submit.html('Apply'); // reset submit button text
                //if(data != 'Invalid Gift Card!') {
                  alert.html(data);
                //}
            },
            error: function(e) {
                console.log(e)
            }
        });
       // alert(data);
       return false;  //Will not active the form submission
    });
    
    };
  /*  $(function () {
        var form = $('#comments_for');
        form.on('submit',function (e) {
            
              
                  $.ajax({
                    type: 'post',
                    url : this.action,
                    data: form.serialize(),
                   
                    success: function () {
                     alert("Email has been sent!");
                    }
                  });
                  return false;
            });
            //return false;
    });*/