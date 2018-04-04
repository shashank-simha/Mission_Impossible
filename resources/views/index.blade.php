<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <meta charset="UTF-8">
    <title>ISI Nuclear Interface</title>
</head>
<body>
<header>
    <div id="logo">
    </div>
    <p>Nuclear Interface Control</p>
    <div id="msgDiv">
        <div id="mark"></div>
        <button id="msgBtn">
            Messages
        </button>
    </div>
</header>
<section id="sec">
    <section id="MAIN">
        <article id="Stat">
            <div id="missileStat">
                <p>Payload Analysis</p>
            </div>
            <div id="param">
                <p id="pluto">Plutonium: <span>0.2</span> Kg</p>
                <p id="temp">Temperature: <span>910</span> K</p>
                <p id="turb">Turbulance: <span>120</span> N</p>
                <p id="stab">Stability: <span>13.23</span></p>
                <p id="coor">Coordinates: NOT AVAILABLE</p>
                <p id="strike">Strike velocity: <span>102</span> m/s</p>
                <p id="radius">Impact radius: <span>12</span> KM</p>
            </div>
        </article>
        <article id="map">
            <div id="mapDiv">
                <p>Current Impact</p>
            </div>
            <div id="mapImg"></div>
        </article>
        <article id="timerArt">
            <div id="timeDiv">
                <p>Timing Portal</p>
            </div>
            <div id="timer">
                <div id="timerCont">
                    <p id="min">45</p>
                    <p id="colon">:</p>
                    <p id="se">00</p>
                </div>
            </div>
        </article>
    </section>
    <section id="control">
        <div><p id="BLINK">Target: UNKNOWN</p></div>
        <button id="abort" onclick="abortStart()">Abort</button>
    </section>
</section>
<div id="defuseModal" class="model">
    <div id="defuseCont">
        <div id="msgHead">
            <p id="msgHeadTitle">Messages</p>
            <p class="close">&times;</p>
        </div>
        @if($_SESSION["Team"]["stage4"]==0 && $_SESSION["Team"]["stage3"]!=0)
            <div id="msg4">
                <p class="msg2Text">
                    Agent sharmaji and vermaji, we have obtained the circuitry which contains a secret key to defuse the missile trigger.
                    You need to obtain two 8 bit numbers out of the circuitry and the sum of which forms the secret.
                    We have faxed you the copy of circuit. Please Enter the Secret Key and abort the <missile></missile>.

                </p>
            </div>
        @endif
        @if($_SESSION["Team"]["stage3"]==0 && $_SESSION["Team"]["stage2"]!=0)
            <div id="msg3">
                <p class="msg2Text">
                    Agent sharmaji and vermaji, we want to redirect the missile to <b>PACIFIC</b>, Since the TARGET is now known, change the course of the missile to PACIFIC. We have faxed you the circuit. Each encrypted character is represented by ON LEDs as LED indexes. For each character, notedown the Indexes of ON LEDs. This code will direct to pacific.
                </p>
                <form action="/home/3" method="post">
                    {{csrf_field()}}
                    <input type="text"  name="pacific" id="pacific">
                    <input type="submit" id="pacificBtn" value="Submit" /> <span id="riddleSpan"></span>
                </form>            </div>
        @endif
    @if($_SESSION["Team"]["stage2"]==0 && $_SESSION["Team"]["stage1"]!=0)
            <div id="msg2">
                <p class="msg2Text">
                    Agent sharmaji and vermaji, we have scanned through the missile's internal systems and found this code and suspect that it contains information about the TARGET. Please analyse it and find which part of our nation is in danger.
                    <pre>
                    #include "missile.h"

                    void main() {
                        char * tar = "0100100001101111011011100110011101111000";
                        sendMissiletoTar(tar);
                    }
                    </pre>
                {{--char * tar = "0100100001101111011011100110011101111000";--}}
                </p>
                <form action="/home/2" method="post">
                    {{csrf_field()}}
                    <input type="text"  name="riddle_pass" id="riddle_pass">
                    <input type="submit" id="riddleBtn" value="Submit" /> <span id="riddleSpan"></span>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>

<div id="abortModal" class="model">
    <div id="abortCont">
        <div id="abortHead">
            <p id="abortHeadTitle">Abort Initialization</p>
            <p class="close">&times;</p>
        </div>
        <div id="abortInput">
            <p id="abortMsg"></p>
            <input type="text" autocomplete="off" id="abort_pass" name="abort_pass" placeholder="Enter passcode here" onfocus="this.placeholder=' '" onblur="this.placeholder = 'Enter passcode here'">
            <button id="submitBtn">Submit</button>

            <p id="abortVerdict"></p>
        </div>

    </div>
</div>

<footer>
    <p>© 2018, Inter-Services Intelligence, Pakistan</p>
</footer>
<script src="{{asset('js/index.js')}}"></script>
<script src="{{asset('js/rand.js')}}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
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


    var finalVerdict;
    document.querySelector("#submitBtn").onclick = function (ev) {

        $.ajax({
            type: "POST",
            url: '/home/4',
            data: { abort_pass: document.querySelector("#abort_pass").value, _token: '{{csrf_token()}}' },
            success: function (data) {
                finalVerdict = data;
                console.log(finalVerdict);
                if (finalVerdict === "1") {
                    console.log("Success:"+ finalVerdict);
                    abortVerdict.innerHTML = "Accepted";
                    abortVerdict.style.color = "#0072FF";
                    setTimeout(abortMissile, 750);
                } else {
                    console.log("Success:"+ finalVerdict);
                    abortVerdict.innerHTML = "Denied";
                    abortVerdict.style.color = "#ff2120";
                }
            },
            error: function (data, textStatus, errorThrown) {
                finalVerdict = data;
                console.log("Fukced");
            },
        });


        abortVerdict.style.fontSize = "2.25rem";

    };

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

</script>
<style>
    #mark {
        background-image: url("{{asset('images/mark.png')}}");
    }

    #mapImg {
        background-image: url("{{asset('images/map.jpg')}}");
    }

    #logo {
        background-image: url("{{asset('images/isi.png')}}");
    }
</style>
</body>
</html>