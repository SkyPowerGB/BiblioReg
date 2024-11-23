document.addEventListener('DOMContentLoaded', () => {

    const hideClass = "sg-hide-div";

    const bookDisplay = document.getElementById("bookDisplay");
    const confirmActionForm = document.getElementById("confirmActionForm");
    const editBookForm = document.getElementById("editBookForm");

    const closeBookEditor = document.getElementById("closeBookEditor");
    const editBookBtn = document.getElementById("editBookBtn");
    const deleteBookBtn = document.getElementById("deleteBookBtn");

    const sgConfirmActionBtnCancel = document.getElementById("sgConfirmActionBtnCancel");


    editBookBtn.addEventListener('click', () => {
        if (editBookForm.classList.contains(hideClass)) {
            editBookForm.classList.remove(hideClass);
            bookDisplay.classList.add(hideClass);
        } else {

            editBookForm.classList.add(hideClass);
            bookDisplay.classList.remove(hideClass);

        }
    });

    deleteBookBtn.addEventListener('click', () => {
        if (confirmActionForm.classList.contains(hideClass)) {
            confirmActionForm.classList.remove(hideClass);


        }

    })
    sgConfirmActionBtnCancel.addEventListener('click', () => {
        if (!confirmActionForm.classList.contains(hideClass)) {
            confirmActionForm.classList.add(hideClass);


        }

    })

    closeBookEditor.addEventListener('click', () => {
        if (!editBookForm.classList.contains(hideClass)) {

            editBookForm.classList.add(hideClass);
            bookDisplay.classList.remove(hideClass);



        }

    })






});