<script setup>
    import { reactive, ref, toRaw } from 'vue';
    import LayoutAdmin from '../../../Layouts/Admin.vue';
    import { Head, router } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    
    defineOptions({
        layout: LayoutAdmin
    })

    const form = ref({
        name: ''
    })
    
    const props = defineProps({
        errors: Object
    })

    function submitForm()
    {
        router.post('/admin/categories', form.value, {
            onSuccess: () => {
                Swal.fire('Success!', 'Category Berhasil Ditambahkan', 'success').then(() => {
                    window.location.href = '/admin/categories';
                })
            }
        })
    }
</script>

<template>
    <Head>
        <title>Create Category - Bee Rental Mobil</title>
    </Head>

    <div class="container-fluid mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <form @submit.prevent="submitForm">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" v-model="form.name">
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    {{ errors.name }}
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>