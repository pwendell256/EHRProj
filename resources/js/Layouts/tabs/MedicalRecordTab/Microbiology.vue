<template>
    <div class="bg-gray-100 p-4 rounded-lg">
      <h3 class="text-lg font-semibold mb-2">Microbiology Records</h3>
      <button @click="openModal" class="mb-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
        Add Data
      </button>
  
      <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-800 text-white">
              <th class="p-2 border border-gray-300">Test Type</th>
              <th class="p-2 border border-gray-300">Test Date & Time</th>
              <th class="p-2 border border-gray-300">Result</th>
              <th class="p-2 border border-gray-300">Image</th>
              <th class="p-2 border border-gray-300">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border border-gray-300" v-for="record in patient.microbiologies" :key="record.id">
              <td class="p-2 border border-gray-300">{{ record.testType }}</td>
              <td class="p-2 border border-gray-300">{{ record.dateTime }}</td>
              <td class="p-2 border border-gray-300">{{ record.result }}</td>
              <td class="p-2 border border-gray-300 text-center">
                <button v-if="record.path" @click="openImageModal(record.path)"
                  class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                  👁️ View
                </button>
                <span v-else>No Image</span>
              </td>
              <td class="p-2 border border-gray-300 space-x-2">
                <button @click="openEditModal(record)"
                  class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                <button @click="deleteRecord(record.id)"
                  class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Add/Edit Modal -->
      <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
          <h3 class="text-lg font-semibold mb-4">{{ isEditing ? 'Edit' : 'Add' }} Microbiology Record</h3>
          <form @submit.prevent="isEditing ? updateRecord() : addRecord()">
          <div class="mb-2">
            <label class="block text-sm font-medium">Test Type</label>
            <input v-model="form.testType" class="w-full p-2 border rounded" required />
            <p v-if="form.errors.testType" class="text-red-500 text-sm">{{ form.errors.testType }}</p>
          </div>

          <div class="mb-2">
            <label class="block text-sm font-medium">Test Date & Time</label>
            <input type="datetime-local" v-model="form.dateTime" class="w-full p-2 border rounded" required />
            <p v-if="form.errors.dateTime" class="text-red-500 text-sm">{{ form.errors.dateTime }}</p>
          </div>

          <div class="mb-2">
            <label class="block text-sm font-medium">Result</label>
            <input v-model="form.result" class="w-full p-2 border rounded" required />
            <p v-if="form.errors.result" class="text-red-500 text-sm">{{ form.errors.result }}</p>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium">Upload Image</label>
            <input type="file" @change="handleImageUpload" class="w-full p-2 border rounded" accept="image/*" />
            <p v-if="form.errors.image" class="text-red-500 text-sm">{{ form.errors.image }}</p>
          </div>

          <div class="flex justify-end space-x-2">
            <button type="button" @click="closeModal"
              class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
              Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
              {{ isEditing ? 'Update' : 'Save' }}
            </button>
          </div>
        </form>
        </div>
      </div>
  
      <!-- Image Preview Modal -->
      <div v-if="showImageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75">
        <div class="relative bg-white p-4 rounded-lg shadow-lg">
          <button @click="closeImageModal"
            class="absolute top-2 right-2 px-3 py-1 bg-red-600 text-white rounded-full hover:bg-red-700">
            &times;
          </button>
          <img :src="`/storage/` + selectedImage" alt="Expanded Image" class="max-w-full max-h-screen rounded-lg">
        </div>
      </div>
  
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  import { router } from '@inertiajs/vue3';
  
  const props = defineProps({
    patient: Object,
  });
  
  const showModal = ref(false);
  const isEditing = ref(false);
  const selectedRecordId = ref(null);
  const showImageModal = ref(false);
  const selectedImage = ref(null);
  
  const form = useForm({
    testType: '',
    dateTime: '',
    result: '',
    image: null,
  });
  
  const openModal = () => {
    isEditing.value = false;
    form.reset();
    showModal.value = true;
  };
  
  const openEditModal = (record) => {
    isEditing.value = true;
    selectedRecordId.value = record.id;
    form.testType = record.testType;
    form.dateTime = record.dateTime;
    form.result = record.result;
    form.image = null; // Reset image to allow optional update
    showModal.value = true;
  };
  
  
  const closeModal = () => {
    showModal.value = false;
    form.reset();
  };
  
  const handleImageUpload = (event) => {
    form.image = event.target.files[0];
  };
  
  const addRecord = () => {
    form.post(route('microbiology.store', props.patient.id), {
      preserveScroll: true,
      onSuccess: () => {
        closeModal();
      },
    });
  };
  
  const updateRecord = () => {
    const formData = new FormData();
    formData.append('testType', form.testType);
    formData.append('dateTime', form.dateTime);
    formData.append('result', form.result);
  
    // Only append image if a new file is selected
    if (form.image && form.image instanceof File) {
      formData.append('image', form.image);
    }
  
    router.post(route('microbiology.update', { id: selectedRecordId.value }), formData, {
      preserveScroll: true,
      onSuccess: () => {
        closeModal();
      },
    });
  };
  
  
  
  // Delete Function
  const deleteRecord = (id) => {
    if (confirm('Are you sure you want to delete this record?')) {
      form.delete(route('microbiology.destroy', id), {
        preserveScroll: true,
      });
    }
  };
  
  // Open Image Modal
  const openImageModal = (imagePath) => {
    selectedImage.value = imagePath;
    showImageModal.value = true;
  };
  
  // Close Image Modal
  const closeImageModal = () => {
    showImageModal.value = false;
    selectedImage.value = null;
  };
  </script>