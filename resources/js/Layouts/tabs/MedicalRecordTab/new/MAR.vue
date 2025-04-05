<template>
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">MAR</h3>

        <!-- Medication Form Template -->
        <UseTemplateMedication>
            <form @submit.prevent="editMode ? updateMedication() : addMedication()" class="grid gap-4 px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="med">Medication</Label>
                        <Input id="med" v-model="medicationForm.med" type="text" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="dosage">Dosage</Label>
                        <Input id="dosage" v-model="medicationForm.dosage" type="text" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="route">Route</Label>
                        <Input id="route" v-model="medicationForm.route" type="text" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="time">Time</Label>
                        <Input id="time" v-model="medicationForm.time" type="text" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="note">Notes</Label>
                        <Input id="note" v-model="medicationForm.note" type="text" />
                    </div>
                </div>

                <div class="flex justify-end pt-2 gap-2">
                    <Button type="button" variant="outline" @click="showMedicationModal = false">Cancel</Button>
                    <Button type="submit">{{ editMode ? 'Update' : 'Add' }}</Button>
                </div>
            </form>
        </UseTemplateMedication>

        <!-- Martime Form Template -->
        <UseTemplateMartime>
            <form @submit.prevent="martimeEditMode ? updateMartime() : addMartime()" class="grid gap-4 px-4">
                <div class="mb-2 text-gray-600">
                    {{ martimeEditMode ? 'Editing' : 'Adding' }} time for: <strong>{{ currentMedication?.med }}</strong>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="date">Date</Label>
                        <Input id="date" v-model="martimeForm.date" type="date" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="time">Time</Label>
                        <Input id="time" v-model="martimeForm.time" type="time" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="adm">ADM</Label>
                        <Input id="adm" v-model="martimeForm.adm" type="text" required />
                    </div>

                    <div class="flex flex-col gap-2 col-span-2">
                        <Label for="signature">Signature</Label>
                        <input id="signature" type="file" @change="handleSignatureUpload" accept="image/*"
                            class="w-full border rounded px-3 py-2" />
                        <div v-if="martimeEditMode && currentMartime?.path" class="mt-1">
                            <p class="text-sm text-gray-600 mb-1">Current signature:</p>
                            <img :src="`/storage/${currentMartime.path}`" alt="Signature" class="h-10" />
                        </div>
                    </div>
                </div>

                <Button type="submit">{{ martimeEditMode ? 'Update' : 'Add' }}</Button>
            </form>
        </UseTemplateMartime>

        <!-- Dialog version -->
        <Dialog v-if="isDesktop" v-model:open="showMedicationModal">
            <DialogTrigger as-child>
                <Button @click="openMedicationModal()">+ Add Medication</Button>
            </DialogTrigger>
            <DialogContent class="sm:max-w-[500px]">
                <DialogHeader>
                    <DialogTitle>{{ editMode ? 'Edit' : 'Add' }} Medication</DialogTitle>
                    <DialogDescription>
                        Fill out all medication details before saving.
                    </DialogDescription>
                </DialogHeader>
                <MedicationForm />
            </DialogContent>
        </Dialog>

        <!-- Drawer version -->
        <Drawer v-else v-model:open="showMedicationModal">
            <DrawerTrigger as-child>
                <Button variant="outline">+ Add Medication</Button>
            </DrawerTrigger>
            <DrawerContent>
                <DrawerHeader class="text-left">
                    <DrawerTitle>{{ editMode ? 'Edit' : 'Add' }} Medication</DrawerTitle>
                    <DrawerDescription>
                        Fill out all medication details before saving.
                    </DrawerDescription>
                </DrawerHeader>
                <MedicationForm />
                <DrawerFooter class="pt-2">
                    <DrawerClose as-child>
                        <Button variant="outline">Cancel</Button>
                    </DrawerClose>
                </DrawerFooter>
            </DrawerContent>
        </Drawer>

        <!-- Martime Dialog -->
        <Dialog v-if="isDesktop" v-model:open="showMartimeModal">
            <DialogTrigger as-child>
                <!-- Optional trigger if needed -->
            </DialogTrigger>
            <DialogContent class="sm:max-w-[500px]">
                <DialogHeader>
                    <DialogTitle>{{ martimeEditMode ? 'Edit' : 'Add' }} Medication Time</DialogTitle>
                    <DialogDescription>
                        Fill in time details for <strong>{{ currentMedication?.med }}</strong>
                    </DialogDescription>
                </DialogHeader>
                <MartimeForm />
            </DialogContent>
        </Dialog>

        <!-- Martime Drawer -->
        <Drawer v-else v-model:open="showMartimeModal">
            <DrawerTrigger as-child>
                <!-- Optional trigger if needed -->
            </DrawerTrigger>
            <DrawerContent>
                <DrawerHeader class="text-left">
                    <DrawerTitle>{{ martimeEditMode ? 'Edit' : 'Add' }} Medication Time</DrawerTitle>
                    <DrawerDescription>
                        Fill in time details for <strong>{{ currentMedication?.med }}</strong>
                    </DrawerDescription>
                </DrawerHeader>
                <MartimeForm />
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
                        <TableHead>Medication</TableHead>
                        <TableHead>Date</TableHead>
                        <TableHead>Time</TableHead>
                        <TableHead>ADM</TableHead>
                        <TableHead>Signature</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <template v-for="mar in sortedMedications" :key="mar.id">
                        <template v-if="mar.sortedMartimes.length">
                            <TableRow v-for="(martime, index) in mar.sortedMartimes" :key="martime.id" class="border-b">
                                <TableCell class="px-4 py-2" :rowspan="mar.sortedMartimes.length" v-if="index === 0">
                                    <strong>{{ mar.med }}</strong> <br>
                                    Dosage: {{ mar.dosage }} <br>
                                    Route: {{ mar.route }}<br>
                                    Time: {{ mar.time }}
                                    <div class="mt-2 flex space-x-2">
                                        <button @click="editMedication(mar)" class="text-blue-500 hover:text-blue-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button @click="openMartimeModal(mar)"
                                            class="text-green-500 hover:text-green-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </button>
                                        <button @click="deletemar(mar.id)" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a1 1 0 001-1V5a1 1 0 00-1-1h-3.5a1 1 0 01-.707-.293l-.586-.586A1 1 0 0012.5 3h-1a1 1 0 00-.707.293l-.586.586A1 1 0 009.5 4H6a1 1 0 00-1 1v1a1 1 0 001 1h12z" />
                                            </svg>

                                        </button>
                                    </div>
                                </TableCell>
                                <TableCell class="px-4 py-2" v-if="shouldShowDate(martime, mar.sortedMartimes, index)">
                                    {{ martime.date }}
                                </TableCell>
                                <TableCell v-else></TableCell>
                                <TableCell class="px-4 py-2">{{ formatTime(martime.time) }}</TableCell>
                                <TableCell class="px-4 py-2">{{ martime.adm }}</TableCell>
                                <TableCell class="px-4 py-2">
                                    <img v-if="martime.path" :src="`/storage/` + martime.path" alt="Signature"
                                        class="h-10">
                                </TableCell>
                                <TableCell class="px-4 py-2">
                                    <button @click="editMartime(mar, martime)"
                                        class="text-blue-500 hover:text-blue-700 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button @click="deleteMartime(martime.id)" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a1 1 0 001-1V5a1 1 0 00-1-1h-3.5a1 1 0 01-.707-.293l-.586-.586A1 1 0 0012.5 3h-1a1 1 0 00-.707.293l-.586.586A1 1 0 009.5 4H6a1 1 0 00-1 1v1a1 1 0 001 1h12z" />
                                        </svg>
                                    </button>
                                </TableCell>
                            </TableRow>
                        </template>

                        <!-- Handle Medications without martimes -->
                        <TableRow v-else class="border-b">
                            <TableCell class="px-4 py-2">
                                <strong>{{ mar.med }}</strong> <br>
                                Dosage: {{ mar.dosage }} <br>
                                Route: {{ mar.route }}
                                <div class="mt-2 flex space-x-2">
                                    <button @click="editMedication(mar)" class="text-blue-500 hover:text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button @click="openMartimeModal(mar)" class="text-green-500 hover:text-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </button>
                                    <button @click="deletemar(mar.id)" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a1 1 0 001-1V5a1 1 0 00-1-1h-3.5a1 1 0 01-.707-.293l-.586-.586A1 1 0 0012.5 3h-1a1 1 0 00-.707.293l-.586.586A1 1 0 009.5 4H6a1 1 0 00-1 1v1a1 1 0 001 1h12z" />
                                        </svg>

                                    </button>
                                </div>
                            </TableCell>
                            <TableCell class="px-4 py-2 text-center" colspan="4">No Scheduled Time</TableCell>
                            <TableCell class="px-4 py-2"></TableCell>
                        </TableRow>
                    </template>
                </TableBody>
            </Table>
        </div>

        <AlertDialog v-model:open="showDeleteMarDialog">
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>Delete Medication Record</AlertDialogTitle>
                    <AlertDialogDescription>
                        This action will permanently delete the selected medication entry.
                    </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel @click="showDeleteMarDialog = false">Cancel</AlertDialogCancel>
                    <AlertDialogAction class="bg-red-600 hover:bg-red-700" @click="handleDeleteMar">
                        Delete
                    </AlertDialogAction>
                </AlertDialogFooter>
            </AlertDialogContent>
        </AlertDialog>

        <!-- Delete Martime Dialog -->
        <AlertDialog v-model:open="showDeleteMartimeDialog">
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>Delete Medication Time</AlertDialogTitle>
                    <AlertDialogDescription>
                        This action will permanently delete the selected medication time entry.
                    </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel @click="showDeleteMartimeDialog = false">Cancel</AlertDialogCancel>
                    <AlertDialogAction class="bg-red-600 hover:bg-red-700" @click="handleDeleteMartime">
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

// Create two separate reusable templates
const [UseTemplateMedication, MedicationForm] = createReusableTemplate()
const [UseTemplateMartime, MartimeForm] = createReusableTemplate()

const isDesktop = useMediaQuery('(min-width: 768px)')

const isOpen = ref(false)

const props = defineProps({
    patient: Object
});

// Medication modal state
const showMedicationModal = ref(false);
const editMode = ref(false);
const currentMarId = ref(null);

// Martime modal state
const showMartimeModal = ref(false);
const martimeEditMode = ref(false);
const currentMedication = ref(null);
const currentMartime = ref(null);
const currentMartimeId = ref(null);

const showDeleteMarDialog = ref(false);
const marToDelete = ref(null);

const showDeleteMartimeDialog = ref(false);
const martimeToDelete = ref(null);


// Forms
const medicationForm = useForm({
    med: '',
    dosage: '',
    route: '',
    time: '',
    note: ''
});

const martimeForm = useForm({
    mar_id: '',
    date: '',
    time: '',
    adm: '',
    path: null
});

// Medication modal functions
const openMedicationModal = () => {
    editMode.value = false;
    medicationForm.reset();
    showMedicationModal.value = true;
};

const closeMedicationModal = () => {
    showMedicationModal.value = false;
    medicationForm.reset();
};

const addMedication = () => {
    medicationForm.post(route('mar.store', props.patient.id), {
        onSuccess: () => {
            closeMedicationModal();
        }
    });
};

const editMedication = (mar) => {
    editMode.value = true;
    currentMarId.value = mar.id;

    // Fill the form with current medication data
    medicationForm.med = mar.med;
    medicationForm.dosage = mar.dosage;
    medicationForm.route = mar.route;
    medicationForm.time = mar.sortedMartimes.length > 0 ? mar.sortedMartimes[0].time : '';
    medicationForm.note = mar.note || '';

    showMedicationModal.value = true;
};

const updateMedication = () => {
    medicationForm.put(route('mar.update', currentMarId.value ), {
        onSuccess: () => {
            closeMedicationModal();
        }
    });
};

// Martime modal functions
const openMartimeModal = (mar) => {
    martimeEditMode.value = false;
    currentMedication.value = mar;
    currentMartime.value = null;
    martimeForm.reset();
    martimeForm.mar_id = mar.id;

    // Set default date to today
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    martimeForm.date = `${year}-${month}-${day}`;

    showMartimeModal.value = true;
};

const closeMartimeModal = () => {
    showMartimeModal.value = false;
    martimeForm.reset();
    currentMedication.value = null;
    currentMartime.value = null;
    martimeEditMode.value = false;
};

const handleSignatureUpload = (event) => {
    martimeForm.path = event.target.files[0];
};

const addMartime = () => {
    martimeForm.post(route('martime.store', currentMedication.value.id), {
        onSuccess: () => {
            closeMartimeModal();
        }
    });
};

// Edit martime functions
const editMartime = (mar, martime) => {
    martimeEditMode.value = true;
    currentMedication.value = mar;
    currentMartime.value = martime;
    currentMartimeId.value = martime.id;

    // Fill the form with current martime data
    martimeForm.reset();
    martimeForm.mar_id = mar.id;
    martimeForm.date = martime.date;
    martimeForm.time = martime.time;
    martimeForm.adm = martime.adm;

    showMartimeModal.value = true;
};

// Replace your current updateMartime function with this
const updateMartime = () => {
    // Add _method: 'PUT' to the form data
    martimeForm._method = 'PUT';

    // Use post instead of put for file uploads
    martimeForm.post(route('martime.update', currentMartimeId.value), {
        onSuccess: () => {
            closeMartimeModal();
        },
        onError: (errors) => {
            console.log(errors); // Handle validation errors
        },
        preserveScroll: true,
    });
};

// Function to determine if the date should be shown
const shouldShowDate = (martime, sortedMartimes, index) => {
    return index === 0 || martime.date !== sortedMartimes[index - 1].date;
};

// Computed property to sort medications by the earliest date
const sortedMedications = computed(() => {
    return props.patient.mar.map(mar => ({
        ...mar,
        sortedMartimes: [...mar.martimes].sort((a, b) => {
            // First compare by date
            const dateComparison = new Date(a.date) - new Date(b.date);

            // If dates are the same, compare by time
            if (dateComparison === 0) {
                // Handle cases where time might be null, undefined, or empty
                if (!a.time) return -1;  // Null times come first
                if (!b.time) return 1;   // Null times come first

                try {
                    // Convert time strings (HH:MM format) for comparison
                    const aTime = a.time.split(':');
                    const bTime = b.time.split(':');

                    const aHours = parseInt(aTime[0]) || 0;
                    const aMinutes = parseInt(aTime[1]) || 0;

                    const bHours = parseInt(bTime[0]) || 0;
                    const bMinutes = parseInt(bTime[1]) || 0;

                    // Compare hours first
                    if (aHours !== bHours) {
                        return aHours - bHours;
                    }

                    // If hours are equal, compare minutes
                    return aMinutes - bMinutes;
                } catch (error) {
                    console.error("Error parsing time:", error);
                    return 0; // Keep original order if there's an error
                }
            }

            return dateComparison;
        })
    }));
});

const deletemarform = useForm([])
const deletemar = (id) => {
    marToDelete.value = id;
    showDeleteMarDialog.value = true;
}

const handleDeleteMar = () => {
    deletemarform.delete(route('mar.delete', marToDelete.value), {
        onSuccess: () => {
            showDeleteMarDialog.value = false;
            marToDelete.value = null;
        }
    })
}

const deletemartimeform = useForm([])
const deleteMartime = (id) => {
    martimeToDelete.value = id;
    showDeleteMartimeDialog.value = true;
}

const handleDeleteMartime = () => {
    deletemartimeform.delete(route('martime.delete', martimeToDelete.value), {
        onSuccess: () => {
            showDeleteMartimeDialog.value = false;
            martimeToDelete.value = null;
        }
    })
}

const formatTime = (time24h) => {
    if (!time24h) return '';

    try {
        // Parse the time from 24-hour format
        const [hours24, minutes] = time24h.split(':');

        // Convert hours to 12-hour format
        let hours12 = parseInt(hours24) % 12;
        hours12 = hours12 === 0 ? 12 : hours12; // Convert 0 to 12 for 12 AM

        // Determine AM or PM
        const period = parseInt(hours24) < 12 ? 'AM' : 'PM';

        // Format the time in 12-hour format with AM/PM
        return `${hours12}:${minutes} ${period}`;
    } catch (error) {
        console.error('Error formatting time:', error);
        return time24h; // Return the original value if there's an error
    }
};
</script>