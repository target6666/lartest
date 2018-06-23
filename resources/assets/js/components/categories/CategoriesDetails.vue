<template>
    <div>
        <div v-if="validCat">
            <div class="row">
                <div class="col-md-4">
                    Name: 
                </div>
                <div class="col-md-8">
                    <input type="text" v-model="this.category.name">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    selected_id: 
                </div>
                <div class="col-md-8">
                    <input type="text" v-model="this.category.id">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    selected_parent_id: 
                </div>
                <div class="col-md-8">
                    <input type="text" v-model="this.category.parent_id">
                </div>
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
                //console.log(this.category);
            }
            else{
                // new Category, id equals -parent_id
                this.category={
                    id:0,
                    name:"Neue Warengruppe",
                    parent_id: id*-1,
                    artno_min: 0,
                    artno_max: 0

                }
            }
        },

        //store

        //update

        //destroy
    }
}
</script> 