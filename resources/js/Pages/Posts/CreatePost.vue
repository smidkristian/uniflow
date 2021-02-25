<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800">
                    Posts
                </h2>
                <inertia-link :href="route('posts')" class="btn-header">
                    Back
                </inertia-link>
            </div>
        </template>
        <div class="mx-auto w-full md:w-2/5 bg-white py-8 px-4 rounded-md mt-10 shadow-sm xyz-in"
            xyz="fade-100% up">
            <h1 class="uppercase pb-6 text-sm text-gray-500">Create a New Post</h1>
            <form @submit.prevent="store()" class="flex flex-col">
                <div class="flex flex-col">
                    <label for="title">Title:</label>
                    <input type="text" id="title" v-model="form.title" class="input max-w-sm">
                    <span class="text-xs text-red-700 uppercase mt-2">{{ errors.title }}</span>
                </div>

                <div class="flex flex-col mt-4">
                    <label for="description">Description:</label>
                    <textarea rows="2" cols="30" id="description" v-model="form.description" class="input" />
                    <span class="text-xs text-red-700 uppercase mt-2">{{ errors.description }}</span>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn">Save</button>
                </div>
            </form>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout.vue';

    export default {
        props: [
            'errors'
        ],
        components: {
            AppLayout
        },

        data () {
            return {
                form: {
                    user: this.$page.props.user.username,
                    title: null,
                    description: null
                }
            }
        },

        methods: {

            store() {

                this.$inertia.post(route('store-post'), this.form, {
                    onSuccess: () => {
                        console.log('post made!!');
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },

            resetForm() {
                Object.keys(this.form).forEach( key => {
                    this.form[key] = null
                });
            },
        }
    }
</script>

<style scoped>

</style>
