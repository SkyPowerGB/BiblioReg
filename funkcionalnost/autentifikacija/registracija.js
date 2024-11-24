document.addEventListener('DOMContentLoaded', () => {






    const firstNameInputId = "idFnameInput";
    const lastNameInputId = "idLnameInput";
    const emailInputId = "idEmailInput";
    const passwordInputId = "idPswrdInput";
    const passwordRptInputId = "idRptPswrdInput";


    const firstNameLblId = "idFnameLbl";
    const lastNameLblId = "idLnameLbl";
    const emailLblId = "idEmailLbl";
    const passwordLblId = "idPswrdLbl";
    const passwordRptLblId = "idRptPswrdLbl";


    // var prep
    /**
     @const {HTMLInputElement} fNmInput;
     */

    const fNmInput = document.getElementById(firstNameInputId);
    const lNmInput = document.getElementById(lastNameInputId);
    const emailInput = document.getElementById(emailInputId);
    const pswrdInput = document.getElementById(passwordInputId);
    const rptPswrdInput = document.getElementById(passwordRptInputId);

    const fNmLbl = document.getElementById(firstNameLblId);
    const lNmLbl = document.getElementById(lastNameLblId);
    const emailLbl = document.getElementById(emailLblId);
    const pswrdLbl = document.getElementById(passwordLblId);
    const rptPswrdLbl = document.getElementById(passwordRptLblId);

    const fNmLblDefautlTxt = fNmLbl.innerHTML;
    const lNmLblDefaultTxt = lNmLbl.innerHTML;
    const emailLblDefaultTxt = emailLbl.innerHTML;
    const pswrdLblDefaultTxt = pswrdLbl.innerHTML;
    const rptPswrdLblDefaultTxt = rptPswrdLbl.innerHTML;


    //add events
    if (fNmInput != null) {
        fNmInput.addEventListener('keyup', () => {
            validateFname();
        });
    }

    if (lNmInput != null) {
        lNmInput.addEventListener('keyup', () => {
            validateLname();
        });
    }

    if (fNmInput != null) {
        fNmInput.addEventListener('focusout', () => {
            validateFname();
        });
    }

    if (lNmInput != null) {
        lNmInput.addEventListener('focusout', () => {
            validateLname();
        });
    }

    if (emailInput != null) {
        emailInput.addEventListener('focusout', () => {
            validateEmail();
        });
    }
    if (emailInput != null) {
        emailInput.addEventListener('keyup', () => {
            validateEmail();
        });
    }


    if (pswrdInput != null) {
        pswrdInput.addEventListener('focusout', () => {
            validatePassword();
            validatePasswordRpt();
        });
    }

    if (pswrdInput != null) {
        pswrdInput.addEventListener('keyup', () => {
            validatePassword();
             validatePasswordRpt();

        });
    }

    if (rptPswrdInput != null) {
        rptPswrdInput.addEventListener('focusout', () => {
            validatePasswordRpt();
        });
    }
    if (rptPswrdInput != null) {
        rptPswrdInput.addEventListener('keyup', () => {
            validatePasswordRpt();

        });
    }





    //registracija na prijavu
    const loginBtn = document.getElementById("gotoLoginPageBtn");
    if (loginBtn != null) {
        loginBtn.addEventListener('click', () => {
            window.location = "/WEBDEV/BiblioReg/stranice/prijava.php";

        });
    };

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

    const valErrEmpty = "Ovo polje je obavezno";

    function validateEmail() {
        if (emailInput.value == "") {
            showValidationErrorJS(emailInputId, emailLblId, valErrEmpty, emailLblDefaultTxt);
        } else {
            removeValidationErrorJS(emailInputId, emailLblId, emailLblDefaultTxt);
        }
        if (emailRegex.test(emailInput.value)) {
            removeValidationErrorJS(emailInputId, emailLblId, emailLblDefaultTxt);
        } else {
            showValidationErrorJS(emailInputId, emailLblId, "Email adresa neispravna", emailLblDefaultTxt);
        }

    }
    function validateFname() {
        if (fNmInput.value == "") {
            showValidationErrorJS(firstNameInputId, firstNameLblId, valErrEmpty, fNmLblDefautlTxt);
        } else {
            removeValidationErrorJS(firstNameInputId, firstNameLblId, fNmLblDefautlTxt);
        }
    }
    function validateLname() {
        if (lNmInput.value == "") {
            showValidationErrorJS(lastNameInputId, lastNameLblId, valErrEmpty, lNmLblDefaultTxt);
        } else {
            removeValidationErrorJS(lastNameInputId, lastNameLblId, lNmLblDefaultTxt);
        }
    }
    function validatePassword() {
        if (pswrdInput.value == "") {
            showValidationErrorJS(passwordInputId, passwordLblId, valErrEmpty, pswrdLblDefaultTxt);
        } else {
            removeValidationErrorJS(passwordInputId, passwordLblId, pswrdLblDefaultTxt);
        }
        if (!passwordRegex.test(pswrdInput.value)) {

            showValidationErrorJS(passwordInputId, passwordLblId, "Lozinka mora imati 8 znakova te jedno veliko i malo slovo", pswrdLblDefaultTxt);
        } else {
            removeValidationErrorJS(passwordInputId, passwordLblId, pswrdLblDefaultTxt);
        }

    }
    function validatePasswordRpt() {
        
   

        if (rptPswrdInput.value == "") {
            showValidationErrorJS(passwordRptInputId, passwordRptLblId, valErrEmpty, rptPswrdLblDefaultTxt);
        } else {
            removeValidationErrorJS(passwordRptInputId, passwordRptLblId, rptPswrdLblDefaultTxt);
        }

        if (rptPswrdInput.value === pswrdInput.value) {
            removeValidationErrorJS(passwordRptInputId, passwordRptLblId, rptPswrdLblDefaultTxt);
           
           
        } else {
            showValidationErrorJS(passwordRptInputId, passwordRptLblId, "Lozinke se ne podudaraju", rptPswrdLblDefaultTxt);
        }


    }


    const errorMsgClassCss = "sg-form-validation-error";

    const inputErrMsgClassCss = "sg-form-validation-error-input";

    function showValidationErrorJS(inputCompId, labelCompId, msg, lblDefTxt) {

        const lbl = document.getElementById(labelCompId);
        const inputComp = document.getElementById(inputCompId);

        if (!inputComp.classList.contains(inputErrMsgClassCss)) {
            inputComp.classList.add(inputErrMsgClassCss);
        }

        if (!lbl.classList.contains(errorMsgClassCss)) {
            lbl.classList.add(errorMsgClassCss);
        }
        lbl.innerHTML = lblDefTxt + " " + msg;



    }

    function removeValidationErrorJS(inputCompId, labelCompId, lblDefTxt) {
        const lbl = document.getElementById(labelCompId);
        const inputComp = document.getElementById(inputCompId);

        if (inputComp.classList.contains(inputErrMsgClassCss)) {
            inputComp.classList.remove(inputErrMsgClassCss);
        }

        if (lbl.classList.contains(errorMsgClassCss)) {
            lbl.classList.remove(errorMsgClassCss);
        }
        lbl.innerHTML = lblDefTxt;


    }

});