/**
 * Created by rober on 6/12/15.
 */
function encriptaPass() {

    var pass1 = document.getElementById("passwordU");
    var pass2 = document.getElementById("passwordConf");

    pass1.value=hex_md5(pass1.value);
    pass2.value=hex_md5(pass2.value);

    if (pass1.value==pass2.value) {

        return true;
    } else {

   alert("Las passwords no coinciden");
    return false;
    }
}

function calculaMD5() {

    var pass1 = document.getElementById("password");

    pass1.value=hex_md5(pass1.value);

    return true;

}

function limitText(limitField, limitCount, limitNum) {

    if (limitField.value.length > limitNum) {

        limitField.value = limitField.value.substring(0, limitNum);

    } else {

        limitCount.value = limitNum - limitField.value.length;
    }
}

