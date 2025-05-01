<template>

    <div class="bg-gray-50 p-4 rounded-lg space-y-4">
        <div>
            <h3 class="font-semibold mb-2">Date:</h3>
            <Input type="date" class="w-full p-2 border rounded-md" v-model="form.date" />
        </div>
        <!-- Medicine -->
        <div>
            <h3 class="font-semibold mb-2">Medicine:</h3>
            <Textarea rows="5" class="w-full  p-2 border rounded-md" v-model="form.medicine" />
        </div>

        <!-- Exercise / Treatment -->
        <div>
            <h3 class="font-semibold mb-2">Exercise / Treatment:</h3>
            <Textarea rows="5" class="w-full  p-2 border rounded-md" v-model="form.exercise" />
            <Textarea rows="5" class="w-full p-2 border rounded-md mt-2" v-model="form.treatment" />
        </div>

        <!-- Health Education -->
        <div>
            <h3 class="font-semibold mb-2">Health Education:</h3>
            <Textarea rows="5" class="w-full p-2 border rounded-md" v-model="form.health" />
        </div>

        <!-- Out-patient Follow-up Visit -->
        <div>
            <h3 class="font-semibold mb-2">Out-patient Follow-up Visit:</h3>
            <Textarea class="w-full h-32 p-2 border rounded-md" v-model="form.followup_visit" />
        </div>

        <!-- Diet -->
        <div>
            <h3 class="font-semibold mb-2">Diet:</h3>
            <Textarea class="w-full h-32 p-2 border rounded-md" v-model="form.diet" />
        </div>

        <!-- Spirituality -->
        <div>
            <h3 class="font-semibold mb-2">Spirituality:</h3>
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
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'
import Textarea from '@/Components/ui/textarea/Textarea.vue';
import Button from '@/components/ui/button/Button.vue';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuShortcut,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/Components/ui/alert-dialog'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/Components/ui/dialog'
import {
    Drawer,
    DrawerClose,
    DrawerContent,
    DrawerDescription,
    DrawerFooter,
    DrawerHeader,
    DrawerTitle,
    DrawerTrigger,
} from '@/Components/ui/drawer'



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