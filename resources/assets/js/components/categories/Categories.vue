<template>
    <div class="row">
        <div class="col-md-4">
            Liste
        </div>
        <div class="col-md-8">
            Details
        </div>   
    </div>

</template>

<script>
export default {
    name: 'categories',
    data() {
        return {
            categories:{},
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
                    this.categories=res.data;
                })
                .catch(err => console.log(err));
            console.log("categories fetched");
        }
    }
}
</script> 