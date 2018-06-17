<template>
    <div>

        <!-- Filter -->
        <form class="form-inline my-2">
        <input class="form-control" type="text" placeholder="Add Filter" v-model="search" v-on:keyup.space="addFilter($event)" v-on:keydown.esc="deleteAllFilters($event)">

        <button v-for="(filter, index) in filters" v-bind:key="index" class="btn btn-default btn-sm ml-2" @click="deleteFilter(index, $event)">
            {{filter}}
        </button>
        
        <button v-if="filters.length > 0" class="btn btn-danger btn-sm ml-2" @click="deleteAllFilters($event)">
        x
        </button>
        
        </form>

        <!-- Tabelle -->
        <table class='table table-hover table-sm' >
            <thead>
                <tr>
                    <!-- keycode sortup &#9650-->
                    <!-- keycode sortdown &#9660-->
                    <th><a href="" class="text-dark" @click="sort('name',$event)">Bezeichnung</a><span v-if="sortBy==='name'">&#9660;</span></th>
                    <th><a href="" class="text-dark" @click="sort('category_id',$event)">Warengruppe</a><span v-if="sortBy==='category_id'">&#9660;</span></th>
                    <th><a href="" class="text-dark" @click="sort('artno',$event)">ArtNo.</a><span v-if="sortBy==='artno'">&#9660;</span></th>
                    <th><span class="text-dark">Bestand</span></th>
                    <th><span class="text-dark"></span></th>
                </tr>
            </thead>
            <tbody id="sortiment">
                <tr v-for="article in articles" v-bind:key="article.id">
                    <td>{{article.name}}</td>
                    <td>
                        {{getCategoryPath(article)}}
                    </td>
                    <td>{{article.artno}}</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <!--Pagination-->
        <div>
            <a href="#" 
                class="btn btn-primary" 
                v-bind:class="{'btn btn-secondary disabled': !pagination.prev_page_url}" 
                @click="prev($event)">
                prev
            </a>
            <span>Seite {{pagination.current_page}} / {{pagination.last_page}} </span>
            <a href="#" 
                class="btn btn-primary" 
                v-bind:class="{'btn btn-secondary disabled': !pagination.next_page_url}" 
                @click="next($event)">
                next
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'articles-list',
    data() {
        return {
            articles: [],
            pagination: {},
            page: 1,
            limit: 20,
            search: '',
            filters: [],
            sortBy: 'name'
        }
    },
    created() {
        this.fetchArticles();
    },
    methods:{
        
        fetchArticles(page_url) {
            fetch(this.url)
                .then(res=> res.json())
                .then(res => {
                    this.articles=res.data;
                    this.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            console.log("articles fetched");
        },

        makePagination(meta, links){
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }
            this.pagination=pagination;
        },

        addFilter(e){
            e.preventDefault();
            //remove whitespace at the end
            this.search=this.search.trim();
            if(this.search!=''){
                this.filters.push(this.search);
                this.fetchArticles();
            }
            this.search="";
            
        },

        deleteFilter(index,e){
            e.preventDefault();
            this.filters.splice(index,1);
            console.log("filter deleted");
            this.fetchArticles();
        },

        deleteAllFilters(e){
            e.preventDefault();
            this.filters=[];
            console.log("all filters deleted");
            this.fetchArticles();
        },
        
        sort(s,e){
            e.preventDefault();
            this.sortBy=s;
            this.fetchArticles();
        },

        next(e){
            e.preventDefault();
            this.page=this.page+1;
            this.fetchArticles();
        },

        prev(e){
            e.preventDefault();
            this.page--;
            this.fetchArticles();
        },

        getCategoryPath(article){
            let cat=article.category;
            let path='';
            while(cat){
                path = cat.name + ' / ' + path;
                cat=cat.parent;
            }
            return path;
        }

    },
    computed: {
        url: function(){
            let queryUrl = "/api/articles?"+"sort="+this.sortBy+"&limit="+this.limit+"&page="+this.page;
            if (this.filters.length>0){
                for(let i=0; this.filters[i]; i++){
                    queryUrl=queryUrl + "&filter"+i+"="+this.filters[i];
                }
            }
            return encodeURI(queryUrl);
        }
    }
}
</script> 