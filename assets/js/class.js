$("#exampleModal-2").submit(function(e){
    e.preventDefault();
    var name = $("#nameInput").val();
    var description = $("#descInput").val();
    var email = $("#mailInput").val();
    var filiere = $("#filiereInput").val();
    var sem = $("#semInput").val();
    var pw = $("#pwInput").val();

    var dataForm = 'name=' + name + '&description=' + description + '&email=' + email + '&filiere=' + filiere + '&pw=' + pw + '&sem=' + sem;
    
    $.ajax({
        type: 'POST',
        url: 'pfe2/index4.php',
        data: dataForm,
        success: function(html){
            if(html == "success"){
                $('#contactsTable').dataTable().reload();
                $('#exampleModal-2').modal('toggle');
            }
        }
        })
    });