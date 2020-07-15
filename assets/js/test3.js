
	$("#OP")(function(){
        var next_button = document.getElementById('OP');
        if ($("#userName").val() == '' || $("#password").val() == '' || $("#confirm").val() == '') {
            next_button.style.pointerEvents = 'none';
		}
	});
