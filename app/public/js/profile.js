const editProfileButton = document.getElementById("edit-profile-button");
const saveProfileButton = document.getElementById("save-profile-button");
const cancelProfileButton = document.getElementById("cancel-profile-button");
const usernameInput = document.getElementById("username");
const locationInput = document.getElementById("location");
const aboutInput = document.getElementById("about");

editProfileButton.addEventListener("click", () => {
    editProfileButton.hidden = true;
    saveProfileButton.hidden = false;
    cancelProfileButton.hidden = false;

    usernameInput.disabled = false;
    locationInput.disabled = false;
    aboutInput.disabled = false;
});

cancelProfileButton.addEventListener("click", () => {
    editProfileButton.hidden = false;
    saveProfileButton.hidden = true;
    cancelProfileButton.hidden = true;

    usernameInput.disabled = true;
    locationInput.disabled = true;
    aboutInput.disabled = true;
});