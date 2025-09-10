<script setup lang="ts">
const props = defineProps({
    weight: {
        type: Array,
        default: () => []
    }
});
</script>

<template>
    <div class="p-4 h-full">
        <h3 class="text-lg font-semibold mb-4">Weight Overview</h3>
        <div v-if="props.weight.length === 0" class="text-gray-500">
            No weight data available
        </div>
        <div v-else class="space-y-2">
            <div class="text-sm text-gray-600">
                Total entries: {{ props.weight.length }}
            </div>
            <div v-if="props.weight[0]" class="text-lg">
                Latest: {{ props.weight[0].weight_lbs }} lbs
                <div class="text-sm text-gray-500">
                    {{ new Date(props.weight[0].recorded_at).toLocaleDateString() }}
                </div>
            </div>
        </div>
    </div>
</template>