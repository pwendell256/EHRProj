<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">HEMATOLOGY</h1>
    <h2 class="text-xl font-medium mb-6">Complete Blood Count</h2>

    <table class="min-w-full table-auto border-collapse">
      <thead>
        <tr class="bg-gray-200">
          <th class="px-4 py-2 border">Test</th>
          <th class="px-4 py-2 border">Result</th>
          <th class="px-4 py-2 border">Reference</th>
          <th class="px-4 py-2 border">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="px-4 py-2 border">White Blood Cells</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.wbc" @input="checkStatus('wbc', 4.5, 14.5)" /></td>
          <td class="px-4 py-2 border">4.5-14.5 x 10^3/µL</td>
          <td class="px-4 py-2 border" :class="statusClass.wbc">{{ status.wbc }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Red Blood Cell Count</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.rbc" @input="checkStatus('rbc', 4.00, 5.20)" /></td>
          <td class="px-4 py-2 border">4.00-5.20 x 10^6/µL</td>
          <td class="px-4 py-2 border" :class="statusClass.rbc">{{ status.rbc }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Hemoglobin</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.hemoglobin" @input="checkStatus('hemoglobin', 11.5, 15.5)" /></td>
          <td class="px-4 py-2 border">11.5-15.5 g/dL</td>
          <td class="px-4 py-2 border" :class="statusClass.hemoglobin">{{ status.hemoglobin }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Hematocrit</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.hematocrit" @input="checkStatus('hematocrit', 35, 45)" /></td>
          <td class="px-4 py-2 border">35-45%</td>
          <td class="px-4 py-2 border" :class="statusClass.hematocrit">{{ status.hematocrit }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Mean Corpuscular Volume</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.mcv" @input="checkStatus('mcv', 77, 95)" /></td>
          <td class="px-4 py-2 border">77-95 fL</td>
          <td class="px-4 py-2 border" :class="statusClass.mcv">{{ status.mcv }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Mean Corpuscular Hb</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.mch" @input="checkStatus('mch', 25, 33)" /></td>
          <td class="px-4 py-2 border">25-33 pg</td>
          <td class="px-4 py-2 border" :class="statusClass.mch">{{ status.mch }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Mean Corpuscular Hb Conc.</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.mchc" @input="checkStatus('mchc', 32, 36)" /></td>
          <td class="px-4 py-2 border">32-36 g/dL</td>
          <td class="px-4 py-2 border" :class="statusClass.mchc">{{ status.mchc }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">RBC Distribution Width</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.rbc_width" @input="checkStatus('rbc_width', 11.5, 15.0)" /></td>
          <td class="px-4 py-2 border">11.5-15.0 %</td>
          <td class="px-4 py-2 border" :class="statusClass.rbc_width">{{ status.rbc_width }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Platelet Count</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.platelet_count" @input="checkStatus('platelet_count', 150, 450)" /></td>
          <td class="px-4 py-2 border">150-450 x 10^3/µL</td>
          <td class="px-4 py-2 border" :class="statusClass.platelet_count">{{ status.platelet_count }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="container mx-auto p-4">
    <h2 class="text-xl font-medium mb-6">Differential Count</h2>

    <table class="min-w-full table-auto border-collapse">
      <tbody>
        <tr>
          <td class="px-4 py-2 border">Neutrophils</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.neutrophils" @input="checkStatus('neutrophils', 1.0, 8.0)" /></td>
          <td class="px-4 py-2 border">1.0-8.0 x 10^9/L</td>
          <td class="px-4 py-2 border" :class="statusClass.neutrophils">{{ status.neutrophils }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Lymphocytes</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.lymphocytes" @input="checkStatus('lymphocytes', 1.5, 7.0)" /></td>
          <td class="px-4 py-2 border">1.5-7.0 x 10^9/L</td>
          <td class="px-4 py-2 border" :class="statusClass.lymphocytes">{{ status.lymphocytes }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Monocyte</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.monocytes" @input="checkStatus('monocytes', 0.2, 1.0)" /></td>
          <td class="px-4 py-2 border">0.2-1.0 x 10^9/L</td>
          <td class="px-4 py-2 border" :class="statusClass.monocytes">{{ status.monocytes }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Eosinophil</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.eosinophils" @input="checkStatus('eosinophils', 0, 0.81, true)" /></td>
          <td class="px-4 py-2 border">&lt;0.81 x 10^9/L</td>
          <td class="px-4 py-2 border" :class="statusClass.eosinophils">{{ status.eosinophils }}</td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Basophil</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.basophils" @input="checkStatus('basophils', 0, 0.21, true)" /></td>
          <td class="px-4 py-2 border">&lt;0.21 x 10^9/L</td>
          <td class="px-4 py-2 border" :class="statusClass.basophils">{{ status.basophils }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="container mx-auto p-4">
    <h2 class="text-xl font-medium mb-6">Radiology</h2>

    <table class="min-w-full table-auto border-collapse">
      <tbody>
        <tr>
          <td class="px-4 py-2 border">Chest PA</td>
          <td class="px-4 py-2 border">
            <textarea class="w-full border-gray-300 rounded px-2 py-1" rows="4" v-model="form.chest_pa"></textarea>
          </td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Impression</td>
          <td class="px-4 py-2 border">
            <textarea class="w-full border-gray-300 rounded px-2 py-1" rows="4" v-model="form.impression"></textarea>
          </td>
        </tr>
        <tr>
          <td class="px-4 py-2 border">Advice</td>
          <td class="px-4 py-2 border">
            <textarea class="w-full border-gray-300 rounded px-2 py-1" rows="4" v-model="form.advice"></textarea>
            <div class="mt-2">
              <label for="image-upload" class="block text-sm font-medium text-gray-700">Upload Image</label>
              <input type="file" id="image-upload" class="w-full border-gray-300 rounded px-2 py-1 mt-1"
                accept="image/*" @change="handleFileUpload" ref="fileInput" />

              <!-- Show image preview if a new file is selected -->
              <div v-if="imagePreview" class="mt-2">
                <img :src="imagePreview" alt="Preview" class="max-w-xs rounded border border-gray-300" />
                <button @click="removeImage" type="button"
                  class="mt-2 px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                  Remove Image
                </button>
              </div>

              <!-- Show existing image if no new file is selected but we have a saved image -->
              <div v-else-if="form.advice_path && !imagePreview" class="mt-2">
                <img :src="`/storage/${form.advice_path}`" alt="Uploaded image"
                  class="max-w-xs rounded border border-gray-300" />
                <button @click="removeImage" type="button"
                  class="mt-2 px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                  Remove Image
                </button>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">CLINICAL MICROSCOPY</h1>
    <h2 class="text-xl font-medium mb-6">Urinalysis</h2>

    <div class="mb-4">
      <label class="block mb-1 text-sm font-medium text-gray-700">Date of Collection</label>
      <input type="date" class="w-full border-gray-300 rounded px-2 py-1" v-model="form.uri_date" />
    </div>
    <div class="mb-4">
      <label class="block mb-1 text-sm font-medium text-gray-700">Time of Collection</label>
      <input type="time" class="w-full border-gray-300 rounded px-2 py-1" v-model="form.uri_time" />
    </div>

    <h3 class="text-lg font-medium mb-4">Physical/Macroscopic</h3>
    <div class="mb-4">
      <label class="block mb-1 text-sm font-medium text-gray-700">Transparency</label>
      <input type="text" class="w-full border-gray-300 rounded px-2 py-1" v-model="form.transparency" />
    </div>
    <div class="mb-4">
      <label class="block mb-1 text-sm font-medium text-gray-700">Color</label>
      <input type="text" class="w-full border-gray-300 rounded px-2 py-1" v-model="form.color" />
    </div>

    <h3 class="text-lg font-medium mb-4">Urine Chemical</h3>

    <table class="min-w-full table-auto border-collapse">
      <thead>
        <tr class="bg-gray-200">
          <th class="px-4 py-2 border">Test</th>
          <th class="px-4 py-2 border">Result</th>
          <th class="px-4 py-2 border">Reference</th>
          <th class="px-4 py-2 border">Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Sp. Gravity -->
        <tr>
          <td class="px-4 py-2 border">Sp. Gravity</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.sp_gravity" @input="checkStatus('sp_gravity', 1.005, 1.030)" /></td>
          <td class="px-4 py-2 border">1.005-1.030</td>
          <td class="px-4 py-2 border" :class="statusClass.sp_gravity">{{ status.sp_gravity }}</td>
        </tr>
        <!-- pH -->
        <tr>
          <td class="px-4 py-2 border">pH</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.ph" @input="checkStatus('ph', 4.6, 8.0)" /></td>
          <td class="px-4 py-2 border">4.6-8.0</td>
          <td class="px-4 py-2 border" :class="statusClass.ph">{{ status.ph }}</td>
        </tr>
        <!-- Protein -->
        <tr>
          <td class="px-4 py-2 border">Protein</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.protein" @input="checkNegativeStatus('protein')" /></td>
          <td class="px-4 py-2 border">NEGATIVE</td>
          <td class="px-4 py-2 border" :class="statusClass.protein">{{ status.protein }}</td>
        </tr>
        <!-- Glucose -->
        <tr>
          <td class="px-4 py-2 border">Glucose</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.glucose" @input="checkNegativeStatus('glucose')" /></td>
          <td class="px-4 py-2 border">NEGATIVE</td>
          <td class="px-4 py-2 border" :class="statusClass.glucose">{{ status.glucose }}</td>
        </tr>
        <!-- Bilirubin -->
        <tr>
          <td class="px-4 py-2 border">Bilirubin</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.bilirubin" @input="checkNegativeStatus('bilirubin')" /></td>
          <td class="px-4 py-2 border">NEGATIVE</td>
          <td class="px-4 py-2 border" :class="statusClass.bilirubin">{{ status.bilirubin }}</td>
        </tr>
        <!-- Blood (ERY/Hb) -->
        <tr>
          <td class="px-4 py-2 border">Blood (ERY/Hb)</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.ery_hb" @input="checkNegativeStatus('ery_hb')" /></td>
          <td class="px-4 py-2 border">NEGATIVE</td>
          <td class="px-4 py-2 border" :class="statusClass.ery_hb">{{ status.ery_hb }}</td>
        </tr>
        <!-- Leukocytes -->
        <tr>
          <td class="px-4 py-2 border">Leukocytes</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.leukocytes" @input="checkNegativeStatus('leukocytes')" /></td>
          <td class="px-4 py-2 border">NEGATIVE</td>
          <td class="px-4 py-2 border" :class="statusClass.leukocytes">{{ status.leukocytes }}</td>
        </tr>
        <!-- Nitrite -->
        <tr>
          <td class="px-4 py-2 border">Nitrite</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.nitrite" @input="checkNegativeStatus('nitrite')" /></td>
          <td class="px-4 py-2 border">NEGATIVE</td>
          <td class="px-4 py-2 border" :class="statusClass.nitrite">{{ status.nitrite }}</td>
        </tr>
        <!-- Urobilinogen -->
        <tr>
          <td class="px-4 py-2 border">Urobilinogen</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.urobilinogen" @input="checkNegativeStatus('urobilinogen')" /></td>
          <td class="px-4 py-2 border">NEGATIVE</td>
          <td class="px-4 py-2 border" :class="statusClass.urobilinogen">{{ status.urobilinogen }}</td>
        </tr>
        <!-- Ketone -->
        <tr>
          <td class="px-4 py-2 border">Ketone</td>
          <td class="px-4 py-2 border"><input type="text" class="w-full border-gray-300 rounded px-2 py-1"
              v-model="form.ketone" @input="checkNegativeStatus('ketone')" /></td>
          <td class="px-4 py-2 border">NEGATIVE</td>
          <td class="px-4 py-2 border" :class="statusClass.ketone">{{ status.ketone }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="container mx-auto p-4">
    <button type="button" @click="submitForm"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      Save Lab Results
    </button>
  </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  patient: Object
});

const fileInput = ref(null);
const imagePreview = ref(null);

const form = useForm({
  wbc: props.patient?.labdiagnosis?.wbc || '',
  rbc: props.patient?.labdiagnosis?.rbc || '',
  hemoglobin: props.patient?.labdiagnosis?.hemoglobin || '',
  hematocrit: props.patient?.labdiagnosis?.hematocrit || '',
  mcv: props.patient?.labdiagnosis?.mcv || '',
  mch: props.patient?.labdiagnosis?.mch || '',
  mchc: props.patient?.labdiagnosis?.mchc || '',
  rbc_width: props.patient?.labdiagnosis?.rbc_width || '',
  platelet_count: props.patient?.labdiagnosis?.platelet_count || '',
  neutrophils: props.patient?.labdiagnosis?.neutrophils || '',
  lymphocytes: props.patient?.labdiagnosis?.lymphocytes || '',
  monocytes: props.patient?.labdiagnosis?.monocytes || '',
  eosinophils: props.patient?.labdiagnosis?.eosinophils || '',
  basophils: props.patient?.labdiagnosis?.basophils || '',
  chest_pa: props.patient?.labdiagnosis?.chest_pa || '',
  impression: props.patient?.labdiagnosis?.impression || '',
  advice: props.patient?.labdiagnosis?.advice || '',
  advice_path: props.patient?.labdiagnosis?.advice_path || null,
  uri_date: props.patient?.labdiagnosis?.uri_date || '',
  uri_time: props.patient?.labdiagnosis?.uri_time || '',
  transparency: props.patient?.labdiagnosis?.transparency || '',
  color: props.patient?.labdiagnosis?.color || '',
  sp_gravity: props.patient?.labdiagnosis?.sp_gravity || '',
  ph: props.patient?.labdiagnosis?.ph || '',
  protein: props.patient?.labdiagnosis?.protein || '',
  glucose: props.patient?.labdiagnosis?.glucose || '',
  bilirubin: props.patient?.labdiagnosis?.bilirubin || '',
  ery_hb: props.patient?.labdiagnosis?.ery_hb || '',
  leukocytes: props.patient?.labdiagnosis?.leukocytes || '',
  nitrite: props.patient?.labdiagnosis?.nitrite || '',
  urobilinogen: props.patient?.labdiagnosis?.urobilinogen || '',
  ketone: props.patient?.labdiagnosis?.ketone || '',
  _method: 'PUT',
});

// Status objects to track normal/abnormal values
const status = reactive({});
const statusClass = reactive({});

// Initialize status for all fields
const initializeStatus = () => {
  const fields = [
    'wbc', 'rbc', 'hemoglobin', 'hematocrit', 'mcv', 'mch', 
    'mchc', 'rbc_width', 'platelet_count', 'neutrophils', 
    'lymphocytes', 'monocytes', 'eosinophils', 'basophils',
    'sp_gravity', 'ph', 'protein', 'glucose', 'bilirubin',
    'ery_hb', 'leukocytes', 'nitrite', 'urobilinogen', 'ketone'
  ];
  
  fields.forEach(field => {
    status[field] = '';
    statusClass[field] = '';
  });
  
  // Check initial values if data exists
  if (props.patient?.labdiagnosis) {
    checkAllValues();
  }
};

// Function to check numeric values against reference ranges
const checkStatus = (field, min, max, lessThanOnly = false) => {
  const value = parseFloat(form[field]);
  
  if (!form[field] || isNaN(value)) {
    status[field] = '';
    statusClass[field] = '';
    return;
  }
  
  if (lessThanOnly) {
    if (value <= max) {
      status[field] = 'NORMAL';
      statusClass[field] = 'text-green-500 font-medium';
    } else {
      status[field] = 'HIGH';
      statusClass[field] = 'text-red-500 font-medium';
    }
    return;
  }
  
  if (value >= min && value <= max) {
    status[field] = 'NORMAL';
    statusClass[field] = 'text-green-500 font-medium';
  } else if (value < min) {
    status[field] = 'LOW';
    statusClass[field] = 'text-red-500 font-medium';
  } else {
    status[field] = 'HIGH';
    statusClass[field] = 'text-red-500 font-medium';
  }
};

// Function to check negative/positive values
const checkNegativeStatus = (field) => {
  const value = form[field].toString().trim().toUpperCase();
  
  if (!value) {
    status[field] = '';
    statusClass[field] = '';
    return;
  }
  
  if (value === 'NEGATIVE' || value === '-' || value === 'NEG') {
    status[field] = 'NORMAL';
    statusClass[field] = 'text-green-500 font-medium';
  } else {
    status[field] = 'ABNORMAL';
    statusClass[field] = 'text-red-500 font-medium';
  }
};

// Check all values (useful on initial load)
const checkAllValues = () => {
  // CBC
  checkStatus('wbc', 4.5, 14.5);
  checkStatus('rbc', 4.00, 5.20);
  checkStatus('hemoglobin', 11.5, 15.5);
  checkStatus('hematocrit', 35, 45);
  checkStatus('mcv', 77, 95);
  checkStatus('mch', 25, 33);
  checkStatus('mchc', 32, 36);
  checkStatus('rbc_width', 11.5, 15.0);
  checkStatus('platelet_count', 150, 450);
  
  // Differential count
  checkStatus('neutrophils', 1.0, 8.0);
  checkStatus('lymphocytes', 1.5, 7.0);
  checkStatus('monocytes', 0.2, 1.0);
  checkStatus('eosinophils', 0, 0.81, true);
  checkStatus('basophils', 0, 0.21, true);
  
  // Urine
  checkStatus('sp_gravity', 1.005, 1.030);
  checkStatus('ph', 4.6, 8.0);
  
  // Negative tests
  checkNegativeStatus('protein');
  checkNegativeStatus('glucose');
  checkNegativeStatus('bilirubin');
  checkNegativeStatus('ery_hb');
  checkNegativeStatus('leukocytes');
  checkNegativeStatus('nitrite');
  checkNegativeStatus('urobilinogen');
  checkNegativeStatus('ketone');
};

// Load existing image if available and initialize statuses
onMounted(() => {
  if (props.patient?.labdiagnosis?.advice_path) {
    form.advice_path = props.patient.labdiagnosis.advice_path;
  }
  
  initializeStatus();
});

const handleFileUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.advice_path = file;
    // Create a preview for the image
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const removeImage = () => {
  form.advice_path = null;
  imagePreview.value = null;
  if (fileInput.value) {
    fileInput.value.value = '';
  }
};

const submitForm = () => {
  form.post(route('labdiagnosis.update', props.patient.labdiagnosis.id), {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => {
      alert('Lab results saved successfully!');
    },
    onError: (errors) => {
      console.error(errors);
    }
  });
};
</script>