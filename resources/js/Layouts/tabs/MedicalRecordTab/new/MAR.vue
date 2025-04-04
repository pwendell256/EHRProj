<template>
    <div class="overflow-x-auto p-4">
        <div class="flex justify-end mb-4">
            <button @click="openMedicationModal()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Medication
            </button>
        </div>

        <!-- Medication Form Modal -->
        <div v-if="showMedicationModal"
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">{{ editMode ? 'Edit' : 'Add' }} Medication</h2>
                <label class="block mb-2">Medication</label>
                <input v-model="medicationForm.med" class="w-full border p-2 mb-4" type="text">

                <label class="block mb-2">Dosage</label>
                <input v-model="medicationForm.dosage" class="w-full border p-2 mb-4" type="text">

                <label class="block mb-2">Route</label>
                <input v-model="medicationForm.route" class="w-full border p-2 mb-4" type="text">

                <label class="block mb-2">Time</label>
                <input v-model="medicationForm.time" class="w-full border p-2 mb-4" type="text">

                <label class="block mb-2">Notes</label>
                <input v-model="medicationForm.note" class="w-full border p-2 mb-4" type="text">

                <div class="flex justify-end gap-2">
                    <button @click="closeMedicationModal()"
                        class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                    <button @click="editMode ? updateMedication() : addMedication()"
                        class="bg-blue-500 text-white px-4 py-2 rounded">
                        {{ editMode ? 'Update' : 'Add' }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Martime Form Modal -->
        <div v-if="showMartimeModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">{{ martimeEditMode ? 'Edit' : 'Add' }} Medication Time</h2>
                <p class="mb-4 text-gray-600">{{ martimeEditMode ? 'Editing' : 'Adding' }} time for: <strong>{{ currentMedication?.med }}</strong></p>

                <label class="block mb-2">Date</label>
                <input v-model="martimeForm.date" class="w-full border p-2 mb-4" type="date">

                <label class="block mb-2">Time</label>
                <input v-model="martimeForm.time" class="w-full border p-2 mb-4" type="time">

                <label class="block mb-2">ADM</label>
                <input v-model="martimeForm.adm" class="w-full border p-2 mb-4" type="text">

                <label class="block mb-2">Signature</label>
                <input type="file" @input="handleSignatureUpload" class="w-full border p-2 mb-4" accept="image/*">
                <div v-if="martimeEditMode && currentMartime?.path" class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">Current signature:</p>
                    <img :src="`/storage/` + currentMartime.path" alt="Current Signature" class="h-10">
                </div>

                <div class="flex justify-end gap-2">
                    <button @click="closeMartimeModal()"
                        class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                    <button @click="martimeEditMode ? updateMartime() : addMartime()" 
                        class="bg-blue-500 text-white px-4 py-2 rounded">
                        {{ martimeEditMode ? 'Update' : 'Add' }}
                    </button>
                </div>
            </div>
        </div>

        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 text-left text-gray-600">Medication</th>
                    <th class="px-4 py-2 text-left text-gray-600">Date</th>
                    <th class="px-4 py-2 text-left text-gray-600">Time</th>
                    <th class="px-4 py-2 text-left text-gray-600">ADM</th>
                    <th class="px-4 py-2 text-left text-gray-600">Signature</th>
                    <th class="px-4 py-2 text-left text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="mar in sortedMedications" :key="mar.id">
                    <template v-if="mar.sortedMartimes.length">
                        <tr v-for="(martime, index) in mar.sortedMartimes" :key="martime.id" class="border-b">
                            <td class="px-4 py-2" :rowspan="mar.sortedMartimes.length" v-if="index === 0">
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
                                    <button @click="openMartimeModal(mar)" class="text-green-500 hover:text-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </button>
                                    <button @click="deletemar(mar.id)">delete</button>
                                </div>
                            </td>
                            <td class="px-4 py-2" v-if="shouldShowDate(martime, mar.sortedMartimes, index)">
                                {{ martime.date }}
                            </td>
                            <td v-else></td>
                            <td class="px-4 py-2">{{ martime.time }}</td>
                            <td class="px-4 py-2">{{ martime.adm }}</td>
                            <td class="px-4 py-2">
                                <img v-if="martime.path" :src="`/storage/` + martime.path" alt="Signature"
                                    class="h-10">
                            </td>
                            <td class="px-4 py-2">
                                <button @click="editMartime(mar, martime)" class="text-blue-500 hover:text-blue-700 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button @click="deleteMartime(martime.id)">delete</button>
                            </td>
                        </tr>
                    </template>

                    <!-- Handle Medications without martimes -->
                    <tr v-else class="border-b">
                        <td class="px-4 py-2">
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
                                <button @click="deletemar(mar.id)">delete</button>

                            </div>
                        </td>
                        <td class="px-4 py-2 text-center" colspan="4">No Scheduled Time</td>
                        <td class="px-4 py-2"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

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
    medicationForm.put(route('mar.update', { patient: props.patient.id, mar: currentMarId.value }), {
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
    if(confirm('Are you sure you want to delete this mar?')){
        deletemarform.delete(route('mar.delete', id))
    }
}
const deletemartimeform = useForm([])
const deleteMartime = (id) => {
    if(confirm('Are you sure you want to delete this mar?')){
        deletemartimeform.delete(route('martime.delete', id))
    }
}
</script>