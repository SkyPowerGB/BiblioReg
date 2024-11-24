const errorMsgClassCss = "sg-form-validation-error";
const inputErrMsgClassCss = "sg-form-validation-error-input";

function showValidationError(inputCompId, labelCompId, msg, lblDefTxt) {
   
    const lbl = document.getElementById(labelCompId);
    const inputComp = document.getElementById(inputCompId);


    if (inputComp && lbl) {
        
        if (!inputComp.classList.contains(inputErrMsgClassCss)) {
            inputComp.classList.add(inputErrMsgClassCss);
        }

        if (!lbl.classList.contains(errorMsgClassCss)) {
            lbl.classList.add(errorMsgClassCss);
        }

      
        lbl.innerHTML = (lblDefTxt || '') + " " + (msg || '');
    }
}

function removeValidationError(inputCompId, labelCompId, lblDefTxt) {

    const lbl = document.getElementById(labelCompId);
    const inputComp = document.getElementById(inputCompId);

  
    if (inputComp && lbl) {
       
        if (inputComp.classList.contains(inputErrMsgClassCss)) {
            inputComp.classList.remove(inputErrMsgClassCss);
        }

        if (lbl.classList.contains(errorMsgClassCss)) {
            lbl.classList.remove(errorMsgClassCss);
        }

       
        lbl.innerHTML = lblDefTxt || ''; 
    }
}

