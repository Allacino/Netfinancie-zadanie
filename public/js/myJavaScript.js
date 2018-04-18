(function ($) {
    console.log('jQuery is ready!');

    //deklaracia premennych na ktore budeme odchytavat udalosti
    var tableRow = $("#tableUsers > tbody > tr");

    // kliknutie na riadok
    tableRow.on('click',function () {
        console.log('Naplnenie formulara ...');
    });

    // prechod na riadok
    tableRow.on('mouseover',function(e) {
        $(this).css("background","#ddd");
    });
    // prechod z riadka
    tableRow.on('mouseout',function(e) {
        $(this).css("background","white");
    });

    // VALIDACIA LOGINU
    $('#formLogin').on('change', function (e) {

        var login = $(this).val(),
            validLogin = $('#validLogin'),
            reg;
        console.log('Validacia loginu : ' + login);
        reg = /^([A-Za-z0-9]{3,20})$/;
        if (reg.test(login) == false)
        {
            validLogin.text('Invalid Login');
            validLogin.css('color','red');
            console.log("Invalid Login");
        } else{
            validLogin.text("Valid Login");
            validLogin.css('color','DarkGreen');
            console.log("Valid Login");
        }
    });

    // VALIDACIA EMAILU
    $('#formEmail').on('change', function (e) {

        var email = $(this).val(),
            validEmail = $('#validEmail'),
            reg;
        console.log('Validacia emailu : ' + email);
        reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(email) == false)
        {
            validEmail.text('Invalid E-Mail adress');
            validEmail.css('color','red');
            console.log("Invalid E-Mail adress");
        } else{
            validEmail.text("Valid E-Mail adress");
            validEmail.css('color','DarkGreen');
            console.log("Valid E-Mail adress");
        }
    });

    // VALIDACIA PASSWORDU
    $('#formPassword').on('change', function (e) {

        var password = $(this).val(),
            validPassword = $('#validPassword'),
            reg;
        console.log('Validacia passwordu : ' + password);
        // reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        reg = /^([A-Za-z0-9_\-\.\#\+\~]{6,20})$/;
        if (reg.test(password) == false)
        {
            validPassword.text('Invalid Password');
            validPassword.css('color','red');
            console.log("Invalid Password");
        } else{
            validPassword.text("Valid Password");
            validPassword.css('color','DarkGreen');
            console.log("Valid Password");
        }
    });

})(jQuery);

function setForm(user) {
    var person = JSON.parse(user.getAttribute("data-user"));

    // alert("Email : " + person['email']);
    document.getElementById("userID").innerText = "User ID " + person['id'];
    document.getElementById("login").setAttribute('value', person['login']);
    document.getElementById("email").setAttribute('value', person['email']);
    document.getElementById("password").setAttribute('value', person['password']);
    document.getElementById("password_confirm").setAttribute('value', person['password']);
    document.getElementById("meno").setAttribute('value', person['meno']);
    document.getElementById("priezvisko").setAttribute('value', person['priezvisko']);
    document.getElementById("ulica").setAttribute('value', person['ulica']);
    document.getElementById("cislo").setAttribute('value', person['cislo']);
    document.getElementById("psc").setAttribute('value', person['psc']);
    document.getElementById("mesto").setAttribute('value', person['mesto']);
    document.getElementById("popis").value = person['popis'];
    document.getElementById("stav").value =person['stav'];
}

function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("tableUsers");
    switching = true;

    // Nastavenie sortovania
    dir = "asc";

    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.getElementsByTagName("TR");
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;

            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            // x = rows[i].getElementsByTagName("td")[n];
            x = rows[i].getElementsByClassName("sort")[n];
            // y = rows[i + 1].getElementsByTagName("td")[n];
            y = rows[i + 1].getElementsByClassName("sort")[n];

            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}