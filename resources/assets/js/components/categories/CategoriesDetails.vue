<template>
    <div>
        <div v-if="validCat" class="m-2">
            <div class="form-group row">
                <label class="col-form-label col-sm-3">
                    Name: 
                </label>
                <input type="text" class="form-control col-sm-9" v-model="category.name">
            </div>
            
            <div class="form-group row">
                <label class="col-form-label col-sm-3">
                    Artno: 
                </label>
                
                <div class="input-group col-sm-4 p-0">
                    <div class="input-group-prepend" v-if="category.parent">
                        <div class="input-group-text">{{category.parent.artno_min}}</div>
                    </div>
                    <input type="text" 
                        class="form-control"
                        placeholder="min. Artno"
                        v-model="category.artno_min">
                </div>
                
                <label class="col-form-label col-sm-1 text-center">
                    -  
                </label>
                
                <div class="input-group col-sm-4 p-0">
                    <div class="input-group-prepend" v-if="category.parent">
                        <div class="input-group-text">{{category.parent.artno_max}}</div>
                    </div>
                    <input type="text" 
                        class="form-control"
                        placeholder="max. Artno"
                        v-model="category.artno_max">
                </div>

            </div>
            <div class="form-group row">
                <button class="btn btn-primary btn-block" @click="apiUpdate" v-if="category.id>0">
                    <i class="far fa-save"> Speichern </i>
                </button>
                <button class="btn btn-primary btn-block" @click="apiStore" v-if="category.id<=0">
                    <i class="far fa-save"> Speichern (neu)</i>
                </button>

                <button class="btn btn-danger btn-sm ml-auto" v-if="category.id>0">
                    <i class="far fa-trash-alt"> Löschen </i>
                </button>
            </div>
            <div class="text-right font-weight-light small">
                id: {{category.id}}<br>
                parent_id: {{category.parent_id}}
            </div>
        </div>
    </div>
</template>

<script>

import {bus} from '../../app';
export default {
    name: 'categories-details',
    data() {
        return {
            category:{
            },
        }
    },
    computed: {
        validCat: function () {
            return this.category &&
            this.category.hasOwnProperty('id')
        }
    },
    created() {
        bus.$on("selectionChange", (id)=>{
            this.apiShow(id);
        })
    },
    methods:{

        //show
        apiShow(id) {
            if (id>0){
                fetch("/api/categories/"+id)
                    .then(res=> res.json())
                    .then(res => {
                        this.category=res.data[0];
                    })
                    .catch(err => console.log(err));
            }
            else{
                // new Category, id equals -parent_id
                this.category={
                    id:0,
                    name:"",
                    parent_id: id*-1,
                    artno_min: null,
                    artno_max: null,
                    parent: null
                };
                //get parent from api
                fetch("/api/categories/"+this.category.parent_id)
                    .then(res=> res.json())
                    .then(res => {
                        this.category.parent=res.data[0];
                    })
                    .catch(err => console.log(err))
            }
        },

        //store

        apiStore(){
            if (this.category.id==0){
                fetch("/api/categories",
                {   
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: "POST",
                    body: JSON.stringify(this.category)
                })
                    .then(res=> res.json())
                    .then(res => {
                        if (!res.data.errors){
                            this.category=res.data;
                            bus.$emit("updateTree");
                        }
                        else{
                            //errorhandling
                        }
                    })
                    .catch(err => console.log(err));
            }

        },

        //update

        apiUpdate(){
            if (this.category.id>0){
                this.category;  
                fetch("/api/categories/"+this.category.id,
                {   
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: "PUT",
                    body: JSON.stringify(this.category)
                })
                    .then(res=> res.json())
                    .then(res=> {
                        bus.$emit("updateTree");
                    })
                    .catch(err => console.log(err));
            }
        }

        //destroy
    }
}
</script> 