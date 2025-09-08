<template>
  <div class="container py-4">
    <h1>My Habitica Todos</h1>
    
    <div v-if="todos.length === 0" class="alert alert-info">
      <p>No todos found. Either you have no todos in Habitica, or there was an issue connecting to the API.</p>
    </div>
    
    <div v-else class="row">
      <div v-for="todo in todos" :key="todo.id" class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ todo.text }}</h5>
            
            <p v-if="todo.notes" class="card-text">{{ todo.notes }}</p>
            
            <div class="d-flex justify-content-between align-items-center">
              <span :class="['badge', todo.completed ? 'bg-success' : 'bg-warning']">
                {{ todo.completed ? 'Completed' : 'Pending' }}
              </span>
              
              <small v-if="todo.date" class="text-muted">
                Due: {{ formatDate(todo.date) }}
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

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