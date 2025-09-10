<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import HabiticaTodos from '@/components/HabiticaTodos.vue';
import HabiticaDailys from '@/components/HabiticaDailys.vue';
import WeightOverview from '@/components/WeightOverview.vue';

const props = defineProps({
    todos: {
        type: Array,
        default: () => []
    },
    dailys: {
        type: Array,
        default: () => []
    },
    weight: {
        type: Array,
        default: () => []
    }
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="relative p-4 overflow-auto rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <HabiticaTodos :todos="props.todos" />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <HabiticaDailys :dailys="props.dailys" />
                </div>
            </div>
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <WeightOverview :weight="props.weight" />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
