<template>
    <li>
        <input type="radio" 
            :id="model.id+'-'+model.parent_id"
            name="selectedCategory"
            class="tree-radio"
            @change="select()">
        <label :for="model.id+'-'+model.parent_id" @click="toggle">
            <span v-if="isFolder"
                class="far"
                :class="open ? 'fa-folder-open' : 'fa-folder'">
            </span>
            <span v-if="model.id==-1"><i class="far fa-plus-square"></i></span>
            <span v-else>{{model.name}}</span>
        </label>
        <ul class="tree" v-show="open">
        <categories-tree
            v-for="(child, index) in model.children"
            :key="index"
            :model="child"
            v-on:selectionChange="this.$emit('selectionChange', args);"> 
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
        }
    },
    data() {
        return {
            open: false,
        }
    },
    computed: {
        isFolder: function () {
            return this.model.children &&
            this.model.children.length
        }
    },
    methods: {
        toggle: function () {      
            this.open = !this.open;
        },
        select: function(event) {
            let args={
                id: this.model.id,
                parent_id: this.model.parent_id
            }
            
            bus.$emit("selectionChange", args);
        }
    }
}
</script> 