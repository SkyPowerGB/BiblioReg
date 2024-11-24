document.addEventListener('DOMContentLoaded', () => {
  

    const deleteBtnClass="deleteUserBtn";

    const hideCssClass="sg-hide-div";

    const userIdinput=document.getElementById("userToDelete");

    const confirmDeactivateForm=document.getElementById("confirmDeactivateForm");

    const sgConfirmActionBtnCancel=document.getElementById("sgConfirmActionBtnCancel");
    
    const deleteUserBtns = document.getElementsByClassName(deleteBtnClass);

    Array.from(deleteUserBtns).forEach(button => {
        button.addEventListener("click", () => {
            const uid = button.value;
            userIdinput.value=uid;
            showConfirmDeleteForm();
            console.log("delete: "+uid);
        });
    });

    sgConfirmActionBtnCancel.addEventListener('click',()=>{
        hideConfirmDeleteForm();
    });
   

    function showConfirmDeleteForm(){
        if(confirmDeactivateForm.classList.contains(hideCssClass)){
            confirmDeactivateForm.classList.remove(hideCssClass);
        }

    }

    
    function hideConfirmDeleteForm(){
        if(!confirmDeactivateForm.classList.contains(hideCssClass)){
            confirmDeactivateForm.classList.add(hideCssClass);
        }
    }

});