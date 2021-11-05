<template>
<div>
    <modal name="my-first-modal">
            <img class="shadow-md w-8 h-8" :src="src" alt="collaborator 1" />
    </modal>

                            <div class="flex items-center">
                                    <img class="shadow-md w-8 h-8 rounded-full" v-for="(x, index) in creatives" v-bind:key="index" @click="show(path+'/'+x.creative_file)" :src="path+'/'+x.creative_file" alt="collaborator 1" />

                            </div>
</div>
</template>

<script>
export default {
        props: ['path','creatives'],
    methods: {
        show (url) {
            this.$modal.show({
            template: `
                <div>
                <img class="shadow-md object-contain h-auto w-full" src="`+url+`" />
                </div>
            `
            })
        },
        hide () {
            this.$modal.hide('my-first-modal');
        }
    },
}
</script>
