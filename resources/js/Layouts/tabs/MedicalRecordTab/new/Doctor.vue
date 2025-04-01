<template>
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">This is the Doctor's Order</h2>
        <!-- Button to open modal -->
        <div class="text-right mb-4">
            <button @click="openAddModal"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">
                Add order
            </button>
        </div>
        <!-- Table -->
        <table class="min-w-full table-auto border-collapse mb-4">
            <thead>
                <tr>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-left">Day Number</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-left">Date and Time</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-left">Orders</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-left">Rationale</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-left">Signature</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in patient?.doctororders" :key="data.id">
                    <td class="px-4 py-2 border border-gray-300">{{ data.day_number }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ data.date_time }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ data.order }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ data.rationale }}</td>
                    <td class="px-4 py-2 border border-gray-300">
                        <button @click="openSignatureModal(data.signature)" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-eye"></i> View
                        </button>
                    </td>
                    <td class="px-4 py-2 border border-gray-300">
                        <button @click="openEditModal(data)" class="text-green-500 hover:text-green-700 mr-2">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal to view signature image -->
        <div v-if="isSignatureModalOpen" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg w-96">
                <h3 class="text-lg font-semibold mb-4">Signature Image</h3>
                <div class="flex justify-center mb-4">
                    <img :src="`/storage/` + signatureImage" alt="Signature" class="w-full h-auto" />
                </div>
                <div class="text-right">
                    <button @click="closeSignatureModal" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Close
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal for Adding Doctor's Order -->
        <div v-if="isAddModalOpen" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg w-96">
                <h3 class="text-lg font-semibold mb-4">Add Doctor's Order</h3>
                <!-- Add Form Content -->
                <form @submit.prevent="submitAddForm" class="space-y-4">
                    <div>
                        <label class="font-semibold">Day Number:</label>
                        <input v-model="addForm.day_number" type="text"
                            class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Enter day number" />
                    </div>
                    <div>
                        <label class="font-semibold">Date and Time:</label>
                        <input v-model="addForm.date_time" type="datetime-local"
                            class="w-full px-4 py-2 border border-gray-300 rounded" />
                    </div>
                    <div>
                        <label class="font-semibold">Orders:</label>
                        <textarea v-model="addForm.orders" class="w-full px-4 py-2 border border-gray-300 rounded"
                            placeholder="Enter orders"></textarea>
                    </div>
                    <div>
                        <label class="font-semibold">Rationale:</label>
                        <textarea v-model="addForm.rationale" class="w-full px-4 py-2 border border-gray-300 rounded"
                            placeholder="Enter rationale"></textarea>
                    </div>
                    <div>
                        <label class="font-semibold">Signature:</label>
                        <input type="file" @change="handleAddFileChange" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded" />
                    </div>

                    <div class="mt-4 text-right">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">
                            Submit
                        </button>
                        <button @click="closeAddModal"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none ml-2">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal for Editing Doctor's Order -->
        <div v-if="isEditModalOpen" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg w-96">
                <h3 class="text-lg font-semibold mb-4">Edit Doctor's Order</h3>
                <!-- Edit Form Content -->
                <form @submit.prevent="submitEditForm" class="space-y-4">
                    <div>
                        <label class="font-semibold">Day Number:</label>
                        <input v-model="editForm.day_number" type="text"
                            class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Enter day number" />
                    </div>
                    <div>
                        <label class="font-semibold">Date and Time:</label>
                        <input v-model="editForm.date_time" type="datetime-local"
                            class="w-full px-4 py-2 border border-gray-300 rounded" />
                    </div>
                    <div>
                        <label class="font-semibold">Orders:</label>
                        <textarea v-model="editForm.orders" class="w-full px-4 py-2 border border-gray-300 rounded"
                            placeholder="Enter orders"></textarea>
                    </div>
                    <div>
                        <label class="font-semibold">Rationale:</label>
                        <textarea v-model="editForm.rationale" class="w-full px-4 py-2 border border-gray-300 rounded"
                            placeholder="Enter rationale"></textarea>
                    </div>
                    <div>
                        <label class="font-semibold">Signature:</label>
                        <div v-if="currentSignature" class="mb-2">
                            <img :src="`/storage/` + currentSignature" alt="Current Signature" class="w-32 h-auto" />
                            <p class="text-sm text-gray-500">Current signature</p>
                        </div>
                        <input type="file" @change="handleEditFileChange" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded" />
                        <p class="text-sm text-gray-500">Leave empty to keep current signature</p>
                    </div>

                    <div class="mt-4 text-right">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">
                            Update
                        </button>
                        <button @click="closeEditModal"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none ml-2">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    patient: Object,
});

// Modal state variables
const isAddModalOpen = ref(false);
const isEditModalOpen = ref(false);
const isSignatureModalOpen = ref(false);
const signatureImage = ref('');
const currentSignature = ref('');
const currentOrderId = ref(null);

// Form for adding new orders
const addForm = useForm({
    day_number: '',
    date_time: '',
    orders: '',
    rationale: '',
    signature: null,
});

// Form for editing existing orders
const editForm = useForm({
    day_number: '',
    date_time: '',
    orders: '',
    rationale: '',
    signature: null,
    _method: 'PUT'
});

// Modal functions for adding orders
const openAddModal = () => {
    // Reset form
    addForm.reset();
    isAddModalOpen.value = true;
};

const closeAddModal = () => {
    isAddModalOpen.value = false;
};

// Modal functions for editing orders
const openEditModal = (order) => {
    // Set current order ID
    currentOrderId.value = order.id;
    
    // Populate form with existing data
    editForm.day_number = order.day_number;
    editForm.date_time = order.date_time;
    editForm.orders = order.order;
    editForm.rationale = order.rationale;
    
    // Track current signature image
    currentSignature.value = order.signature;
    
    // Open modal
    isEditModalOpen.value = true;
};

const closeEditModal = () => {
    isEditModalOpen.value = false;
};

// Modal functions for viewing signature
const openSignatureModal = (signature) => {
    signatureImage.value = signature;
    isSignatureModalOpen.value = true;
};

const closeSignatureModal = () => {
    isSignatureModalOpen.value = false;
};

// File handling functions
const handleAddFileChange = (event) => {
    addForm.signature = event.target.files[0];
};

const handleEditFileChange = (event) => {
    editForm.signature = event.target.files[0];
};

// Form submission functions
const submitAddForm = () => {
    addForm.post(route('doctor.store', props.patient.id), {
        onSuccess: () => {
            closeAddModal();
        },
        onError: (errors) => {
            console.log(errors); // Handle validation errors
        },
    });
};

const submitEditForm = () => {
    // Submit to the update route with the order ID
    editForm.post(route('doctor.update', [props.patient.id, currentOrderId.value]), {
        onSuccess: () => {
            closeEditModal();
        },
        onError: (errors) => {
            console.log(errors); // Handle validation errors
        },
    });
};
</script>

<style scoped>
/* Optional: You can add custom styles here */
</style>