document.addEventListener('DOMContentLoaded', () => {

    const hideDivClass="sg-hide-div";

 const   editNameBtn=document.getElementById("editName");
 const   editEmailBtn=document.getElementById("editEmail");
 const  editPasswordBtn=document.getElementById("editPassword");
 const   editRoleBtn=document.getElementById("editRole");
 const   deactivateAccountBtn=document.getElementById("deactivateAccount");
 const   sgConfirmActionBtnCancel=document.getElementById("sgConfirmActionBtnCancel");

 const   nameSFform=document.getElementById("nameSFform");
 const   pswrdForm=document.getElementById("pswrdForm");
 const   emailForm=document.getElementById("emailForm");
 const   roleForm=document.getElementById("roleForm");
 const   confirmDeactivateForm=document.getElementById("confirmDeactivateForm");


    function showNameSFform(){
       if(nameSFform.classList.contains(hideDivClass)){

        nameSFform.classList.remove(hideDivClass);
       }
    }
    function hideNameSFform(){
        if(!nameSFform.classList.contains(hideDivClass)){

            nameSFform.classList.add(hideDivClass);
           }
    }
    function showPswrdForm(){
     if(pswrdForm.classList.contains(hideDivClass)){
        pswrdForm.classList.remove(hideDivClass)
     }
    }
    function hidePswrdForm(){
        if(!pswrdForm.classList.contains(hideDivClass)){
            pswrdForm.classList.add(hideDivClass)
         }
    }
    function showEmailForm(){
        if(emailForm.classList.contains(hideDivClass)){
            emailForm.classList.remove(hideDivClass);
        }
    }
    function hideEmailForm(){
        if(!emailForm.classList.contains(hideDivClass)){
            emailForm.classList.add(hideDivClass);
        }
    }
    function showRoleForm(){
        if(roleForm.classList.contains(hideDivClass)){
            roleForm.classList.remove(hideDivClass);

        }
    }
    function hideRoleForm(){
        if(!roleForm.classList.contains(hideDivClass)){
            roleForm.classList.add(hideDivClass);

        }
    }
    function showConfirmDeactivateForm(){
        if(confirmDeactivateForm.classList.contains(hideDivClass)){
            confirmDeactivateForm.classList.remove(hideDivClass);
        }
    }
    function hideConfirmDeactivateForm(){
        if(!confirmDeactivateForm.classList.contains(hideDivClass)){
            confirmDeactivateForm.classList.add(hideDivClass);
        }
    }

    //---------OPEN FORMS--------------------------------

    function openNameSFform(){
        showNameSFform();
        hidePswrdForm();
        hideEmailForm();
        hideRoleForm();
    }
    
    function openPswrdSFform(){
        hideNameSFform();
        showPswrdForm();
        hideEmailForm();
        hideRoleForm();
    }

    function openEmailForm(){
        hideNameSFform();
        hidePswrdForm();
        showEmailForm();
        hideRoleForm();
    }

    function openRoleForm(){
        hideNameSFform();
        hidePswrdForm();
        hideEmailForm();
        showRoleForm();
    }

    //----------------------------------------------------------

    editNameBtn.addEventListener('click',()=>{
     openNameSFform();

    });

    editEmailBtn.addEventListener('click',()=>{
        openEmailForm();
    });

    editPasswordBtn.addEventListener('click',()=>{
        openPswrdSFform();
    })

    editRoleBtn.addEventListener('click',()=>{
        openRoleForm();
    });

    deactivateAccountBtn.addEventListener('click',()=>{
        showConfirmDeactivateForm();
    });

    sgConfirmActionBtnCancel.addEventListener('click',()=>{
        hideConfirmDeactivateForm();
    });
        

});