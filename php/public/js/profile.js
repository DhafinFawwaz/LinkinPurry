const editProfileButton = document.getElementById("edit-profile-button");
const saveProfileButton = document.getElementById("save-profile-button");
const cancelProfileButton = document.getElementById("cancel-profile-button");
const usernameInput = document.getElementById("username");
const locationInput = document.getElementById("location");
const aboutInput = document.getElementById("about");

let currentUsername;
let currentLocation;
let currentAbout;

try{
    currentUsername = usernameInput.value;
    currentLocation = locationInput.value;
    currentAbout = aboutInput.value;
} catch (e) {}

editProfileButton.addEventListener("click", () => {
    try{
        editProfileButton.hidden = true;
        saveProfileButton.hidden = false;
        cancelProfileButton.hidden = false;

        usernameInput.disabled = false;
        locationInput.disabled = false;
        aboutInput.disabled = false;
    } catch (e) {}

});

cancelProfileButton.addEventListener("click", () => {
    try{
        editProfileButton.hidden = false;
        saveProfileButton.hidden = true;
        cancelProfileButton.hidden = true;
        
        usernameInput.value = currentUsername;
        usernameInput.disabled = true;
        
        locationInput.value = currentLocation;
        locationInput.disabled = true;
        
        aboutInput.value = currentAbout;
        aboutInput.disabled = true;
    } catch (e) {}
});