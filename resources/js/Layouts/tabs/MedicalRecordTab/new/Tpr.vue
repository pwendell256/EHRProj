<template>
        <!-- Add Button -->
        <div class="flex justify-end mb-4">
            <button @click="showModal = true"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Add
            </button>
        </div>

        <!-- Table -->
        <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Temperature</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Blood Pressure</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Respiratory Rate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Pulse Rate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Oxygen Saturation</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template v-for="(tpr, index) in sortedTprs" :key="tpr.id">
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <!-- Only show date if it's the first record for that date -->
                            <template v-if="index === 0 || tpr.date !== sortedTprs[index-1].date">
                                {{ tpr.date }}
                            </template>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ tpr.time }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ tpr.temp }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ tpr.bp }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ tpr.rr }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ tpr.pr }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ tpr.os }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <button class="text-blue-600 hover:underline text-sm" @click="editTpr(tpr)">
                                Edit
                            </button>
                            <button class="mx-2 text-red-600 hover:underline text-sm" @click="deleteTpr(tpr.id)">
                                Delete
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h2 class="text-lg font-semibold mb-4">Add Vital Signs</h2>
                <form @submit.prevent="submit">
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm">Date</label>
                            <input type="date" v-model="form.date" class="w-full border rounded px-3 py-1.5" required />
                        </div>
                        <div>
                            <label class="block text-sm">Time</label>
                            <select v-model="form.time" class="w-full border rounded px-3 py-1.5" required>
                                <option value="">Select Time</option>
                                <option value="12:00 AM">12:00 AM</option>
                                <option value="4:00 AM">4:00 AM</option>
                                <option value="8:00 AM">8:00 AM</option>
                                <option value="12:00 PM">12:00 PM</option>
                                <option value="4:00 PM">4:00 PM</option>
                                <option value="8:00 PM">8:00 PM</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm">Temperature</label>
                            <input type="text" v-model="form.temp" class="w-full border rounded px-3 py-1.5" required />
                        </div>
                        <div>
                            <label class="block text-sm">Blood Pressure</label>
                            <input type="text" v-model="form.bp" class="w-full border rounded px-3 py-1.5" required />
                        </div>
                        <div>
                            <label class="block text-sm">Respiratory Rate</label>
                            <input type="text" v-model="form.rr" class="w-full border rounded px-3 py-1.5" required />
                        </div>
                        <div>
                            <label class="block text-sm">Pulse Rate</label>
                            <input type="text" v-model="form.pr" class="w-full border rounded px-3 py-1.5" required />
                        </div>
                        <div>
                            <label class="block text-sm">Oxygen Saturation</label>
                            <input type="text" v-model="form.os" class="w-full border rounded px-3 py-1.5" required />
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="showModal = false"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    patient: Object
})

const showModal = ref(false)
const modalMode = ref('create') // 'create' or 'edit'
const editingId = ref(null)

// Create a computed property to sort TPRs by date and then by time
const sortedTprs = computed(() => {
    if (!props.patient?.tprs) return []
    
    // Clone the array to avoid modifying the original data
    return [...props.patient.tprs].sort((a, b) => {
        // First sort by date
        const dateComparison = new Date(a.date) - new Date(b.date)
        
        // If dates are the same, sort by time
        if (dateComparison === 0) {
            // Convert times to comparable values (e.g., minutes since midnight)
            const timeToMinutes = (timeStr) => {
                const [time, period] = timeStr.split(' ')
                const [hours, minutes] = time.split(':').map(Number)
                
                // Convert to 24-hour format for comparison
                let totalMinutes = hours * 60 + minutes
                if (period === 'PM' && hours < 12) totalMinutes += 12 * 60
                if (period === 'AM' && hours === 12) totalMinutes = minutes // 12 AM is 0 hours
                
                return totalMinutes
            }
            
            return timeToMinutes(a.time) - timeToMinutes(b.time)
        }
        
        return dateComparison
    })
})

const form = useForm({
    patient_Id: props.patient.id,
    date: '',
    time: '',
    temp: '',
    bp: '',
    rr: '',
    pr: '',
    os: ''
})

const editTpr = (tpr) => {
  modalMode.value = 'edit'
  editingId.value = tpr.id
  showModal.value = true
  form.date = tpr.date
  form.time = tpr.time
  form.temp = tpr.temp
  form.bp = tpr.bp
  form.rr = tpr.rr
  form.pr = tpr.pr
  form.os = tpr.os
}

const submit = () => {
  if (modalMode.value === 'edit') {
    form.put(route('tprs.update', editingId.value), {
      preserveScroll: true,
      onSuccess: () => {
        showModal.value = false
        form.reset()
        modalMode.value = 'create'
        editingId.value = null
      }
    })
  } else {
    form.post(route('tprs.store', props.patient?.id), {
      preserveScroll: true,
      onSuccess: () => {
        showModal.value = false
        form.reset()
      }
    })
  }
}

const deleteform = useForm()
const deleteTpr = (id) => {
    if(confirm('Are you sure you want to delete this record?')){
        deleteform.delete(route('tprs.delete', id))
    }
}
</script>