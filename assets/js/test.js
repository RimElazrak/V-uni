function togglecomments() {
    // get the clock
    var mybutton = document.getElementById('hello');

    
    var displaySetting = mybutton.style.display;

 
    var clockButton = document.getElementById('Button4');

   
    if (displaySetting == 'block') {
      // clock is visible. hide it
      mybutton.style.display = 'none';
      // change button text
      document.querySelector('#button4').innerHTML = 'show comments';
      
    }
    else {
      // clock is hidden. show it
      mybutton.style.display = 'block';
      // change button text
      document.querySelector('#button4').innerHTML = 'Hide comments';

    }
  }