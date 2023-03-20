<template>
    <v-app id="inspire">
        <v-app id="inspire">
            <v-app-bar app color="red  darken-4" dark>
                <v-toolbar-title><img src="img/gamo.png" width="75px" alt=""> Fichaje</v-toolbar-title>
            </v-app-bar>
            <v-main>
                <v-container >
                    <v-row align="center" justify="center" >
                        <v-col v-for="(item, i) in units" :key="i" cols="12" md="4">
                            <v-card :color="item.color" dark @click="ticket(item)">
                                <div class="d-flex flex-no-wrap justify-space-between">
                                    <div>
                                        <v-card-title
                                            class="headline"
                                            v-text="item.abreviatura"
                                        ></v-card-title>

                                        <v-card-subtitle v-text="item.nombre"></v-card-subtitle>
                                    </div>
                                    <v-avatar class="ma-2" size="250" tile>
                                        <v-img class="imagen" :src="'img/'+item.id+'.jpg'" cover></v-img>
                                    </v-avatar>
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>
            </v-main>
            <v-footer
                color="red darken-4"
                app
            >
                <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
            </v-footer>
        </v-app>
    </v-app>
</template>
<style scoped>
.imagen {
    width:100%;
}
</style>

<script>
import moment from 'moment';
    export default {
        mounted() {
            // console.log('Component mounted.')
            axios.get('/unit').then(res=>this.units=res.data)
        },
        methods:{
            ticket(item){
                // console.log('aaa');
                moment.locale('es');
                axios.post('/ticket',{unit_id:item.id}).then(async res=>{
                    console.log(res.data);
                    let myWindow = await window.open("", "myWindow", "width=200,height=100");
                    myWindow.document.write('<style>*{padding:0px;border:0px;margin:0px;}</style><div style="text-align:center;padding-left: 25px;padding-right: 25px;">' +
                        '<div style="border: 1px solid black">' +
                            '<img width="120" src="img/gamo.png" alt="">' +
                            '<p>'+item.nombre+'</p>' +
                            '<h4>'+res.data.numero+'</h4>' +
                            '<p>Tome asiento y espere su turno</p>' +
                            '<p>'+moment().format('D MMMM YYYY, h:mm:ss a')+'</p>' +
                            '</div>' +
                        '</div>');
                    myWindow.focus();
                    myWindow.print();
                    myWindow.close();
                    // setTimeout(function(){

                    // },250);

                })
            }
        },
        props: {
            source: String,
        },
        data: () => ({
            drawer: null,
            units:[],
            items: [
                {
                    color: '#1F7087',
                    src: 'https://cdn.vuetifyjs.com/images/cards/foster.jpg',
                    title: 'Supermodel',
                    artist: 'Foster the People',
                },
                {
                    color: '#952175',
                    src: 'https://cdn.vuetifyjs.com/images/cards/halcyon.png',
                    title: 'Halcyon Days',
                    artist: 'Ellie Goulding',
                },
            ],
        }),
    }
</script>
