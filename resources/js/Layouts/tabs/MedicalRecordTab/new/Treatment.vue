<template>
    <div class="p-6 bg-gray-100 rounded-lg shadow-md">
      <h1 class="text-2xl font-bold text-gray-800 mb-4">TREATMENT</h1>
      
      <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700">Short Term Goals</h2>
        <textarea v-model="form.short_term" class="w-full h-40 p-2 mt-2 text-gray-600 border border-gray-300 rounded-md" placeholder="Enter short term goals..."></textarea>
      </div>
      
      <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700">Long Term Goals</h2>
        <textarea v-model="form.long_term" class="w-full h-40 p-2 mt-2 text-gray-600 border border-gray-300 rounded-md" placeholder="Enter long term goals..."></textarea>
      </div>
      
      <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700">Medications</h2>
        <textarea v-model="form.medication" class="w-full h-40 p-2 mt-2 text-gray-600 border border-gray-300 rounded-md" placeholder="Enter medication details..."></textarea>
      </div>
      
      <div>
        <h2 class="text-xl font-semibold text-gray-700">Interventions</h2>
        <textarea v-model="form.intervention" class="w-full h-40 p-2 mt-2 text-gray-600 border border-gray-300 rounded-md" placeholder="Enter intervention details..."></textarea>
      </div>
      <!-- Update Button -->
      <div class="mt-6 text-center">
        <button @click="updateContent()" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
          Update
        </button>
      </div>
    </div>
  </template>
  
  <script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    patient:Object
})  

const form = useForm({
    short_term: props.patient?.treatment?.short_term,
    long_term:props.patient?.treatment?.long_term,
    medication:props.patient?.treatment?.medication,
    intervention:props.patient?.treatment?.intervention,

})

const updateContent = () =>  {
    form.put(route('treatment.update', props.patient?.treatment?.id ))
}

  </script>
  