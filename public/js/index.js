var msg = document.querySelector("#msgBtn");
var msgModal = document.querySelector("#defuseModal");
var abort = document.querySelector("#abort");
var abortModal = document.querySelector("#abortModal");
var close = document.querySelectorAll(".close");
var abortMsg = document.querySelector("#abortMsg");
var abortVerdict = document.querySelector("#abortVerdict");
var submitBtn = document.querySelector("#submitBtn");
var abort_pass = document.querySelector("#abort_pass");
var BLINK = document.querySelector("#BLINK");
var min = document.querySelector("#min");
var se = document.querySelector("#se");
var riddleBtn = document.querySelector("#riddleBtn");
var finalResult, M;



close[0].onclick = function () {
    msgModal.style.display = "none";
};

close[1].onclick = function () {
    abortModal.style.display = "none";
};

msg.onclick = function () {
    msgModal.style.display = "flex";
    document.querySelector("#mark").style.display = "none";
};

abort.onclick = function () {
    abortModal.style.display = "flex";
};


// submitBtn.onclick = function () {
//     if (abort_pass.value !== "") {
//         var req = new XMLHttpRequest();
//         req.open("POST", "home/3", true);
//         req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         req.onreadystatechange = function () {
//             if (req.readyState === 4 && req.status === 200) {
//                 finalResult = req.responseText;
//                 console.log(finalResult);
//                 if (finalResult === "1") {
//                     abortVerdict.innerHTML = "Accepted";
//                     abortVerdict.style.color = "#0072FF";
//                     setTimeout(abortMissile, 750);
//                 } else {
//                     abortVerdict.innerHTML = "Denied";
//                     abortVerdict.style.color = "#ff2120";
//                 }
//             }
//         };
//         req.send("abort_pass=" + abort_pass.value);
//         abortVerdict.style.fontSize = "2.25rem";
//     }
// };

function abortMissile() {
    abort.style.backgroundColor = "#2aff48";
    abort.innerHTML = "Aborted";
    abort.onclick = function() {return false;};
    abort.style.cursor = "auto";
    BLINK.innerHTML = "Missile defused.";
    BLINK.style.animation = "none";
    clearInterval(x);
    min.innerHTML = se.innerHTML = "00";
    close[1].click()
}

abortMsg.innerHTML = "Enter the passcode to deactivate the missile.";