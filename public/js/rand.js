var temp = document.querySelector("#temp span");
var turb = document.querySelector("#turb span");
var stab = document.querySelector("#stab span");
var strike = document.querySelector("#strike span");
var pluto = document.querySelector("#pluto span");
var radius = document.querySelector("#radius span");
var expire;
temp_init = parseFloat(temp.innerHTML);
turb_init = parseFloat(turb.innerHTML);
stab_init = parseFloat(stab.innerHTML);
strike_init = parseFloat(strike.innerHTML);
radius_init = parseFloat(radius.innerHTML);

function getExpireTime() {
    var req = new XMLHttpRequest();
    req.open("GET", "getLoginTime", true);
    req.onreadystatechange = function (ev) {
        if (req.readyState === 4 && req.status === 200) {
            try {
                expire = new Date(JSON.parse(req.responseText)["date"]).getTime() + 80 * 60000;
            } catch(err) {
                expire = new Date(req.responseText).getTime() + 80 * 60000;
            }
            console.log(expire);
        }
    };
    req.send();
}

getExpireTime();
var diff = 0;
var x = setInterval(function() {
    var now = new Date().getTime();
    diff = expire - now;
    min.innerHTML = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    se.innerHTML = Math.floor((diff % (1000 * 60)) / 1000);
    if (diff < 0) {
        clearInterval(x);
        min.innerHTML = se.innerHTML = "00";
        if (abort.innerHTML === "Abort"){
            abort.innerHTML = "Failed";
        }
        BLINK.style.animation = "none";
        close[1].click();
        abort.onclick = function() {return false;};
    }
}, 1000);

var y = setInterval(function () {
    if (abort.innerHTML === "Abort") {
        temp.innerHTML = temp_init + parseInt(15 * Math.random());
        turb.innerHTML = turb_init + parseInt(40 * Math.random());
        stab.innerHTML = stab_init + parseInt(15 * Math.random());
        strike.innerHTML = strike_init + parseInt(10 * Math.random());
        radius.innerHTML = radius_init + parseInt(1.5 * Math.random());
    } else {
        temp.innerHTML = "NOT AVAILABLE";
        turb.innerHTML = "NOT AVAILABLE";
        stab.innerHTML = "NOT AVAILABLE";
        strike.innerHTML = "NOT AVAILABLE";
        pluto.innerHTML = "NOT AVAILABLE";
        radius.innerHTML = "NOT AVAILABLE";
        clearInterval(y);
    }
}, 50);