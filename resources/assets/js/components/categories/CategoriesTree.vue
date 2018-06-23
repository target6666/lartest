<template>
    <li>
        <div @click="toggle">
        {{ model.name }}
        <span v-if="isFolder">[{{ open ? '-' : '+' }}]</span>
        </div>
        <ul class="tree" v-show="open">
        <categories-tree
            v-for="(child, index) in model.children"
            :key="index"
            :model="child">
        </categories-tree>
        </ul>
    </li>
</template>

<script>

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
        }
    }
}
</script> 