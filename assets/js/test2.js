/*function hide_this_shit() {
    var next_button = document.getElementById('OP');
    if ($("#userName").val() == '' || $("#password").val() == '' || $("#confirm").val() == '')
    {
      
    next_button.style.pointerEvents = 'none';
     next_button.style.cursor = 'default';
     //document.querySelector('#OP').innerHTML = 'show comments';
    }
  };
  */
  function togglecomments(x, y) {
    // get the clock


    var mybutton = document.getElementById(y);


    var displaySetting = mybutton.style.display;


    var clockButton = document.getElementById(x);


    if (displaySetting == 'block') {
        // clock is visible. hide it
        mybutton.style.display = 'none';
        // change button text
        document.querySelector(x).innerHTML = 'show comments';

    } else {
        // clock is hidden. show it
        mybutton.style.display = 'block';
        // change button text
        document.querySelector(x).innerHTML = 'Hide comments';

    }
}