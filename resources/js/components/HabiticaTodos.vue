<script setup>
defineProps({
  todos: {
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
    <h1 class="font-bold text-xl mb-2">Todo</h1>
    
    <div v-if="todos.length === 0" class="alert alert-info">
      <p>No todos found. Either you have no todos in Habitica, or there was an issue connecting to the API.</p>
    </div>
    
    <div v-else class="row">
      <div v-for="todo in todos" :key="todo.id" class="col-md-6 mb-3">
        <div class="flex justify-between">
            <div>
                <h3 class="card-title">{{ todo.text }}</h3>
                <p v-if="todo.notes" class="card-text">{{ todo.notes }}</p>
            </div>
            <div class="flex border-1 rounded-2xl border-gray-400 text-gray-400 justify-content-between align-items-center px-2 py-1 text-xs">
                <span :class="['badge', todo.completed ? 'bg-success' : 'bg-warning']">
                    {{ todo.completed ? 'Completed' : 'Pending' }}
                </span>
            </div>
        </div>
        <small v-if="todo.date" class="text-small">
            Due: {{ formatDate(todo.date) }}
        </small>
      </div>
    </div>
  </div>
</template>