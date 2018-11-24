
var inputpass = document.getElementById('password'),
    cek = document.getElementById('cek'),
    label = document.getElementById('showpass');

cek.onclick = function () {

    if (cek.checked){
        inputpass.setAttribute('type', 'text');
        // label.textContent = 'Hide Password';
    } else {
        inputpass.setAttribute('type', 'password');
        // label.textContent = "Show Password";
    }

}