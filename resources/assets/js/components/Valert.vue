<template>
    <div v-if="isOpen"> 
        <div v-if="hasErrors" class="alert alert-danger" role="alert" >
            {{statusCode}}:{{message}}
            <ul>
                <li v-for="(err, index) in errors" v-bind:key="index">{{err}}</li>
            </ul>
        </div>
        <div v-else class="alert alert-success" role="alert">
            <span v-if="statusCode">{{statusCode}}:</span><span> {{message}}</span>
        </div>
    </div>
</template>

<script>
import {valert} from '../app';
export default {
    name: 'valert',

    data() {
        return {
            statusCode:0,
            errors:[],
            message:"",
            isOpen:0
        }
    },

    computed: {
        hasErrors: function () {
            return (this.errors)
        }
    },

    methods: {
        showAlert(){
            this.isOpen++;
            setTimeout(()=> {
                    this.isOpen--;
                    if(this.isOpen<0){
                        this.isOpen=0;
                    }
                }, 5000);
        },

    },
    
    created() {
        valert.$on("valert", (arg)=>{
            this.errors=this.message=this.statusCode=null;

            if (arg.errors){
                this.errors=arg.errors;
            }
            if (arg.message){
                this.message=arg.message;
            }
            if (arg.statusCode){
                this.statusCode=arg.statusCode;
            }
            this.showAlert();
        })
    }
}
</script> 