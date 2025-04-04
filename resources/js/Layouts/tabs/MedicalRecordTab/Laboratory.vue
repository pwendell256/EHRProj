<template>
  <div class="bg-gray-50 p-4 rounded-lg">
    <h3 class="text-xl font-semibold mb-2">Hematology</h3>
    <h4 class="text-lg  font-medium mb-6">Complete Blood Count</h4>

    <div class="overflow-x-auto mt-4 border rounded-lg">
      <Table>
        <TableHeader class="bg-green-100 ">
          <TableRow>
            <TableHead class="w-1/4">Test</TableHead>
            <TableHead class="w-1/4">Result</TableHead>
            <TableHead class="w-1/4">Reference</TableHead>
            <TableHead class="w-1/4">Status</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          <TableRow>
            <TableCell class="w-1/4">White Blood Cells</TableCell>
            <TableCell class="w-1/4">
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.wbc" @input="checkStatus('wbc', 4.5, 14.5)" />
            </TableCell>
            <TableCell class="w-1/4">4.5-14.5 x 10^3/µL</TableCell>
            <TableCell class="w-1/4" :class="statusClass.wbc">{{ status.wbc }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell class="w-1/4">Red Blood Cell Count</TableCell>
            <TableCell class="w-1/4">
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.rbc" @input="checkStatus('rbc', 4.00, 5.20)" />
            </TableCell>
            <TableCell class="w-1/4">4.00-5.20 x 10^6/µL</TableCell>
            <TableCell class="w-1/4" :class="statusClass.rbc">{{ status.rbc }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell class="w-1/4">Hemoglobin</TableCell>
            <TableCell class="w-1/4">
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.hemoglobin" @input="checkStatus('hemoglobin', 11.5, 15.5)" />
            </TableCell>
            <TableCell class="w-1/4">11.5-15.5 g/dL</TableCell>
            <TableCell class="w-1/4" :class="statusClass.hemoglobin">{{ status.hemoglobin }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell class="w-1/4">Hematocrit</TableCell>
            <TableCell class="w-1/4">
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.hematocrit" @input="checkStatus('hematocrit', 35, 45)" />
            </TableCell>
            <TableCell class="w-1/4">35-45%</TableCell>
            <TableCell class="w-1/4" :class="statusClass.hematocrit">{{ status.hematocrit }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell class="w-1/4">Mean Corpuscular Volume</TableCell>
            <TableCell class="w-1/4">
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.mcv" @input="checkStatus('mcv', 77, 95)" />
            </TableCell>
            <TableCell class="w-1/4">77-95 fL</TableCell>
            <TableCell class="w-1/4" :class="statusClass.mcv">{{ status.mcv }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell class="w-1/4">Mean Corpuscular Hb</TableCell>
            <TableCell class="w-1/4">
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.mch" @input="checkStatus('mch', 25, 33)" />
            </TableCell>
            <TableCell class="w-1/4">25-33 pg</TableCell>
            <TableCell class="w-1/4" :class="statusClass.mch">{{ status.mch }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell class="w-1/4">Mean Corpuscular Hb Conc.</TableCell>
            <TableCell class="w-1/4">
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.mchc" @input="checkStatus('mchc', 32, 36)" />
            </TableCell>
            <TableCell class="w-1/4">32-36 g/dL</TableCell>
            <TableCell class="w-1/4" :class="statusClass.mchc">{{ status.mchc }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell class="w-1/4">RBC Distribution Width</TableCell>
            <TableCell class="w-1/4">
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.rbc_width" @input="checkStatus('rbc_width', 11.5, 15.0)" />
            </TableCell>
            <TableCell class="w-1/4">11.5-15.0 %</TableCell>
            <TableCell class="w-1/4" :class="statusClass.rbc_width">{{ status.rbc_width }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell class="w-1/4">Platelet Count</TableCell>
            <TableCell class="w-1/4">
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.platelet_count" @input="checkStatus('platelet_count', 150, 450)" />
            </TableCell>
            <TableCell class="w-1/4">150-450 x 10^3/µL</TableCell>
            <TableCell class="w-1/4" :class="statusClass.platelet_count">{{ status.platelet_count }}</TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>





    <h4 class="text-lg  font-medium mb-6 mt-8">Differential Count</h4>

    <div class="overflow-x-auto mt-4 border rounded-lg mb-8">
      <Table>
        <TableHeader class="bg-green-100">
          <TableRow>
            <TableHead class="w-1/4">Test</TableHead>
            <TableHead class="w-1/4">Result</TableHead>
            <TableHead class="w-1/4">Reference</TableHead>
            <TableHead class="w-1/4">Status</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          <TableRow>
            <TableCell>Neutrophils</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.neutrophils" @input="checkStatus('neutrophils', 1.0, 8.0)" />
            </TableCell>
            <TableCell>1.0–8.0 x 10⁹/L</TableCell>
            <TableCell :class="statusClass.neutrophils">{{ status.neutrophils }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Lymphocytes</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.lymphocytes" @input="checkStatus('lymphocytes', 1.5, 7.0)" />
            </TableCell>
            <TableCell>1.5–7.0 x 10⁹/L</TableCell>
            <TableCell :class="statusClass.lymphocytes">{{ status.lymphocytes }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Monocyte</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.monocytes" @input="checkStatus('monocytes', 0.2, 1.0)" />
            </TableCell>
            <TableCell>0.2–1.0 x 10⁹/L</TableCell>
            <TableCell :class="statusClass.monocytes">{{ status.monocytes }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Eosinophil</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.eosinophils" @input="checkStatus('eosinophils', 0, 0.81, true)" />
            </TableCell>
            <TableCell>&lt;0.81 x 10⁹/L</TableCell>
            <TableCell :class="statusClass.eosinophils">{{ status.eosinophils }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Basophil</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300"
                v-model="form.basophils" @input="checkStatus('basophils', 0, 0.21, true)" />
            </TableCell>
            <TableCell>&lt;0.21 x 10⁹/L</TableCell>
            <TableCell :class="statusClass.basophils">{{ status.basophils }}</TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>



    <h4 class="text-lg  font-medium mb-6">Radiology</h4>

    <div class="overflow-x-auto mt-4 border rounded-lg mb-8">
      <Table>
        <TableBody>
          <TableRow>
            <TableCell class="w-1/4 font-medium">Chest PA</TableCell>
            <TableCell>
              <Textarea class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300" rows="4"
                v-model="form.chest_pa"></Textarea>
            </TableCell>
          </TableRow>

          <TableRow>
            <TableCell class="w-1/4 font-medium">Impression</TableCell>
            <TableCell>
              <Textarea class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300" rows="4"
                v-model="form.impression"></Textarea>
            </TableCell>
          </TableRow>

          <TableRow>
            <TableCell class="w-1/4 font-medium align-top">Advice</TableCell>
            <TableCell>
              <Textarea class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300" rows="4"
                v-model="form.advice"></Textarea>

              <div class="mt-4">
                <label for="image-upload" class="block text-sm font-medium text-gray-700 mb-1">
                  Upload Image
                </label>
                <input type="file" id="image-upload" class="w-full border rounded px-2 py-1" accept="image/*"
                  @change="handleFileUpload" ref="fileInput" />

                <!-- New image preview -->
                <div v-if="imagePreview" class="mt-3">
                  <img :src="imagePreview" alt="Preview" class="max-w-xs rounded border" />
                  <button @click="removeImage" type="button"
                    class="mt-2 px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                    Remove Image
                  </button>
                </div>

                <!-- Existing saved image preview -->
                <div v-else-if="form.advice_path && !imagePreview" class="mt-3">
                  <img :src="`/storage/${form.advice_path}`" alt="Uploaded image" class="max-w-xs rounded border" />
                  <button @click="removeImage" type="button"
                    class="mt-2 px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                    Remove Image
                  </button>
                </div>
              </div>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>

    <h1 class="text-xl font-semibold mb-4">Clinical Microscopy</h1>
    <h2 class="text-lg font-medium mb-6">Urinalysis</h2>

    <div class="mb-4">
      <Label class="block mb-1 text-sm font-medium text-gray-700">Date of Collection</Label>
      <Input type="date" class="w-full border-gray-300 rounded px-2 py-1" v-model="form.uri_date" />
    </div>
    <div class="mb-4">
      <Label class="block mb-1 text-sm font-medium text-gray-700">Time of Collection</Label>
      <Input type="time" class="w-full border-gray-300 rounded px-2 py-1" v-model="form.uri_time" />
    </div>

    <h3 class="text-lg font-medium mb-4">Physical/Macroscopic</h3>
    <div class="mb-4">
      <Label class="block mb-1 text-sm font-medium text-gray-700">Transparency</Label>
      <Input type="text" class="w-full border-gray-300 rounded px-2 py-1" v-model="form.transparency" />
    </div>
    <div class="mb-4">
      <Label class="block mb-1 text-sm font-medium text-gray-700">Color</Label>
      <Input type="text" class="w-full border-gray-300 rounded px-2 py-1" v-model="form.color" />
    </div>

    <h3 class="text-lg font-medium mb-4">Urine Chemical</h3>

    <div class="overflow-x-auto mt-4 border rounded-lg">
      <Table>
        <TableHeader class="bg-green-100">
          <TableRow>
            <TableHead class="w-1/4">Test</TableHead>
            <TableHead class="w-1/4">Result</TableHead>
            <TableHead class="w-1/4">Reference</TableHead>
            <TableHead class="w-1/4">Status</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          <TableRow>
            <TableCell>Sp. Gravity</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1" v-model="form.sp_gravity"
                @input="checkStatus('sp_gravity', 1.005, 1.030)" />
            </TableCell>
            <TableCell>1.005-1.030</TableCell>
            <TableCell :class="statusClass.sp_gravity">{{ status.sp_gravity }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>pH</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1" v-model="form.ph"
                @input="checkStatus('ph', 4.6, 8.0)" />
            </TableCell>
            <TableCell>4.6-8.0</TableCell>
            <TableCell :class="statusClass.ph">{{ status.ph }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Protein</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1" v-model="form.protein"
                @input="checkNegativeStatus('protein')" />
            </TableCell>
            <TableCell>NEGATIVE</TableCell>
            <TableCell :class="statusClass.protein">{{ status.protein }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Glucose</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1" v-model="form.glucose"
                @input="checkNegativeStatus('glucose')" />
            </TableCell>
            <TableCell>NEGATIVE</TableCell>
            <TableCell :class="statusClass.glucose">{{ status.glucose }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Bilirubin</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1" v-model="form.bilirubin"
                @input="checkNegativeStatus('bilirubin')" />
            </TableCell>
            <TableCell>NEGATIVE</TableCell>
            <TableCell :class="statusClass.bilirubin">{{ status.bilirubin }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Blood (ERY/Hb)</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1" v-model="form.ery_hb"
                @input="checkNegativeStatus('ery_hb')" />
            </TableCell>
            <TableCell>NEGATIVE</TableCell>
            <TableCell :class="statusClass.ery_hb">{{ status.ery_hb }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Leukocytes</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1" v-model="form.leukocytes"
                @input="checkNegativeStatus('leukocytes')" />
            </TableCell>
            <TableCell>NEGATIVE</TableCell>
            <TableCell :class="statusClass.leukocytes">{{ status.leukocytes }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Nitrite</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1" v-model="form.nitrite"
                @input="checkNegativeStatus('nitrite')" />
            </TableCell>
            <TableCell>NEGATIVE</TableCell>
            <TableCell :class="statusClass.nitrite">{{ status.nitrite }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Urobilinogen</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1" v-model="form.urobilinogen"
                @input="checkNegativeStatus('urobilinogen')" />
            </TableCell>
            <TableCell>NEGATIVE</TableCell>
            <TableCell :class="statusClass.urobilinogen">{{ status.urobilinogen }}</TableCell>
          </TableRow>

          <TableRow>
            <TableCell>Ketone</TableCell>
            <TableCell>
              <Input type="text" class="w-full border rounded px-2 py-1" v-model="form.ketone"
                @input="checkNegativeStatus('ketone')" />
            </TableCell>
            <TableCell>NEGATIVE</TableCell>
            <TableCell :class="statusClass.ketone">{{ status.ketone }}</TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end mt-4">
      <Button @click="submitForm()">
        Save Lab Results
      </Button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';
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
import { Button } from '@/components/ui/button'
import Textarea from '@/Components/ui/textarea/Textarea.vue';

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