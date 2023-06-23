function gotowhatsapp() {
    alert("You will be prompt to Whatsapps.");

    var name = document.getElementById("name").value;
    var phone = document.getElementById("contact-phone").value;
    var email = document.getElementById("contact-email").value;
    var message = document.getElementById("contact-message").value;

    var url = 
    "https://wa.me/+60198881654?text=" + 
    "Name: " + name + "%0a" + 
    "Phone: " + phone + "%0a" + 
    "Email: " + email  + "%0a" + 
    "Message: " + message + "%0a"; 

    window.open(url, '_blank').focus();
}