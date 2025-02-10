////////////// PROGRESS BAR ////////////
    // Skill levels
const skillLevels = {
    html: 90,   // 90%
    css: 85,    // 85%
    php: 60,    // 60%
    mysql: 70   // 70%
};
    // Function to update progress bar dynamically
function updateProgressBar(skill, value) {
    let bar = document.getElementById(skill + "_bar");
    bar.style.width = value + "%";
    bar.textContent = value + "%";
}

    //Animate progress on pageload
window.onload = function () {
    updateProgressBar("html", skillLevels.html);
    updateProgressBar("css", skillLevels.css);
    updateProgressBar("php", skillLevels.php);
    updateProgressBar("mysql", skillLevels.mysql);
};