<template>
    <div class="row">
        <div class="col-md-4 border rounded" >
            <div class="m-2">
                <ul class="tree">
                <categories-tree 
                    :model="categories"
                    :opened="opened">
                </categories-tree>
                </ul>
            </div>
        </div>
        <div class="col-md-8 border rounded" >
            <categories-details>
            </categories-details>
        </div>
    </div>
</template>

<script>

import CategoriesTree from './CategoriesTree.vue';
import CategoriesDetails from './CategoriesDetails.vue';

import {bus} from '../../app';
import {valert} from '../../app';

export default {
    name: 'categories',

    components: {
        'categories-details': CategoriesDetails,
        'categories-tree': CategoriesTree,
    },

    data() {
        return {
            categories:{},
            opened:[]
        }
    },

    created() {
        this.fetchCategories();
        bus.$on("updateTree", (arg)=>{
            this.fetchCategories();
        })
    },

    methods:{

        fetchCategories() {
            fetch("/api/categories")
                .then(res => res.json())
                .then(res => {
                    this.categories=res.data[0];
                    this.addMetaToCategories(this.categories);
                })
                .catch(err => console.log(err));
                console.log("fetched categories");
        },

        addMetaToCategories(cat){
            if (cat.id>0){
                let child={};
                for (child of cat.children){
                    this.addMetaToCategories(child);
                }
                //additional child for new category
                let newCategory={
                    id: cat.id*-1,   //id = parent_id * -1
                    name: "",
                    parent_id: cat.id,
                    children:[]
                }
                cat.children.push(newCategory);
            }
        },
    }
}
</script> 