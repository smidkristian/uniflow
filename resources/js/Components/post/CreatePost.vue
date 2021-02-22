<template>
    <div
        class="mx-auto w-full md:w-2/5 bg-white py-8 px-4 rounded-md mt-10 shadow-sm xyz-in"
        xyz="fade-100% up">
        <h1 class="uppercase pb-6 text-sm text-gray-500">Create a New Post</h1>
        <form @submit.prevent="storePost()" class="flex flex-col">
        <div class="flex flex-col">
            <label for="title">Title:</label>
            <input type="text" id="title" v-model="postForm.title" class="input max-w-sm">
            <span class="text-xs text-red-700 uppercase mt-2">{{ errors.title }}</span>
        </div>

        <div class="flex flex-col mt-4">
            <label for="description">Description:</label>
            <textarea rows="2" cols="30" id="description" v-model="postForm.description" class="input" />
            <span class="text-xs text-red-700 uppercase mt-2">{{ errors.description }}</span>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="btn">Save</button>
        </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: [
            'errors'
        ],
        emits: [
            'finished'
        ],

        data () {
            return {
                postForm: {
                    user: this.$page.props.user.username,
                    title: null,
                    description: null
                }
            }
        },

        methods: {

            storePost() {

                this.$inertia.post(route('store-post'), this.postForm, {
                    onSuccess: () => {
                        console.log('post made!!');
                        this.$emit('finished');
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },

            resetForm() {
                Object.keys(this.postForm).forEach( key => {
                    this.postForm[key] = null
                });
            },
        }
    }
</script>

<style scoped>

</style>
