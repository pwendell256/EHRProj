<template>
    <div class="p-4 bg-white shadow rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-xl font-semibold flex items-center">
                    <span class="mr-2">💊</span> Medication
                </h2>
                <p class="text-gray-500 text-sm">Track patient prescriptions.</p>
            </div>
        </div>

        <button @click="isAddModalOpen = true" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-3">
            Add Medication
        </button>

        <div class="border-t border-b border-gray-300 overflow-hidden rounded-lg">
            <table class="w-full text-left">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <th class="py-2 px-4">Date</th>
                        <th class="py-2 px-4">Medication</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b" v-for="record in patient.medications" :key="record.id">
                        <td class="py-2 px-4">{{ record.date }}</td>
                        <td class="py-2 px-4">{{ record.medication }}</td>
                        <td class="py-2 px-4 flex space-x-2">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">View</button>
                            <button @click="openEditModal(record)" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                            <button @click="deleteRecord(record.id)"class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Add Medication Modal -->
        <div v-if="isAddModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h3 class="text-lg font-semibold mb-4">Add Medication</h3>
                
                <label class="block text-sm font-medium">Date</label>
                <input type="date" v-model="form.date" class="w-full p-2 border rounded mb-3" />

                <label class="block text-sm font-medium">Medication</label>
                <input type="text" v-model="form.medication" class="w-full p-2 border rounded mb-3" />

                <div class="flex justify-end space-x-2">
                    <button @click="closeAddModal" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Cancel
                    </button>
                    <button @click="saveMedication" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Save
                    </button>
                </div>
            </div>
        </div>

        <!-- Edit Medication Modal -->
        <div v-if="isEditModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h3 class="text-lg font-semibold mb-4">Edit Medication</h3>
                
                <label class="block text-sm font-medium">Date</label>
                <input type="date" v-model="editForm.date" class="w-full p-2 border rounded mb-3" />

                <label class="block text-sm font-medium">Medication</label>
                <input type="text" v-model="editForm.medication" class="w-full p-2 border rounded mb-3" />

                <div class="flex justify-end space-x-2">
                    <button @click="closeEditModal" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Cancel
                    </button>
                    <button @click="updateMedication" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Update
                    </button>
                </div>
            </div>
        </div>

        <!-- Error Modal -->
        <div v-if="errorMessage" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h3 class="text-lg font-semibold mb-4 text-red-600">Error</h3>
                <p class="text-gray-700">{{ errorMessage }}</p>
                <div class="flex justify-end mt-4">
                    <button @click="errorMessage = ''" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    patient: Object
});

const isAddModalOpen = ref(false);
const isEditModalOpen = ref(false);
const errorMessage = ref('');

const form = useForm({
    date: '',
    medication: '',
});

const editForm = useForm({
    id: '',
    date: '',
    medication: '',
});

const closeAddModal = () => {
    isAddModalOpen.value = false;
};

const closeEditModal = () => {
    isEditModalOpen.value = false;
};

const saveMedication = () => {
    form.post(route('medication.store', props.patient.id), {
        onError: (errors) => {
            if (errors.medication) {
                errorMessage.value = errors.medication;
            }
        },
        onSuccess: () => {
            closeAddModal();
            errorMessage.value = '';
        }
    });
};

const openEditModal = (record) => {
    editForm.id = record.id;
    editForm.date = record.date;
    editForm.medication = record.medication;
    isEditModalOpen.value = true;
};

const updateMedication = () => {
    editForm.put(route('medication.update', editForm.id), {
        onError: (errors) => {
            if (errors.medication) {
                errorMessage.value = errors.medication;
            }
        },
        onSuccess: () => {
            closeEditModal();
            errorMessage.value = '';
        }
    });
};
const deleteform = useForm({})
const deleteRecord = (id) =>{
    if(confirm('Are you sure you want to delete this record?')){
        deleteform.delete(route('medication.destroy', id))
    }
}
</script>
