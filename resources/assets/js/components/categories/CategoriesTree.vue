<template>
    <li>
        <input type="radio" 
            :id="model.id+'-'+model.parent_id"
            name="selectedCategory"
            class="tree-radio"
            @change="select()">
        <label :for="model.id+'-'+model.parent_id" @click="toggleOpened">
            <span v-if="isFolder" class="far" :class="isOpen ? 'fa-folder-open' : 'fa-folder'">
            </span>
            <span v-if="model.id<0"><i class="far fa-plus-square"></i></span>
            <span v-else>{{model.name}}</span>
        </label>
        <ul class="tree" v-show="isOpen">
        <categories-tree
            v-for="(child, index) in model.children"
            :key="index"
            :model="child"
            :opened="opened"> 
        </categories-tree>
        </ul>
    </li>
</template>

<script>
import {bus} from '../../app';
export default {
    name: 'categories-tree',
    props: {
        model:  {
            type: Object
        },
        opened: {
            type: Array,
            default: function(){ return []}
        }
    },

    computed: {
        isFolder: function () {
            return this.model.children &&
            this.model.children.length
        },

        isOpen: function () {
            var i = this.opened.indexOf(this.model.id)
            if (i==-1)
                return false;
            else
                return true;

        }
    },
    methods: {
        toggleOpened: function (event) {
            if (this.model.id>0){
                var i = this.opened.indexOf(this.model.id)
                if (i==-1){
                    this.opened.push(this.model.id);
                }
                else{
                    this.opened.splice(i,1);
                }
            }
        },
        select: function(event) {
            bus.$emit("selectionChange", this.model.id);
        }
    }
}
</script> 