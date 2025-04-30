<template>
    <div>
      <h3 class="text-xl font-semibold mb-2">Introduction:</h3>
      <Textarea v-model="form.introduction" class="w-full h-32 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Patient’s History and Current Status:</h3>
      <Textarea v-model="form.history" class="w-full h-32 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Presentation in Clinic:</h3>
      <Textarea v-model="form.presentation" class="w-full h-32 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Mood and Mental State:</h3>
      <Textarea v-model="form.mood" class="w-full h-32 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Social and Functional Status:</h3>
      <Textarea v-model="form.social" class="w-full h-32 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Physical Health Issues:</h3>
      <Textarea v-model="form.physical" class="w-full h-32 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Plan and Recommendations:</h3>
      <Textarea v-model="form.plan" class="w-full h-32 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Closing Statement:</h3>
      <Textarea v-model="form.closing" class="w-full h-32 p-2 border rounded-md" />
  
      <!-- Practitioner Details -->
      <h2 class="text-2xl font-bold mt-6 mb-2">Practitioner Details</h2>
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Full Name and Title:</h3>
      <input v-model="form.pracName" type="text" class="w-full border p-2 rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Clinic Address:</h3>
      <input v-model="form.clinicAddress" type="text" class="w-full border p-2 rounded-md" />
  
      <!-- SOAP Note -->
      <h2 class="text-2xl font-bold mt-6 mb-2">SOAP Note</h2>
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Subjective:</h3>
      <Textarea v-model="form.soap_subjective" class="w-full h-20 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Objective:</h3>
      <Textarea v-model="form.soap_objective" class="w-full h-20 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Assessment:</h3>
      <Textarea v-model="form.soap_assessment" class="w-full h-20 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Plan:</h3>
      <Textarea v-model="form.soap_plan" class="w-full h-20 p-2 border rounded-md" />
  
      <!-- BIRP Note -->
      <h2 class="text-2xl font-bold mt-6 mb-2">BIRP Note</h2>
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Behavior:</h3>
      <Textarea v-model="form.birp_behavior" class="w-full h-20 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Intervention:</h3>
      <Textarea v-model="form.birp_intervention" class="w-full h-20 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Response:</h3>
      <Textarea v-model="form.birp_response" class="w-full h-20 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Plan:</h3>
      <Textarea v-model="form.birp_plan" class="w-full h-20 p-2 border rounded-md" />
  
      <!-- DAP Note -->
      <h2 class="text-2xl font-bold mt-6 mb-2">DAP Note</h2>
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Data:</h3>
      <Textarea v-model="form.dap_data" class="w-full h-20 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Assessment:</h3>
      <Textarea v-model="form.dap_assessment" class="w-full h-20 p-2 border rounded-md" />
  
      <h3 class="text-xl font-semibold mt-4 mb-2">Plan:</h3>
      <Textarea v-model="form.dap_plan" class="w-full h-20 p-2 border rounded-md" />
    </div>
    <div class="flex justify-end mt-4">
            <Button @click="updateForm()">
                Update
            </Button>
        </div>

  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  import { Textarea } from '@/Components/ui/textarea'
  import Button from '@/components/ui/button/Button.vue';

  const props = defineProps({
    patient: Object
  })
  
  const form = useForm({
    introduction: props.patient?.doctorprogress?.introduction || '',
    history: props.patient?.doctorprogress?.history || '',
    presentation: props.patient?.doctorprogress?.presentation || '',
    mood: props.patient?.doctorprogress?.mood || '',
    social: props.patient?.doctorprogress?.social || '',
    physical: props.patient?.doctorprogress?.physical || '',
    plan: props.patient?.doctorprogress?.plan || '',
    closing: props.patient?.doctorprogress?.closing || '',
    pracName: props.patient?.doctorprogress?.pracName || '',
    clinicAddress: props.patient?.doctorprogress?.clinicAddress || '',
    soap_subjective: props.patient?.doctorprogress?.soap_subjective || '',
    soap_objective: props.patient?.doctorprogress?.soap_objective || '',
    soap_assessment: props.patient?.doctorprogress?.soap_assessment || '',
    soap_plan: props.patient?.doctorprogress?.soap_plan || '',
    birp_behavior: props.patient?.doctorprogress?.birp_behavior || '',
    birp_intervention: props.patient?.doctorprogress?.birp_intervention || '',
    birp_response: props.patient?.doctorprogress?.birp_response || '',
    birp_plan: props.patient?.doctorprogress?.birp_plan || '',
    dap_data: props.patient?.doctorprogress?.dap_data || '',
    dap_assessment: props.patient?.doctorprogress?.dap_assessment || '',
    dap_plan: props.patient?.doctorprogress?.dap_plan || ''
  })

  const updateForm = () =>{
    form.put(route('doctorprogress.update', props.patient.doctorprogress.id))
  }
  

  </script>
  