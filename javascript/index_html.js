////////////// PROGRESS BAR ////////////
    // Skill levels
const skillLevels = {
    html: 90,           // 90%
    css: 85,            // 85%
    js: 10,             // 10%
    php: 60,            // 60%
    mysql: 70,          // 70%
    bisaya: 99,         // 99%
    tagalog: 90,        // 80%
    english: 70,        // 60%
    japanese: 40        // 60%
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
    updateProgressBar("js", skillLevels.js);
    updateProgressBar("php", skillLevels.php);
    updateProgressBar("mysql", skillLevels.mysql);
    updateProgressBar("bisaya", skillLevels.bisaya);
    updateProgressBar("tagalog", skillLevels.tagalog);
    updateProgressBar("english", skillLevels.english);
    updateProgressBar("japanese", skillLevels.japanese);
};