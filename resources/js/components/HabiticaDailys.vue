<script setup>
defineProps({
  dailys: {
    type: Array,
    default: () => []
  }
})

const formatDate = (date) => {
  return new Date(date).toLocaleDateString()
}
</script>

<template>
  <div class="container p-4">
    <h1 class="font-bold text-xl mb-2">Daily Tasks</h1>
    
    <div v-if="dailys.length === 0" class="alert alert-info">
      <p>No daily tasks found. Either you have no daily tasks in Habitica, or there was an issue connecting to the API.</p>
    </div>
    
    <div v-else class="row">
      <div v-for="daily in dailys" :key="daily.id" class="col-md-6 mb-3">
        <div class="flex justify-between">
            <div>
                <h3 class="card-title">{{ daily.text }}</h3>
                <p v-if="daily.notes" class="card-text">{{ daily.notes }}</p>
            </div>
            <div class="flex border-1 rounded-2xl border-gray-400 text-gray-400 justify-content-between align-items-center px-2 py-1 text-xs">
                <span :class="['badge', daily.completed ? 'bg-success' : 'bg-warning']">
                    {{ daily.completed ? 'Completed' : 'Pending' }}
                </span>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>