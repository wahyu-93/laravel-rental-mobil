<template>
    <Head>
        <title>Register - Bee Rental Mobil</title>
    </Head>
    
    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
        <div class="text-center text-md-center mb-4 mt-md-0">
            <h3>Register</h3>
        </div>
    </div>
</template>

<script>
    //import layout
    import LayoutAuth from '../../Layouts/Auth.vue';

    //import Inertia
    import {
        Head,
        router
    } from '@inertiajs/vue3';

    //import reactive
    import {
        reactive
    } from 'vue';

    export default {

        //layout
        layout: LayoutAuth,

        //register component
        components: {
            Head
        },

        //props
        props: {
            errors: Object,
        },

        //define composition API
        setup() {

            //define form state
            const form = reactive({
                email: '',
                password: '',
            });

            //submit method
            const submit = () => {

                //send data to server
                router.post('/login', {

                    //data
                    email: form.email,
                    password: form.password,
                });
            }

            //return form state and submit method
            return {
                form,
                submit,
            };

        }

    }

</script>
