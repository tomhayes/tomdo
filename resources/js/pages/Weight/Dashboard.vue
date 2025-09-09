<template>
  <div class="container py-4">
    <h1 class="mb-4">Weight Tracking Dashboard</h1>
    
    <!-- Stats Cards -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Current Weight</h5>
            <h2 class="text-primary">
              {{ stats.current_weight ? stats.current_weight + ' lbs' : 'No data' }}
            </h2>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Total Entries</h5>
            <h2 class="text-info">{{ stats.total_entries }}</h2>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Tracking Since</h5>
            <h2 class="text-success">
              {{ stats.date_range.earliest || 'No data' }}
            </h2>
          </div>
        </div>
      </div>
    </div>

    <!-- Weight Entries Table -->
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Recent Weight Entries</h5>
      </div>
      <div class="card-body">
        <div v-if="weightEntries.length === 0" class="text-center py-4">
          <p class="text-muted">No weight entries yet. Start tracking by sending data from your iOS device!</p>
          <div class="mt-3">
            <strong>API Endpoint:</strong> <code>POST /api/weight</code><br>
            <strong>Required fields:</strong> <code>weight_lbs</code>, <code>recorded_at</code>
          </div>
        </div>
        
        <div v-else class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Date</th>
                <th>Weight</th>
                <th>Change</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(entry, index) in weightEntries" :key="entry.id">
                <td>{{ formatDate(entry.recorded_at) }}</td>
                <td>
                  <strong>{{ entry.weight_lbs }} lbs</strong>
                  <small class="text-muted d-block">{{ convertToKg(entry.weight_lbs) }} kg</small>
                </td>
                <td>
                  <span v-if="index < weightEntries.length - 1" 
                        :class="getChangeClass(entry.weight_lbs, weightEntries[index + 1].weight_lbs)">
                    {{ getChangeText(entry.weight_lbs, weightEntries[index + 1].weight_lbs) }}
                  </span>
                  <span v-else class="text-muted">-</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  weightEntries: {
    type: Array,
    default: () => []
  },
  stats: {
    type: Object,
    default: () => ({})
  }
})

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

const convertToKg = (lbs) => {
  return (lbs / 2.20462).toFixed(1)
}

const getChangeText = (current, previous) => {
  const change = current - previous
  const abs = Math.abs(change)
  if (change > 0) {
    return `+${abs.toFixed(1)} lbs`
  } else if (change < 0) {
    return `-${abs.toFixed(1)} lbs`
  }
  return 'No change'
}

const getChangeClass = (current, previous) => {
  const change = current - previous
  if (change > 0) {
    return 'text-danger' // Weight gain in red
  } else if (change < 0) {
    return 'text-success' // Weight loss in green  
  }
  return 'text-muted'
}
</script>