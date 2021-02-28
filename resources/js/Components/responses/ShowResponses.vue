<template>
    <div class="flex flex-col-reverse">
        <div v-for="response in responses" :key="response.id" class="flex flex-col mt-2 py-4 px-4 rounded-md bg-gray-200 shadow-inner">
            <div class="pb-4">
                <h1 class="text-blue-600">
                    {{ response.user }}
                </h1>
                <div class="ml-2 mt-2">
                    {{ response.response }}
                </div>
            </div>
            <div class="flex justify-end w-full">
                <div v-if="commenting == response.id" class="flex flex-col w-full py-2">
                    <textarea class="input" />
                    <div class="flex justify-end mt-2">
                        <button @click="commenting = null" class="btn">Cancel</button>
                        <button class="btn ml-2">Save</button>
                    </div>
                </div>
                <div v-else>
                    <button @click="commenting = response.id"
                        class="rounded-md border-2 border-gray-400 px-2 uppercase text-xs text-gray-800 py-1 mr-4 hover:bg-white">
                        Add comment
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'responses'
        ],

        data() {
            return {
                commenting: false,
            }
        }
    }
</script>

<style scoped>

</style>
