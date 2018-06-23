<template>
    <div class="row">
        <div class="col-md-4 border rounded" >
            <ul class="tree">
            <categories-tree :model="categories" ></categories-tree>
            </ul>
        </div>
        <div class="col-md-8 border rounded" >
            <categories-details :selected_id="selected_id"></categories-details>
        </div>   
    </div>

</template>

<script>

import CategoriesTree from './CategoriesTree.vue';
import CategoriesDetails from './CategoriesDetails.vue';

export default {
    name: 'categories',

    components: {
        'categories-details': CategoriesDetails,
        'categories-tree': CategoriesTree,
    },

    data() {
        return {
            categories:{},
            selected_id:0,
            categories_opened:[]
        }
    },

    created() {
        this.fetchCategories();
    },

    methods:{

      
        fetchCategories() {
            fetch("/api/categories")
                .then(res=> res.json())
                .then(res => {
                    this.categories=res.data[0];
                    this.addMetaToCategories(this.categories);
                })
                .catch(err => console.log(err));
        },
        addMetaToCategories(cat){
            
            //additional child for new category
            let newCategory={
                id: -1,
                name: "<new>",
                parent_id: cat.id,
                children:[]
            }
            
            if (cat.id!=-1){
                let child={};
                for (child of cat.children){
                    this.addMetaToCategories(child);
                }
                cat.children.push(newCategory);
            }
        },
    }
}
</script> 