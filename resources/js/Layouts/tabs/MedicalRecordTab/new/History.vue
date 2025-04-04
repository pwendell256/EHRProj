<template>
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-2">History of Present Illness:</h2>
        <textarea class="w-full h-32 p-2 border rounded-md" v-model="form.history" ></textarea>

        <h2 class="text-xl font-semibold mt-4 mb-2">Past Medical History:</h2>
        <textarea class="w-full h-24 p-2 border rounded-md" v-model="form.past"></textarea>

        <h2 class="text-xl font-semibold mt-4 mb-2">Family Medical History:</h2>
        <textarea class="w-full h-20 p-2 border rounded-md" v-model="form.family"></textarea>

        <h2 class="text-xl font-semibold mt-4 mb-2">Birth and Developmental History:</h2>
        <textarea class="w-full h-20 p-2 border rounded-md" v-model="form.birth"></textarea>

        <h2 class="text-xl font-semibold mt-4 mb-2">Environmental and Social History:</h2>
        <textarea class="w-full h-20 p-2 border rounded-md" v-model="form.environment"></textarea>

        <h2 class="text-xl font-semibold mt-4 mb-2">Dietary History:</h2>
        <textarea class="w-full h-16 p-2 border rounded-md" v-model="form.dietary"></textarea>

        <h2 class="text-xl font-semibold mt-4 mb-2">Review of Systems:</h2>
        <textarea class="w-full h-32 p-2 border rounded-md" v-model="form.review"></textarea>

        <div class="flex justify-end mt-4">
            <button @click="updateForm()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
    history: props.patient.history.history,
    past:props.patient.history.past,
    family:props.patient.history.family,
    birth:props.patient.history.birth,
    environment:props.patient.history.environment,
    dietary:props.patient.history.dietary,
    review:props.patient.history.review,
})


const updateForm = () => {
    form.put(route('history.update',  props.patient.history.id))
}
</script>