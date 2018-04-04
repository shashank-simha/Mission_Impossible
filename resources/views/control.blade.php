<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{asset('css/control.css')}}">
    <meta charset="UTF-8">
    <title>Access Control</title>
</head>
<body>
<header>
    Access Control
</header>
<button id="msgBtn">Hint</button>
<div id="defuseModal" class="model">
    <div id="defuseCont">
        <div id="msgHead">
            <p id="msgHeadTitle">Past Data</p>
            <span class="close">&times;</span>
        </div>
        <div id="msgs">
            <div id="msg2">
                <p id="msg2Text">
                    Hello Agent Sharmaji and Vermaji. According to new intel, Pakistan has launched a nuclear missile towards India. The target is unknown. Your mission, should you choose to accept it, is to infiltrate into the missile system, identify the target and change its course. You have 50 min 00 sec to accomplish it.

                    From previous recorded data, we have found these combinations for access control. The system uses same encryption everywhere. Use this info (if required) to infiltrate into the system.

                    <pre>
                        1. PQRSTUVWXYZ123456     -  passcode: UVWXYZABCDE
                        <br>
                        2. ANKURA2018            -  passcode: CPMWTC
                    </pre>
                </p>
            </div>
        </div>
    </div>
</div>

<div id="brief">

</div>
<div id="formModal">
    <div id="formCont">
        <p id="modalHead">Enter passcode to access the system</p>
        <span class="close">&times</span>
        <p id="crypt">BA367F49MISVQX5GLMR5Q</  p>
        <form action="home/1" method="POST">
            {{csrf_field()}}
            <input type="text" placeholder="Enter passcode here." name="controlKey" id="controlKey">
            <input type="submit" id="submitBtn" value="Submit" />
        </form>
    </div>
</div>
<style>
    #controlKey:focus {
        outline: 0;
    }
</style>
<script>
    var close = document.querySelectorAll(".close");
    var msg = document.querySelector("#msgBtn");
    var msgModal = document.querySelector("#defuseModal");
    var formModal = document.querySelector("#formModal");
    document.querySelector("#brief").onclick = function (ev) {
        document.querySelector("#formModal").style.display = "flex";
    };

    document.querySelector(".close").onclick = function () {
        document.querySelector("#formModal").style.display = "none";
    };
    window.onclick = function (ev) {
        if (ev.target === document.querySelector("#formModal")) {
            document.querySelector("#formModal").style.display = "none";
        }
    };
    msg.onclick = function () {
        msgModal.style.display = "flex";
    };


    close[0].onclick = function () {
        msgModal.style.display = "none";
    };

    close[1].onclick = function () {
        formModal.style.display = "none";
    };


</script>
</body>
</html>