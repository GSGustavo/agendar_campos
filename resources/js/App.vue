<script>
import { Link } from '@inertiajs/vue3'
import FloatBar from './Components/FloatBar.vue';

export default {
    props: {
        'floatbarmode': String
    },
    setup(props) {
        return {props}
    },
    components: {FloatBar}
}
</script>

<template>
    <div class="py-[20px]">
        <slot />
    </div>
    
    <FloatBar :floatbarmode="floatbarmode "></FloatBar>
    
</template>