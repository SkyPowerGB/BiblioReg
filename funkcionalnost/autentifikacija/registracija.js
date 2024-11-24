document.addEventListener('DOMContentLoaded', () =>{

    const errorMsgClassCss = "";

    const formId="jsAutValidate"

    const autForm=document.getElementById(formId);

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


    //add events
    if (fNmInput != null) {
        fNmInput.addEventListener('change', () => {
            validateFname();
        });
    }

    if (lNmInput != null) {
        lNmInput.addEventListener('change', () => {
            validateLname();
        });
    }

    if (emailInput != null) {
        emailInput.addEventListener('change', () => {
            validateEmail();
        });
    }

    if (pswrdInput != null) {
        pswrdInput.addEventListener('change', () => {
            validatePassword();
        });
    }
    if (rptPswrdInput != null) {
        rptPswrdInput.addEventListener('change', () => {
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

    function validateEmail() { 

    }
    function validateFname() { 

    }
    function validateLname() { 

    }
    function validatePassword() { 

    }
    function validatePasswordRpt() { 


    }

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;




    function showValidationError(divComp, labelComp, msg) {


    }


    function removeValidationError(divComp, labelComp, defaultLabel) 
    { }

});