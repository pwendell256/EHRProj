<template>
    <div class="overflow-x-auto p-4">
        <button @click="openModal()" class="mb-4 px-4 py-2 bg-green-600 text-white rounded">Add Note</button>

        <table class="w-full border border-gray-300">
            <thead>
                <tr class="bg-green-700 text-white">
                    <th class="border border-gray-300 px-4 py-2">DATE</th>
                    <th class="border border-gray-300 px-4 py-2">HOUR</th>
                    <th class="border border-gray-300 px-4 py-2">OBSERVATIONS</th>
                    <th class="border border-gray-300 px-4 py-2">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-green-200 font-semibold" v-for="(data, index) in sortedNotes" :key="data.id">
                    <td class="border border-gray-300 px-4 py-2"
                        v-if="index === 0 || data.date !== sortedNotes[index - 1].date">{{ data.date }}</td>
                    <td class="border border-gray-300 px-4 py-2" v-else></td>
                    <td class="border border-gray-300 px-4 py-2">{{ data.time }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <ul class="list-disc ml-4" v-html="data.observation.replace(/\n/g, '<br>')"></ul>
                    </td>

                    <td class="border border-gray-300 px-4 py-2">
                        <button @click="openModal(data)" class="px-2 py-1 mx-4 bg-blue-500 text-white rounded">Edit</button>
                        <button @click="deleteData(data.id)" class="px-2 py-1 bg-red-500 text-white rounded">delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-1/3">
                <h2 class="text-lg font-bold mb-4">{{ isEditing ? 'Edit' : 'Add' }} Nursing Note</h2>
                <form @submit.prevent="isEditing ? updateNote() : addNote()">
                    <div class="mb-4">
                        <label class="block text-gray-700">Date</label>
                        <input type="date" v-model="form.date" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Time</label>
                        <input type="time" v-model="form.time" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Observation</label>
                        <textarea v-model="form.observation" class="w-full border px-3 py-2 rounded" rows="3"
                            required></textarea>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="showModal = false"
                            class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">{{ isEditing ? 'Update'
                            : 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    patient: Object
});

const showModal = ref(false);
const isEditing = ref(false);
const editingId = ref(null);

const form = useForm({
    date: '',
    time: '',
    observation: ''
});

const sortedNotes = computed(() => {
    return [...props.patient.nursenotes].sort((a, b) => a.time.localeCompare(b.time));
});

const openModal = (data = null) => {
    if (data) {
        isEditing.value = true;
        editingId.value = data.id;
        form.date = data.date;
        form.time = data.time;
        form.observation = data.observation;
    } else {
        isEditing.value = false;
        editingId.value = null;
        form.reset();
    }
    showModal.value = true;
};

const addNote = () => {
    form.post(route('nurse.store', props.patient.id), {
        onSuccess: () => {
            showModal.value = false;
            form.reset();
        }
    });
};

const updateNote = () => {
    form.put(route('nurse.update', editingId.value), {
        onSuccess: () => {
            showModal.value = false;
            form.reset();
        }
    });
};

const deleteform = useForm([])
const deleteData = (id) => {
    if(confirm('Are you sure you want to delete this note?')){
        deleteform.delete(route('nurse.destroy', id))
    }
}
</script>
