var deleteAccountForm = document.getElementById("deleteAccountForm");

if (deleteAccountForm)
{
    deleteAccountForm.addEventListener("submit", function(event)
    {
        var confirmDelete = confirm(
            "Are you sure you want to delete your account?"
        );

        if (confirmDelete == false)
        {
            event.preventDefault();
        }
    });
}