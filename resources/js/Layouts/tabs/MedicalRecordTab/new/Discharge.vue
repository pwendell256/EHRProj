<template>

<div class="bg-gray-50 p-4 rounded-lg space-y-4">
    <div>
        <h3 class="text-xl font-semibold mb-2">Date:</h3>
        <input
            type="date"
            class="w-full p-2 border rounded-md"
            v-model="form.date"
        />
    </div>
    <!-- Medicine -->
    <div>
        <h3 class="text-xl font-semibold mb-2">Medicine:</h3>
        <Textarea class="w-full h-32 p-2 border rounded-md" v-model="form.medicine" />
    </div>

    <!-- Exercise / Treatment -->
    <div>
        <h3 class="text-xl font-semibold mb-2">Exercise / Treatment:</h3>
        <Textarea class="w-full h-32 p-2 border rounded-md" v-model="form.exercise" />
        <Textarea class="w-full h-32 p-2 border rounded-md mt-2" v-model="form.treatment" />
    </div>

    <!-- Health Education -->
    <div>
        <h3 class="text-xl font-semibold mb-2">Health Education:</h3>
        <Textarea class="w-full h-32 p-2 border rounded-md" v-model="form.health" />
    </div>

    <!-- Out-patient Follow-up Visit -->
    <div>
        <h3 class="text-xl font-semibold mb-2">Out-patient Follow-up Visit:</h3>
        <Textarea class="w-full h-32 p-2 border rounded-md" v-model="form.followup_visit" />
    </div>

    <!-- Diet -->
    <div>
        <h3 class="text-xl font-semibold mb-2">Diet:</h3>
        <Textarea class="w-full h-32 p-2 border rounded-md" v-model="form.diet" />
    </div>

    <!-- Spirituality -->
    <div>
        <h3 class="text-xl font-semibold mb-2">Spirituality:</h3>
        <Textarea class="w-full h-32 p-2 border rounded-md" v-model="form.spirituality" />
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end mt-4">
        <Button @click="updateForm()">
            Update
        </Button>
    </div>
</div>

</template>

<script setup>
import Button from '@/components/ui/button/Button.vue';
import Textarea from '@/Components/ui/textarea/Textarea.vue';
import { useForm } from '@inertiajs/vue3';



const props = defineProps({
    patient: Object
})

const form = useForm({
  date: props.patient.discharge.date || '',
  medicine: props.patient.discharge.medicine || '',
  exercise: props.patient.discharge.exercise || '',
  treatment: props.patient.discharge.treatment || '',
  health: props.patient.discharge.health || '',
  followup_visit: props.patient.discharge.followup_visit || '',
  diet: props.patient.discharge.diet || '',
  spirituality: props.patient.discharge.spirituality || '',
});



const updateForm = () => {
    form.put(route('discharge.update', props.patient.discharge.id))
}
</script>