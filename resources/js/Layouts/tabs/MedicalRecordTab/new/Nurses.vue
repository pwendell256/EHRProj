<template>
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Nurses Notes</h3>

        <UseTemplate>
            <form @submit.prevent="isEditing ? updateNote() : addNote()" class="grid gap-4 px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="date">Date</Label>
                        <Input id="date" type="date" v-model="form.date" required />
                        <p v-if="form.errors?.date" class="text-red-500 text-sm">{{ form.errors.date }}</p>
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="time">Time</Label>
                        <Input id="time" type="time" v-model="form.time" required />
                        <p v-if="form.errors?.time" class="text-red-500 text-sm">{{ form.errors.time }}</p>
                    </div>

                    <div class="flex flex-col gap-2 md:col-span-2">
                        <Label for="observation">Observation</Label>
                        <textarea id="observation" v-model="form.observation" rows="4"
                            class="w-full border rounded px-3 py-2" required></textarea>
                        <p v-if="form.errors?.observation" class="text-red-500 text-sm">{{ form.errors.observation }}
                        </p>
                    </div>
                </div>

            
                    <Button type="submit">{{ isEditing ? 'Update' : 'Save' }}</Button>
             
            </form>
        </UseTemplate>


        <!-- Nursing Note Dialog -->
        <Dialog v-if="isDesktop" v-model:open="isOpen">
            <DialogTrigger as-child>
                <Button @click="openModal()">+ Add Nursing Note</Button>
            </DialogTrigger>
            <DialogContent class="sm:max-w-[500px]">
                <DialogHeader>
                    <DialogTitle>{{ isEditing ? 'Edit' : 'Add' }} Nursing Note</DialogTitle>
                    <DialogDescription>
                        Record time-based patient observations and updates.
                    </DialogDescription>
                </DialogHeader>
                <GridForm />
            </DialogContent>
        </Dialog>

        <!-- Nursing Note Drawer -->
        <Drawer v-else v-model:open="isOpen">
            <DrawerTrigger as-child>
                <Button variant="outline">+ Add Nursing Note</Button>
            </DrawerTrigger>
            <DrawerContent>
                <DrawerHeader class="text-left">
                    <DrawerTitle>{{ isEditing ? 'Edit' : 'Add' }} Nursing Note</DrawerTitle>
                    <DrawerDescription>
                        Record time-based patient observations and updates.
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
                        <TableHead>Date</TableHead>
                        <TableHead>Hour</TableHead>
                        <TableHead>Observations</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>

                <TableBody>
                    <TableRow v-for="(data, index) in sortedNotes" :key="data.id">
                        <TableCell>
                            <span v-if="index === 0 || data.date !== sortedNotes[index - 1].date">{{ data.date }}</span>
                        </TableCell>
                        <TableCell>{{ data.time }}</TableCell>
                        <TableCell>
                            <div v-html="data.observation.replace(/\n/g, '<br>')" class="ml-2"></div>
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
                                    <DropdownMenuItem @click="openModal(data)">
                                        <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                                    </DropdownMenuItem>
                                    <DropdownMenuItem @click="deleteData(data.id)">
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
                        This action cannot be undone. It will permanently delete this nursing note.
                    </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel @click="showDeleteDialog = false">Cancel</AlertDialogCancel>
                    <AlertDialogAction class="bg-red-600 hover:bg-red-700" @click="confirmDelete">
                        Delete
                    </AlertDialogAction>
                </AlertDialogFooter>
            </AlertDialogContent>
        </AlertDialog>
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
import { ref, onMounted, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { Link, } from '@inertiajs/vue3';

import { Button } from '@/components/ui/button'
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

const props = defineProps({
    patient: Object
});

const showModal = ref(false);
const isEditing = ref(false);
const editingId = ref(null);

const form = useForm({
    date: '',
    time: '',
    observation: ''
});

const sortedNotes = computed(() => {
    return [...props.patient.nursenotes].sort((a, b) => a.time.localeCompare(b.time));
});

const openModal = (data = null) => {
    if (data) {
        isEditing.value = true;
        editingId.value = data.id;
        form.date = data.date;
        form.time = data.time;
        form.observation = data.observation;
    } else {
        isEditing.value = false;
        editingId.value = null;
        form.reset();
    }
    isOpen.value = true;
};

const addNote = () => {
    form.post(route('nurse.store', props.patient.id), {
        onSuccess: () => {
            isOpen.value = false;
            form.reset();
        }
    });
};

const updateNote = () => {
    form.put(route('nurse.update', editingId.value), {
        onSuccess: () => {
            isOpen.value = false;
            form.reset();
        }
    });
};

const deleteform = useForm([])


const showDeleteDialog = ref(false);
const noteToDeleteId = ref(null);

const deleteData = (id) => {
    noteToDeleteId.value = id;
    showDeleteDialog.value = true;
};

const confirmDelete = () => {
    if (!noteToDeleteId.value) return;
    deleteform.delete(route('nurse.destroy', noteToDeleteId.value), {
        onSuccess: () => {
            showDeleteDialog.value = false;
            noteToDeleteId.value = null;
        }
    });
};


</script>
