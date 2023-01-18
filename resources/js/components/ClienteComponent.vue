<template>
<!--    <div class="container-fluid">-->
<!--        <div class="row">-->
<!--            <div class="col-12" style="width: 100%;border: 1px solid black;">-->

<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div >
        <div  style="border: 1px solid black;background: #263238;height: 70vh;width: 100%">
            <center>
                <video controls src="video/spot1.mp4"  style="height: 70vh" autoplay muted playsinline id="videoElementId">
                    Your browser does not support HTML video.
                </video>
<!--                <button @click="aumentar" style="background: red">lorem*10</button>-->
            </center>
        </div>
        <div style="height: 30vh;border: 1px solid #c68400;background: #ffe54c">
            <div class="grid" id="fichas" >
                                    <div  class="col" style="display: flex;align-items: center;text-align: center">
                                        <p style="  font-size:3em;font-weight:bold;text-align: center;width: 100%" >
                                                 TC-8->10
                                        </p>
                                    </div>
            </div>
        </div>
    </div>
</template>

<script>

// window.onload=function (){
//
// }
// window.addEventListener('load', function(){


// });

// Similarly, you can also introduce the plugin resource pack you want to use within the component
// import 'some-videojs-plugin'
const $ = require('jquery');

export default {
    data() {
        return {
            // playerOptions: {
            //     // videojs options
            //     // muted: true,
            //     height: '360',
            //     autoplay:true,
            //     language: 'en',
            //     // playbackRates: [0.7, 1.0, 1.5, 2.0],
            //     sources: [{
            //         type: "video/mp4",
            //         src: "video/spot1.mp4"
            //     }]
            // },
            video:1,
            array: ['','','','','','','',''],
            socket : io('http://192.168.154.208:3000'),
            // socket : io('http://192.168.154.130:3000'),
        }
    },
    mounted() {

        var cont=1;
        var newVideo = document.getElementById('videoElementId');
        newVideo.addEventListener('ended', function() {
            cont++;
            // console.log(newVideo);
            newVideo.src = "video/spot"+cont+".mp4";
            if (cont==9)cont=0;
            newVideo.load();
        }, false);
        newVideo.play();

        // var socket = io();

        // var socket = io();

        // console.log('this is current player instance object', this.player)
        // this.aumentar('aa');
        // this.array.pop();
        // this.array.unshift('aa');
        var array= ['','','','','','','',''];
        this.socket.on('chat message', function(msg){
            array.pop();
            array.unshift(msg);
            // console.log(msg);
            $('#fichas').html('');
            for (let i=0;i<8;i++){
                $('#fichas').append('<div  class="col" style="display: flex;align-items: center;text-align: center">' +
                    '                    <p style="  font-size:3em;font-weight:bold;text-align: center;width: 100%" >' +
                    array[i] +
                    '                    </p>' +
                    '                </div>');
            }
        });
    },
    computed: {
        player() {
            // return this.$refs.videoPlayer.player
        }
    },
    methods: {
        aumentar(){
            // var
            this.socket.emit('chat message', 'aaa');
        },
        // listen event
        onPlayerPlay(player) {
            console.log('player play!', player)
        },
        onPlayerPause(player) {
            // console.log('player pause!', player)
        },
        // ...player event

        // or listen state event
        playerStateChanged(playerCurrentState) {
            // console.log('player current update state', playerCurrentState)
        },

        // player is ready
        playerReadied(player) {
            console.log('the player is readied', player)
            // you can use it to do something...
            // player.[methods]
        },
        onPlayerEnded(player){
            this.video++;
            console.log('acabo', player)
            this.playerOptions.sources=[{
                type: "video/mp4",
                src: "video/spot"+this.video+".mp4"
            }];
            this.onPlayerPlay(player);
            if (this.video==9) this.video=0;
        }
    }
}
</script>
<style>
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
html, body {
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
    background: white;
}
.grid {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 100%;
    padding: 5px;
    gap: 1px;
}
.col {
    float: left;
    width: 25%;
    height: 50%;
    background: #ffb300;
    border: 2px solid white;
    border-radius: 1em;
}
</style>
