<template>
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-xl font-semibold mb-2">History of Present Illness:</h3>
        <Textarea class="w-full h-32 p-2 border rounded-md" v-model="form.history"></Textarea>

        <h3 class="text-xl font-semibold mt-4 mb-2">Past Medical History:</h3>
        <Textarea class="w-full h-24 p-2 border rounded-md" v-model="form.past"></Textarea>

        <h3 class="text-xl font-semibold mt-4 mb-2">Family Medical History:</h3>
        <Textarea class="w-full h-24 p-2 border rounded-md" v-model="form.family"></Textarea>

        <h3 class="text-xl font-semibold mt-4 mb-2">Birth and Developmental History:</h3>
        <Textarea class="w-full h-24 p-2 border rounded-md" v-model="form.birth"></Textarea>

        <h3 class="text-xl font-semibold mt-4 mb-2">Environmental and Social History:</h3>
        <Textarea class="w-full h-24 p-2 border rounded-md" v-model="form.environment"></Textarea>

        <h3 class="text-xl font-semibold mt-4 mb-2">Dietary History:</h3>
        <Textarea class="w-full h-24 p-2 border rounded-md" v-model="form.dietary"></Textarea>

        <h3 class="text-xl font-semibold mt-4 mb-2">Review of Systems:</h3>
        <Textarea class="w-full h-32 p-2 border rounded-md" v-model="form.review"></Textarea>

        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
            <Button @click="updateForm()">
                Update
            </Button>
        </div>
        <div id="bottom">
            <Allergy :patient="patient" />

        </div>

    </div>
</template>

<script setup>
import Button from '@/components/ui/button/Button.vue';
import Textarea from '@/Components/ui/textarea/Textarea.vue';
import { useForm } from '@inertiajs/vue3';
import Allergy from '../Allergy.vue';



const props = defineProps({
    patient: Object
})

const form = useForm({
    history: props.patient.history.history,
    past: props.patient.history.past,
    family: props.patient.history.family,
    birth: props.patient.history.birth,
    environment: props.patient.history.environment,
    dietary: props.patient.history.dietary,
    review: props.patient.history.review,
})


const updateForm = () => {
    form.put(route('history.update', props.patient.history.id))
}
</script>