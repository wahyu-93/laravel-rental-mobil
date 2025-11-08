<script setup>
    import { onMounted, toRaw } from 'vue';
    import LayoutAuth from '../../Layouts/Auth.vue';
    import { Head, router, useForm } from '@inertiajs/vue3';

    defineOptions({
        layout: LayoutAuth
    })

    const props = defineProps({
        email: '',
        token: '',
        errors: Object
    })

    const form = useForm({
        email: props.email,
        password: '',
        password_confirmation: '',
        token: props.token,
    })

    onMounted(() => {
        console.log(toRaw(form))
    })

    function submit()
    {
        router.post('/reset-password', form);
    }
</script>

<template>
    <Head>
        <title>Reset Pasword - Bee Rental Mobil</title>
    </Head>

    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
        <div class="text-center text-md-center mt-4 mt-md-0">
            <h3>Reset Password</h3>
        </div>

        <form class="mt-4" @submit.prevent="submit">
            <div class="form-group mb-4">
                <label for="email">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input type="email" class="form-control" v-model="form.email" placeholder="Email Address">
                </div>
                <div v-if="errors.email" class="alert alert-danger mt-2">
                    {{ errors.email }}
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="email">New Password</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-lock"></i>
                    </span>
                    <input type="password" class="form-control" v-model="form.password_confirmation" placeholder="Enter New Password">
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="email">Confirm New Password</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-lock"></i>
                    </span>
                    <input type="password" class="form-control" v-model="form.password" placeholder="Confirm New Password">
                </div>
                <div v-if="errors.password" class="alert alert-danger mt-2">
                    {{ errors.password }}
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-gray-800">Reset Password</button>
            </div>

        </form>
        
        
        
        
        
        
    </div>
    
</template>