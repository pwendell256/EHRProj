<template>
    <div class="p-4 bg-white shadow rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-xl font-semibold flex items-center">
                    <Pill class="w-5 h-5 mr-2" /> Medication
                </h2>
                <p class="text-gray-500 text-sm">Track patient prescriptions.</p>
            </div>
        </div>

        <UseTemplate>
            <form @submit.prevent="isEditing ? updateMedication() : saveMedication()" class="grid gap-4 px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="date">Date</Label>
                        <Input id="date" type="date" v-model="form.date" required />
                        <p v-if="form.errors?.date" class="text-red-500 text-sm">{{ form.errors.date }}</p>
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="medication">Medication</Label>
                        <Input id="medication" type="text" v-model="form.medication" required />
                        <p v-if="form.errors?.medication" class="text-red-500 text-sm">{{ form.errors.medication }}</p>
                    </div>
                </div>

                <div class="flex justify-end pt-2 gap-2">
                    <Button type="button" variant="outline" @click="isOpen = false">Cancel</Button>
                    <Button type="submit">{{ isEditing ? 'Update' : 'Save' }}</Button>
                </div>
            </form>
        </UseTemplate>

        <!-- Dialog version -->
        <Dialog v-if="isDesktop" v-model:open="isOpen">
            <DialogTrigger as-child>
                <Button @click="openModal()">+ Add Medication</Button>
            </DialogTrigger>
            <DialogContent class="sm:max-w-[425px]">
                <DialogHeader>
                    <DialogTitle>{{ isEditing ? 'Edit' : 'Add' }} Medication</DialogTitle>
                    <DialogDescription>
                        Enter medication details and save the record.
                    </DialogDescription>
                </DialogHeader>
                <GridForm />
            </DialogContent>
        </Dialog>

        <!-- Drawer version -->
        <Drawer v-else v-model:open="isOpen">
            <DrawerTrigger as-child>
                <Button variant="outline">+ Add Medication</Button>
            </DrawerTrigger>
            <DrawerContent>
                <DrawerHeader class="text-left">
                    <DrawerTitle>{{ isEditing ? 'Edit' : 'Add' }} Medication</DrawerTitle>
                    <DrawerDescription>
                        Enter medication details and save the record.
                    </DrawerDescription>
                </DrawerHeader>
                <GridForm />
                <DrawerFooter class="pt-2">
                    <DrawerClose as-child>
                        <Button variant="outline">Cancel</Button>
                    </DrawerClose>
                </DrawerFooter>
            </DrawerContent>
        </Drawer>


        <div class="overflow-x-auto mt-4 border rounded-lg">
            <Table>
                <TableHeader class="bg-green-100">
                    <TableRow>
                        <TableHead>Allergy</TableHead>
                        <TableHead>Test Date & Time</TableHead>
                        <TableHead>Description</TableHead>
                        <TableHead>Image</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>

                <TableBody>
                    <TableRow v-if="!patient.allergies || patient.allergies.length === 0">
                        <TableCell colspan="5" class="text-center text-gray-500">
                            No allergy records found.
                        </TableCell>
                    </TableRow>

                    <TableRow v-for="record in patient.allergies" :key="record.id">
                        <TableCell>{{ record.allergy }}</TableCell>
                        <TableCell>{{ record.dateTime }}</TableCell>
                        <TableCell>{{ record.description }}</TableCell>
                        <TableCell>
                            <div class="text-center">
                                <button v-if="record.path" @click="openImageModal(record.path)"
                                    class="text-blue-600 hover:underline">
                                    👁️ View
                                </button>
                                <span v-else class="text-gray-500">No Image</span>
                            </div>
                        </TableCell>
                        <TableCell class="text-center">
                            <DropdownMenu>
                                <DropdownMenuTrigger as-child>
                                    <Button variant="ghost" class="flex h-8 w-8 p-0 data-[state=open]:bg-muted">
                                        <i class="fa-solid fa-ellipsis"></i>
                                        <span class="sr-only">Open menu</span>
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end" class="w-[160px]">
                                    <DropdownMenuItem @click="openEditModal(record)">
                                        <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                                    </DropdownMenuItem>
                                    <DropdownMenuItem @click="deleteRecord(record.id)">
                                        <i class="fa-solid fa-trash mr-2"></i> Delete
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>

        <AlertDialog v-model:open="showDeleteDialog">
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>Are you sure?</AlertDialogTitle>
                    <AlertDialogDescription>
                        This action will permanently delete this medication record.
                    </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel @click="showDeleteDialog = false">Cancel</AlertDialogCancel>
                    <AlertDialogAction class="bg-red-600 hover:bg-red-700" @click="handleDelete">
                        Delete
                    </AlertDialogAction>
                </AlertDialogFooter>
            </AlertDialogContent>
        </AlertDialog>

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
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'
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

import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
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
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

import { Button } from '@/Components/ui/button'
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
import { createReusableTemplate, useMediaQuery } from '@vueuse/core'
// Reuse `form` section
const [UseTemplate, GridForm] = createReusableTemplate()
const isDesktop = useMediaQuery('(min-width: 768px)')

const isOpen = ref(false)
import { Pill } from "lucide-vue-next";

const props = defineProps({
    patient: Object
});

const isEditing = ref(false);
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


const openModal = () => {
    form.reset(); // clear previous values
    isEditing.value = false;
    isOpen.value = true;
};

const openEditModal = (record) => {
    form.id = record.id;
    form.date = record.date;
    form.medication = record.medication;
    isEditing.value = true;
    isOpen.value = true;
};

const saveMedication = () => {
    form.post(route('medication.store', props.patient.id), {
        onError: (errors) => {
            if (errors.medication) {
                errorMessage.value = errors.medication;
            }
        },
        onSuccess: () => {
            isOpen.value = false;
            errorMessage.value = '';
        }
    });
};

const updateMedication = () => {
    form.put(route('medication.update', form.id), {
        onError: (errors) => {
            if (errors.medication) {
                errorMessage.value = errors.medication;
            }
        },
        onSuccess: () => {
            isOpen.value = false;
            errorMessage.value = '';
        }
    });
};

const showDeleteDialog = ref(false)
const recordToDeleteId = ref(null)

const deleteRecord = (id) => {
    recordToDeleteId.value = id
    showDeleteDialog.value = true
}

const handleDelete = () => {
    deleteform.delete(route('medication.destroy', recordToDeleteId.value), {
        preserveScroll: true,
        onSuccess: () => {
            showDeleteDialog.value = false
            recordToDeleteId.value = null
        }
    })
}
</script>
