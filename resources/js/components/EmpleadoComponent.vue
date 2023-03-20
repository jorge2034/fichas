<template>
    <v-app id="inspire">
        <v-app id="inspire">
            <v-app-bar app color="red  darken-4" dark>
                <v-toolbar-title><img src="img/gamo.png" width="75px" alt=""> Bienvenido {{nombrecaja}}</v-toolbar-title>
            </v-app-bar>
            <v-main>
                <v-container >
                    <v-row align="center" justify="center" >
                        <v-dialog v-model="dialog" persistent max-width="600px">
                            <v-card>
                                <v-card-title>
                                    <span class="headline">Login</span>
                                </v-card-title>
                                <v-card-text>
                                    <form @submit.prevent="login">
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12" sm="6">
                                                <v-text-field label="Nombre*" required v-model="user.nombre"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                    label="Password*"
                                                    required
                                                    v-model="user.password"
                                                    type="password"
                                                    autocomplete
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="12">
                                                <v-text-field label="Nombre Caja*" v-model="user.nombrecaja" required></v-text-field>
                                            </v-col>
<!--                                            <v-col cols="12" sm="6">-->
<!--                                                <v-select-->
<!--                                                    :items="units"-->
<!--                                                    item-text="nombre"-->
<!--                                                    label="Unidad*"-->
<!--                                                    required-->
<!--                                                    v-model="user.unidad"-->
<!--                                                ></v-select>-->
<!--                                            </v-col>-->
<!--                                            {{ user }}-->
                                        </v-row>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
<!--                                            <v-btn color="red darken-1" @click="dialog = false">Close</v-btn>-->
                                            <v-btn color="primary darken-1" block type="submit">Login</v-btn>
                                        </v-card-actions>
                                    </v-container>
                                    </form>
                                </v-card-text>

                            </v-card>
                        </v-dialog>
                    </v-row>
                    <v-btn @click="atender()" color="primary">Atender</v-btn>
                    <v-simple-table dense>
                        <template v-slot:default>
                            <thead>
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-left">Empleado</th>
                                <th class="text-left">Ticket</th>
                                <th class="text-left">Estado</th>
                                <th class="text-left">Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in tickets" :key="index">
                                <td>{{ index+1 }}</td>
                                <td>{{ item.empleado }}</td>
                                <td>{{ item.numero }}</td>
                                <td>{{ item.estado }}</td>
                                <td>{{ item.created_at }}</td>
                            </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
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

<script>
import moment from 'moment';
export default {
    mounted() {
        // console.log('Component mounted.')
        axios.get('/unit').then(res=>this.units=res.data)

        this.socket.on('chat message', function(msg){
          console.log("mensaje socket",msg)
        });
    },
    methods:{
        datosatender(nombrecaja){
          axios.post('datosatender',{nombrecaja:nombrecaja}).then(res=>{
              this.tickets=res.data;
          })
        },
        atender(){
            axios.post('/atender',{nombrecaja:this.nombrecaja,unit_id:this.user.unit_id})
                .then(res=>{
                    // this.tickets=res.data
                    console.log("atender",res.data)
                    this.datosatender(this.nombrecaja);
                    axios.post('/ultificha',{unit_id:this.user.unit_id})
                        .then(res=>{
                            console.log(res);
                            this.socket.emit('chat message', res.data.numero+"->"+res.data.empleado);
                        });
                }).catch(res=>{
                    alert('Todos los clientes fueron atendidos')
                });
        },
        login(){
            axios.post('/login',{nombre:this.user.nombre,password:this.user.password}).then(res=>{
                if(res.data.length>0){
                    this.dialog=false
                    this.nombrecaja=this.user.nombrecaja;
                    this.user=res.data[0];
                    this.datosatender(this.nombrecaja);
                }else{
                    alert("usuario no encotrado");
                }
            });
        }
    },
    props: {
        source: String,
    },
    data: () => ({
        dialog: true,
        drawer: null,
        units:[],
        user:{},
        nombrecaja:"",
        tickets:[],
        // socket : io('http://192.168.154.130:3000'),
        socket : io('http://192.168.154.208:3000'),
    }),
}
</script>
