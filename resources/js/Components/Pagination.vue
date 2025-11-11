<script setup>
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        links: Array,
        align: String,
    })
</script>

<template>
    <nav>
        <ul :class="`pagination pagination-md justify-content-${align} mb-0 mt-4`">
            <li :class="[
                    'page-item',
                    link.url == null ? 'disabled' : '',
                    link.active ? 'active' : '',
                ]"
                v-for="(link, index) in links" :key="index">
                <Link
                    class="page-link"
                    :href="link.url === null ? '#' : link.url">
                    <span v-html="link.label"></span>
                </Link>
            </li>
        </ul>
    </nav>
</template>
