<template>
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">MAR</h3>


        <UseTemplate>
            <form @submit.prevent="submitAddForm" class="grid gap-4 px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="day_number_add">Day Number</Label>
                        <Input id="day_number_add" v-model="addForm.day_number" type="text" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="date_time_add">Date and Time</Label>
                        <Input id="date_time_add" v-model="addForm.date_time" type="datetime-local" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="orders_add">Orders</Label>
                        <textarea id="orders_add" v-model="addForm.orders" rows="3"
                            class="w-full border rounded px-3 py-2" required></textarea>
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="rationale_add">Rationale</Label>
                        <textarea id="rationale_add" v-model="addForm.rationale" rows="3"
                            class="w-full border rounded px-3 py-2" required></textarea>
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="signature_add">Signature</Label>
                        <input id="signature_add" type="file" @change="handleAddFileChange" accept="image/*"
                            class="w-full border rounded px-3 py-2" />
                    </div>
                </div>

                <div class="flex justify-end pt-2 gap-2">
                    <Button type="button" variant="outline" @click="closeAddModal">Cancel</Button>
                    <Button type="submit">Submit</Button>
                </div>
            </form>
        </UseTemplate>

        <Dialog v-if="isDesktop" v-model:open="isAddModalOpen">
            <DialogTrigger as-child>
                <Button @click="isAddModalOpen = true">+ Add Doctor’s Order</Button>
            </DialogTrigger>
            <DialogContent class="sm:max-w-[500px]">
                <DialogHeader>
                    <DialogTitle>Add Doctor’s Order</DialogTitle>
                    <DialogDescription>Fill out the new doctor's order below.</DialogDescription>
                </DialogHeader>
                <GridForm />
            </DialogContent>
        </Dialog>

        <Drawer v-else v-model:open="isAddModalOpen">
            <DrawerTrigger as-child>
                <Button variant="outline" @click="isAddModalOpen = true">+ Add Doctor’s Order</Button>
            </DrawerTrigger>
            <DrawerContent>
                <DrawerHeader class="text-left">
                    <DrawerTitle>Add Doctor’s Order</DrawerTitle>
                    <DrawerDescription>Fill out the new doctor's order below.</DrawerDescription>
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
                        <TableHead>Day Number</TableHead>
                        <TableHead>Date and Time</TableHead>
                        <TableHead>Orders</TableHead>
                        <TableHead>Rationale</TableHead>
                        <TableHead>Signature</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>

                <TableBody>
                    <TableRow v-for="data in patient?.doctororders" :key="data.id">
                        <TableCell>{{ data.day_number }}</TableCell>
                        <TableCell>{{ data.date_time }}</TableCell>
                        <TableCell>{{ data.order }}</TableCell>
                        <TableCell>{{ data.rationale }}</TableCell>
                        <TableCell>
                            <button @click="openSignatureModal(data.signature)" class="text-blue-600 hover:underline">
                                <i class="fas fa-eye"></i> View
                            </button>
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
                                    <DropdownMenuItem @click="openEditModal(data)">
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


        <!-- Modal to view signature image -->
        <div v-if="isSignatureModalOpen"
            class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg w-96">
                <h3 class="text-lg font-semibold mb-4">Signature Image</h3>
                <div class="flex justify-center mb-4">
                    <img :src="`/storage/` + signatureImage" alt="Signature" class="w-full h-auto" />
                </div>
                <div class="text-right">
                    <button @click="closeSignatureModal"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Close
                    </button>
                </div>
            </div>
        </div>


        <!-- Modal for Editing Doctor's Order -->
        <UseTemplate>
            <form @submit.prevent="submitEditForm" class="grid gap-4 px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="day_number_edit">Day Number</Label>
                        <Input id="day_number_edit" v-model="editForm.day_number" type="text" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="date_time_edit">Date and Time</Label>
                        <Input id="date_time_edit" v-model="editForm.date_time" type="datetime-local" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="orders_edit">Orders</Label>
                        <textarea id="orders_edit" v-model="editForm.orders" rows="3"
                            class="w-full border rounded px-3 py-2" required></textarea>
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="rationale_edit">Rationale</Label>
                        <textarea id="rationale_edit" v-model="editForm.rationale" rows="3"
                            class="w-full border rounded px-3 py-2" required></textarea>
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="signature_edit">Signature</Label>
                        <input id="signature_edit" type="file" @change="handleEditFileChange" accept="image/*"
                            class="w-full border rounded px-3 py-2" />
                        <div v-if="currentSignature" class="mt-1">
                            <p class="text-sm text-gray-600 mb-1">Current signature:</p>
                            <img :src="`/storage/${currentSignature}`" alt="Signature" class="h-12" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-2 gap-2">
                    <Button type="button" variant="outline" @click="closeEditModal">Cancel</Button>
                    <Button type="submit">Update</Button>
                </div>
            </form>
        </UseTemplate>

        <Dialog v-if="isDesktop" v-model:open="isEditModalOpen">
            <DialogContent class="sm:max-w-[500px]">
                <DialogHeader>
                    <DialogTitle>Edit Doctor’s Order</DialogTitle>
                    <DialogDescription>Update the existing doctor’s order below.</DialogDescription>
                </DialogHeader>
                <GridForm />
            </DialogContent>
        </Dialog>

        <Drawer v-else v-model:open="isEditModalOpen">
            <DrawerContent>
                <DrawerHeader class="text-left">
                    <DrawerTitle>Edit Doctor’s Order</DrawerTitle>
                    <DrawerDescription>Update the existing doctor’s order below.</DrawerDescription>
                </DrawerHeader>
                <GridForm />
                <DrawerFooter class="pt-2">
                    <DrawerClose as-child>
                        <Button variant="outline">Cancel</Button>
                    </DrawerClose>
                </DrawerFooter>
            </DrawerContent>
        </Drawer>

        <AlertDialog v-model:open="showDeleteDialog">
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>Are you sure?</AlertDialogTitle>
                    <AlertDialogDescription>
                        This action cannot be undone. It will permanently delete this doctor's order from the system.
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

const props = defineProps({
    patient: Object,
});

// Modal state variables
const isAddModalOpen = ref(false);
const isEditModalOpen = ref(false);
const isSignatureModalOpen = ref(false);
const signatureImage = ref('');
const currentSignature = ref('');
const currentOrderId = ref(null);

// Form for adding new orders
const addForm = useForm({
    day_number: '',
    date_time: '',
    orders: '',
    rationale: '',
    signature: null,
});

// Form for editing existing orders
const editForm = useForm({
    day_number: '',
    date_time: '',
    orders: '',
    rationale: '',
    signature: null,
    _method: 'PUT'
});

// Modal functions for adding orders
const openAddModal = () => {
    // Reset form
    addForm.reset();
    isAddModalOpen.value = true;
};

const closeAddModal = () => {
    isAddModalOpen.value = false;
};

// Modal functions for editing orders
const openEditModal = (order) => {
    // Set current order ID
    currentOrderId.value = order.id;

    // Populate form with existing data
    editForm.day_number = order.day_number;
    editForm.date_time = order.date_time;
    editForm.orders = order.order;
    editForm.rationale = order.rationale;

    // Track current signature image
    currentSignature.value = order.signature;

    // Open modal
    isEditModalOpen.value = true;
};

const closeEditModal = () => {
    isEditModalOpen.value = false;
};

// Modal functions for viewing signature
const openSignatureModal = (signature) => {
    signatureImage.value = signature;
    isSignatureModalOpen.value = true;
};

const closeSignatureModal = () => {
    isSignatureModalOpen.value = false;
};

// File handling functions
const handleAddFileChange = (event) => {
    addForm.signature = event.target.files[0];
};

const handleEditFileChange = (event) => {
    editForm.signature = event.target.files[0];
};

// Form submission functions
const submitAddForm = () => {
    addForm.post(route('doctor.store', props.patient.id), {
        onSuccess: () => {
            closeAddModal();
        },
        onError: (errors) => {
            console.log(errors); // Handle validation errors
        },
    });
};

const submitEditForm = () => {
    // Submit to the update route with the order ID
    editForm.post(route('doctor.update', [currentOrderId.value]), {
        onSuccess: () => {
            closeEditModal();
        },
        onError: (errors) => {
            console.log(errors); // Handle validation errors
        },
    });
};

const deleteForm = useForm([

])
const showDeleteDialog = ref(false);
const orderToDeleteId = ref(null);

const deleteData = (id) => {
    orderToDeleteId.value = id;
    showDeleteDialog.value = true;
};

const confirmDelete = () => {
    if (!orderToDeleteId.value) return;
    deleteForm.delete(route('doctor.destroy', orderToDeleteId.value), {
        onSuccess: () => {
            showDeleteDialog.value = false;
            orderToDeleteId.value = null;
        }
    });
};
</script>

<style scoped>
/* Optional: You can add custom styles here */
</style>