<script setup>
    import { ref } from 'vue';
    import LayoutAdmin from '../../../Layouts/Admin.vue';
    import { Head, router, Link } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    
    defineOptions({
        layout: LayoutAdmin
    })

    // disini nilainya berasal dari kiriman controller
    const props = defineProps({
        category: Object,
        errors: Object
    })

    const form = ref({
        name: props.category.name
    })

    function submitForm()
    {
        router.put(`/admin/categories/${props.category.slug}`, form.value, {
            onSuccess: () => {
                Swal.fire('Success!', 'Category Berhasil Diperbarui', 'success').then(() => {
                    window.location.href = '/admin/categories';
                })
            }
        })
    }
</script>

<template>
    <Head>
        <title>Edit Category - Bee Rental Mobil</title>
    </Head>

    <div class="container-fluid mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <form @submit.prevent="submitForm">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" v-model="form.name" required>
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    {{ errors.name }}
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <Link class="btn btn-info me-2" href="/admin/categories">Batal</Link>
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>