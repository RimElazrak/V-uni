function togglecomments() {

    // get the clock
    var mybutton = document.getElementById('hello');
    //var v = $('#hello');
   
    var displaySetting = mybutton.style.display;

 // mybutton.style.display = 'block';
    var clockButton = document.getElementById('Button4');

   
    if (displaySetting == 'block') {
      // clock is visible. hide it
      mybutton.style.display = 'none';
    
      
    //  v.find(' <ul class=\"solid-bullet-list\">').remove();
      // change button text
      document.querySelector('#button4').innerHTML = 'show comments';
      
    }
    else {
      // clock is hidden. show it
     
      mybutton.style.display = 'block';
      //v.append('<ul class=\"solid-bullet-list\">');
      // change button text
      document.querySelector('#button4').innerHTML = 'Hide comments';
    }

    
  };