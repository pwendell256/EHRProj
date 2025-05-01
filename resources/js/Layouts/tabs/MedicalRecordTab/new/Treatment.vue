<template>
  <div class="bg-gray-50 p-4 rounded-lg space-y-4">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Treatment</h1>

    <div class="mb-6">
      <h2 class="font-semibold text-gray-700">Short Term Goals</h2>
      <Textarea v-model="form.short_term" class="w-full h-40 p-2 mt-2 text-gray-600 border border-gray-300 rounded-md"
        placeholder="Enter short term goals..."></Textarea>
    </div>

    <div class="mb-6">
      <h2 class="font-semibold text-gray-700">Long Term Goals</h2>
      <Textarea v-model="form.long_term" class="w-full h-40 p-2 mt-2 text-gray-600 border border-gray-300 rounded-md"
        placeholder="Enter long term goals..."></Textarea>
    </div>

    <div class="mb-6">
      <h2 class="font-semibold text-gray-700">Medications</h2>
      <Textarea v-model="form.medication" class="w-full h-40 p-2 mt-2 text-gray-600 border border-gray-300 rounded-md"
        placeholder="Enter medication details..."></Textarea>
    </div>

    <div>
      <h2 class="font-semibold text-gray-700">Interventions</h2>
      <Textarea v-model="form.intervention" class="w-full h-40 p-2 mt-2 text-gray-600 border border-gray-300 rounded-md"
        placeholder="Enter intervention details..."></Textarea>
    </div>

    <div class="flex justify-end mt-4">
      <Button @click="updateContent()">
        Update
      </Button>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { Button } from '@/components/ui/button'
import Textarea from '@/Components/ui/textarea/Textarea.vue';
const props = defineProps({
  patient: Object
})

const form = useForm({
  short_term: props.patient?.treatment?.short_term,
  long_term: props.patient?.treatment?.long_term,
  medication: props.patient?.treatment?.medication,
  intervention: props.patient?.treatment?.intervention,

})

const updateContent = () => {
  form.put(route('treatment.update', props.patient?.treatment?.id))
}

</script>