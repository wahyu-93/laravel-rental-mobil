<script setup>
    import LayoutAdmin from '../../../Layouts/Admin.vue';
    import Pagination from '../../../Components/Pagination.vue';
    import { Link, Head } from '@inertiajs/vue3';


    defineOptions({
        layout: LayoutAdmin
    })

    const props = defineProps({
        categories: Object
    })
</script>

<template>
    <Head>
        <title>Categories - Bee Rental Mobil</title>
    </Head>

    <div class="container-fluid mb-5 mt-5">
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>List Of Categories</h5>
                                    <Link class="btn btn-primary" href="/admin/categories/create">
                                        <i class="fa fa-plus-circle"></i>
                                        Add Category
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-dark">
                                    <tr class="border-0">
                                        <th>No</th>
                                        <th>Category Name</th>
                                        <th>Slug</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(category, index) in categories.data" :key="category.id">
                                        <td class="fw-bold text-center">{{ index + 1 + (categories.current_page - 1) * categories.per_page }}</td>
                                        <td>{{ category.name }}</td>
                                        <td>{{ category.slug }}</td>
                                    </tr> 

                                    <tr v-if="categories.data.length === 0">
                                        <td colspan="3" class="text-center">No Categories Found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- pagination -->
                        <div v-if="categories.data.length !== 0">
                            <Pagination :links="categories.links" align="end" />
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</template>