(function($) {
  'use strict';
  var form = $("#example-form");
  form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onFinished: function(event, currentIndex) {
      alert("Submitted! ");
    }
  });
  var validationForm = $("#example-validation-form");
  validationForm.val({
    errorPlacement: function errorPlacement(error, element) {
      element.before(error);
    },
    rules: {
      confirm: {
        equalTo: "#password"
      }
    }
  });
  validationForm.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function(event, currentIndex, newIndex) {
      validationForm.val({
        ignore: [":disabled", ":hidden"]
      })
      return validationForm.val();
    },
    onFinishing: function(event, currentIndex) {
      validationForm.val({
        ignore: [':disabled']
      })
      return validationForm.val();
    },
    onFinished: function(event, currentIndex) {
      alert("Submitted!");
    }
  });
  var verticalForm = $("#example-vertical-wizard");
  var b = $("h");
    

 verticalForm.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});
  //verticalForm.submit.name = $("regetu");
  verticalForm.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    stepsOrientation: "vertical",
    labels: {
      current: "",
      finish: "Finish",
      next: "Next",
      previous: "Previous"
  },
    onStepChanging: function (event, currentIndex, newIndex)
    {
        verticalForm.validate().settings.ignore = ":disabled,:hidden";
       
        return verticalForm.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        //verticalForm.validate().settings.ignore = ":disabled,:hidden";
      // verticalForm.find('a[href="#finish"]').remove();
       //ele.remove();
       // verticalForm.children("div").append('<a href="javascript:"form".submit()" name="submit" type="submit">submit</a>');
      
        //remove default #finish button
       
        verticalForm.find('a[href="#finish"]').remove(); 
        verticalForm.find('a[href="#previous"]').remove();
        //append a submit type button
        verticalForm.append('<button class= "actions" type="submit" id="submitt" name = "submitt" style = "font-size: 1rem; line-height: 1; font-weight: 400;color: #fff;background-color: #F9A826;border-color: #F9A826;display: inline-block;text-align: center;white-space: nowrap;vertical-align: middle;user-select: none;border: 1px solid transparent;padding: 0.625rem 1rem;text-shadow: none;border-radius: 0.25rem;transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;margin-left:85%;    cursor: pointer;" >SUBMIT</button>');
     
        return verticalForm.valid();
    },
    onFinished: function(event, currentIndex) {
    
     // verticalForm.submit();
      alert("please click on submit down below to confirm");
  
    }
  });
})(jQuery);